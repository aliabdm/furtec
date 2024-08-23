<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoomPart extends Model
{
    use HasFactory ,SoftDeletes;
    protected $dates = ['deleted_at'];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
