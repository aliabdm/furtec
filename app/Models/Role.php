<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory,Translatable;
    public $translatedAttributes = ['name'];
    const ADMIN = 1;
    const OWNER = 2;
    const WORKER = 3;
}
