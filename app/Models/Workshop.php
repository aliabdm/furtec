<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Workshop extends Model
{
    use HasFactory,Translatable;
    public $translatedAttributes = ['title','content'];

    public function owner()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function workers()
    {
        return $this->hasMany(User::class,'workshop_id');
    }
}
