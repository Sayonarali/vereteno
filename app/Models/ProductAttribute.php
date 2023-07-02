<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductAttribute extends Pivot
{
    use HasFactory;

    public $table = 'product_attributes';

    protected $fillable = [
        'product_id',
        'attribute_id',
    ];

    public $timestamps = false;
}
