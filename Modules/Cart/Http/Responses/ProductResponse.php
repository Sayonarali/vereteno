<?php

namespace Modules\Cart\Http\Responses;

use App\Models\ProductVendorCode;

class ProductResponse implements \JsonSerializable
{
    private ProductVendorCode $productVendorCode;

    public function __construct(ProductVendorCode $productVendorCode)
    {
        $this->productVendorCode = $productVendorCode;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'productName' => $this->productVendorCode->product->name,
            'productVendorCodeId' => $this->productVendorCode->id,
            'originalPrice' => $this->productVendorCode->price,
            'discount' => $this->productVendorCode->discount,
        ];
    }
}
