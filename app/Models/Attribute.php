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

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_attributes')->using(ProductAttribute::class);
    }

    public function values()
    {
        return $this->hasMany(AttributeValue::class);
    }
}
