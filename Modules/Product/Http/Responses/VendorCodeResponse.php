<?php

namespace Modules\Product\Http\Responses;

use App\Models\AttributeValue;
use App\Models\ProductVendorCodeImage;
use App\Models\VendorCode;

class VendorCodeResponse implements \JsonSerializable
{
    private VendorCode $code;
    public function __construct(VendorCode $code)
    {
        $this->code = $code;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->code->id,
            'code' => $this->code->code,
            'material' => $this->code->material->name,
            'color' => $this->code->color,
            'size' => $this->code->size->number,
            'discount' => $this->code->discount,
            'price' => $this->code->pivot->price,
            'quantity' => $this->code->pivot->quantity,
            'productVendorCodeId' => $this->code->pivot->id,
            'images' => $this->code->pivot->images->map(fn(ProductVendorCodeImage $image) => new ImageResponse($image)),
            'attributes' => $this->code->pivot->attributes->map(fn(AttributeValue $attributeValue) => new AttributeValueResponse($attributeValue))
        ];
    }
}
