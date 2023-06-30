<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'desc',
        'discount_percent'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
