<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'level',
        'parent_id'
    ];

    public $timestamps = false;

    public function parent()
    {
        return $this->belongsTo(static::class, 'parent_id');
    }

    public function image()
    {
        return $this->hasOne(CategoryImage::class);
    }
}
