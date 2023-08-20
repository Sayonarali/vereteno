<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
    ];

    public $timestamps = false;

    public function products()
    {
        return $this->belongsToMany(ProductVendorCode::class, 'product_vendor_code_sizes', 'size_id', 'size_id')
            ->using(ProductVendorCodeSize::class)->withPivot('id', 'quantity');
    }
}
