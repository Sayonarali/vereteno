<?php

namespace Modules\Product\Http\Responses;


use App\Models\ProductVendorCodeSize;

class SizeResponse implements \JsonSerializable
{
    private ProductVendorCodeSize $size;
    public function __construct(ProductVendorCodeSize $size)
    {
        $this->size = $size;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'productSizeId' => $this->size->id,
            'size' => $this->size->size->number,
            'quantity' => $this->size->quantity,
        ];
    }
}
