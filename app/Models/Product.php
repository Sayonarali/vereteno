<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'slug',
        'category_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function codes()
    {
        return $this->belongsToMany(VendorCode::class, 'product_vendor_codes')
            ->using(ProductVendorCode::class)->withPivot('id', 'price', 'discount_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
