<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductVendorCodeAttribute extends Pivot
{
    use HasFactory;

    public $table = 'product_vendor_code_attributes';

    protected $fillable = [
        'product_vendor_code_id',
        'attribute_id',
    ];

    public $timestamps = false;
}
