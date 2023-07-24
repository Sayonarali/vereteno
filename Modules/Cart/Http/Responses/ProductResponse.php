<?php

namespace Modules\Cart\Http\Responses;

use App\Models\CartItem;
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
            'productId' => $this->productVendorCode->product_id,
            'vendorCodeId' => $this->productVendorCode->vendor_code_id,
            'price' => $this->productVendorCode->price,
            'discount_id' => $this->productVendorCode->discount_id,
            'quantity' => $this->productVendorCode->quantity
        ];
    }
}
