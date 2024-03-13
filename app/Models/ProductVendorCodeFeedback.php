<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVendorCodeFeedback extends Model
{
    use HasFactory;

    public $table = 'product_vendor_code_feedbacks';

    protected $fillable = [
        'user_id',
        'product_vendor_code_id',
        'comment',
        'rating',
    ];

    public $timestamps = false;

    public function code()
    {
        return $this->belongsTo(ProductVendorCode::class, 'product_vendor_code_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
