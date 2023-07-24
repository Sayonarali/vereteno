<?php

namespace Modules\Product\Http\Responses;

use App\Models\Product;
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
            'category' => new CategoryResponse($this->product->category),
            'vendor_codes' => $this->product->codes->map(fn(VendorCode $code) => new VendorCodeResponse($code)),
        ];
    }
}
