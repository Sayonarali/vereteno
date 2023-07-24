<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use HasFactory;

    public $table = 'attribute_values';

    protected $fillable = [
        'value',
        'attribute_id'
    ];

    public $timestamps = false;

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
