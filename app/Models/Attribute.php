<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    public $table = 'attributes';

    protected $fillable = [
        'name',
    ];

    public $timestamps = false;

    public function values()
    {
        return $this->hasMany(AttributeValue::class);
    }

//    public function codes()
//    {
//        return $this->belongsToMany(ProductVendorCode::class, 'product_vendor_code_attributes')
//            ->using(ProductVendorCodeAttribute::class);
//    }
}
