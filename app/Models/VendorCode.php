<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'material_id',
        'color_id',
        'size_id'
    ];

    public function material()
    {
        return $this->hasOne(Material::class);
    }

    public function color()
    {
        return $this->hasOne(Color::class);
    }

    public function size()
    {
        return $this->hasOne(Size::class);
    }
}
