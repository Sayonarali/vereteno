<?php

namespace Modules\Cart\Http\Responses;

use App\Models\CartItem;

class CartItemResponse implements \JsonSerializable
{
    private CartItem $item;

    public function __construct(CartItem $item)
    {
        $this->item = $item;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->item->id,
            'product' => new ProductResponse($this->item->product),
            'quantity' => $this->item->quantity
        ];
    }
}
