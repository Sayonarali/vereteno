<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statpage extends Model
{
    use HasFactory;

    protected $fillable = [
        'alias',
        'title',
        'content',
        'path',
        'meta_description',
        'meta_keywords'
    ];

    public $timestamps = false;
}
