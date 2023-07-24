<?php

namespace Modules\Order\Http\Responses;

use App\Models\Product;

class ProductResponse implements \JsonSerializable
{
    private Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->product->id,
            'name' => $this->product->name,
            'description' => $this->product->description,
            'images' => $this->product->images,
        ];
    }
}
