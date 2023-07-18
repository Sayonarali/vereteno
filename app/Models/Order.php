<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const NEW_ORDER_STATUS = 'new';
    const PROCESS_ORDER_STATUS = 'process';
    const DELIVERED_ORDER_STATUS = 'delivered';
    const CANCEL_ORDER_STATUS = 'cancel';

    const PAID_PAYMENT_STATUS = 'paid';
    const UNPAID_PAYMENT_STATUS = 'unpaid';

    const ONLINE_PAYMENT_METHOD = 'online';
    const OFFLINE_PAYMENT_METHOD = 'offline';

    protected $fillable = [
        'user_id',
        'status',
        'total',
        'payment_status',
        'payment_method'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function address()
    {
        return $this->hasOne(OrderAddress::class);
    }
}
