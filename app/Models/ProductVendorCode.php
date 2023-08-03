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
        return $this->belongsToMany(AttributeValue::class, 'product_vendor_code_attribute_values', 'product_vendor_code_id')
            ->using(ProductVendorCodeAttributeValue::class);
    }

    public function images()
    {
        return $this->hasMany(ProductVendorCodeImage::class, 'product_vendor_code_id', 'product_vendor_code_id');
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_vendor_code_sizes', 'product_vendor_code_id')
            ->using(ProductVendorCodeSize::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class, 'discount_id');
    }

    public function code()
    {
        return $this->hasOne(VendorCode::class, 'id');
    }
}
