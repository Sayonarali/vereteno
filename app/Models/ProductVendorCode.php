<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductVendorCode extends Pivot
{
    public $table = 'product_vendor_codes';

    use HasFactory;

    protected $fillable = [
        'product_id',
        'vendor_code_id',
        'discount_id',
        'price',
        'quantity'
    ];

    public $timestamps = false;

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'product_vendor_code_attributes')
            ->using(ProductVendorCodeAttribute::class);
    }
}
