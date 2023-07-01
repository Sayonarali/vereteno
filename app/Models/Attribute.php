<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'value',
    ];

    public $timestamps = false;

    public function products()
    {
        return $this->belongsToMany(Product::class)->using(ProductAttribute::class);
    }
}
