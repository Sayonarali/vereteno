<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_vendor_code_id',
        'quantity',
        'size_id',
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(ProductVendorCode::class, 'product_vendor_code_id');
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }
}
