<?php

namespace Modules\Product\Http\Responses;

use App\Models\Attribute;
use App\Models\Product;
use App\Models\ProductImage;

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
            'slug' => $this->product->slug,
            'category' => $this->product->category,
            'discount' => $this->product->discount_id,
            'vendor_code' => new VendorCodeResponse($this->product->code),
            'price' => $this->product->price,
            'quantity' => $this->product->quantity,
            'attributes' => $this->product->attributes->map(fn(Attribute $attribute) => new AttributeResponse($attribute)),
            'images' => $this->product->images->map(fn(ProductImage $image) => new ImageResponse($image))
        ];
    }
}
