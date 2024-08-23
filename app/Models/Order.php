<?php

namespace App\Models;

use Illuminate\Support\Facades\Lang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory ,SoftDeletes;
    protected $dates = ['deleted_at'];

    const PENDING = 1;
    const PROCESSING = 2;
    const COMPLETED = 3;
    const RECEIVED = 4;
    const CANCELLED = 5;

    public function getStatusTextAttribute()
    {
        return Lang::get('status.' . $this->status);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function workshop()
    {
        return $this->belongsTo(Workshop::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function orderParts()
    {
        return $this->hasMany(OrderPart::class);
    }
}
