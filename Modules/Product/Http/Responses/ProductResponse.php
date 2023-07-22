<?php

namespace Modules\Product\Http\Responses;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\VendorCode;

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
            'images' => $this->product->images->map(fn(ProductImage $image) => new ImageResponse($image)),

            'vendor_codes' => $this->product->codes->map(fn($code) => new VendorCodeResponse($code)),
        ];
    }
}
