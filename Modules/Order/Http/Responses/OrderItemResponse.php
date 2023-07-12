<?php

namespace Modules\Order\Http\Responses;

use App\Models\OrderItem;

class OrderItemResponse implements \JsonSerializable
{
    private OrderItem $item;

    public function __construct(OrderItem $item)
    {
        $this->item = $item;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->item->id,
            'product' => new ProductResponse($this->item->product),
            'price' => $this->item->price,
            'amount' => $this->item->amount,
            'quantity' => $this->item->quantity
        ];
    }
}
