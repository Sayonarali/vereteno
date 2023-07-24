<?php

namespace Modules\Order\Http\Responses;

use App\Models\Order;
use App\Models\OrderItem;

class OrderResponse implements \JsonSerializable
{
    private Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function jsonSerialize()
    {
        return [
            'orderId' => $this->order->id,
            'status' => $this->order->status,
            'total' => $this->order->total,
            'paymentStatus' => $this->order->payment_status,
            'paymentMethod' => $this->order->payment_method,
            'orderItems' => $this->order->items->map(fn(OrderItem $item) => new OrderItemResponse($item)),
        ];
    }
}
