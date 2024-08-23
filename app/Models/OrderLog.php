<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderLog extends Model
{
    use HasFactory;

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
