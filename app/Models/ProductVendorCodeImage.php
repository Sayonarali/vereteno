<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVendorCodeImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'title',
        'product_vendor_code_id',
        'size'
    ];

    public $timestamps = false;

    public function code()
    {
        return $this->belongsTo(ProductVendorCode::class, 'product_vendor_code_id');
    }
}
