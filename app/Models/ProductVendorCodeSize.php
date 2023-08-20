<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductVendorCodeSize extends Pivot
{
    use HasFactory;

    public $table = 'product_vendor_code_sizes';

    protected $fillable = [
        'product_vendor_code_id',
        'size_id',
        'quantity',
    ];

    public $timestamps = false;

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function code()
    {
        return $this->belongsTo(ProductVendorCode::class, 'product_vendor_code_id');
    }
}
