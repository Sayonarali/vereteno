<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorCode extends Model
{
    public $table = 'vendor_codes';

    use HasFactory;

    protected $fillable = [
        'code',
        'material_id',
        'color_id',
        'size_id'
    ];

    public $timestamps = false;

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_vendor_codes')
            ->using(ProductVendorCode::class)->withPivot('id', 'price', 'discount_id');
    }

    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }
}
