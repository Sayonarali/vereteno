<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $guarded = [
        'cart_id',
    ];

    protected $fillable = [
        'product_id',
        'quantity',
    ];
}
