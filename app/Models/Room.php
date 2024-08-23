<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory,SoftDeletes;

    public function owner()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function roomParts()
    {
        return $this->hasMany(RoomPart::class);
    }

    public function scopeWithWorkerInWorkshop(Builder $query, $workerId)
    {
        return $query->whereHas('owner.workshops', function ($query) use ($workerId) {
            $query->whereHas('workers', function ($query) use ($workerId) {
                $query->where('id', $workerId)
                      ->where('role', Role::WORKER);
            });
        });
    }
}
