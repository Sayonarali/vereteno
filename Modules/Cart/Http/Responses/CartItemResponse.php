<?php

namespace Modules\Cart\Http\Responses;

use App\Models\CartItem;
use App\Models\Size;
use Modules\Product\Http\Responses\SizeResponse;

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
            'productName' => $this->item->product->product->name,
            'productVendorCodeId' => $this->item->product->id,
            'inStockQuantity' => $this->item->product->sizes
                ->filter(fn(Size $size) => $size->id == $this->item->size->id)->map(fn(Size $size) => new SizeResponse($size))
                ->values(),
            'originalPrice' => $this->item->product->price,
            'discount' => $this->item->product->discount,
            'discountPrice' => empty($this->item->product->discount) ?
                null : ($this->item->product->discount * $this->item->price),
            'quantity' => $this->item->quantity,
            'size' => $this->item->size,
            'originalTotalPrice' => $this->item->product->price * $this->item->quantity,
            'discountTotalPrice' => empty($this->item->product->discount) ?
                null : ($this->item->product->discount * $this->item->price * $this->item->quantity)
        ];
    }
}
