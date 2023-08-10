<?php

namespace Modules\Product\Http\Responses;

use App\Models\AttributeValue;
use App\Models\ProductVendorCodeImage;
use App\Models\ProductVendorCodeSize;
use App\Models\Size;
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
            'material' => $this->code->material ? '' : $this->code->material->name,
            'color' => $this->code->color,
            'discount' => $this->code->discount,
            'price' => $this->code->pivot->price,
            'sizes' => $this->code->pivot->sizes->map(fn(Size $size) => new SizeResponse($size)),
            'productVendorCodeId' => $this->code->pivot->id,
            'images' => $this->code->pivot->images->map(fn(ProductVendorCodeImage $image) => new ImageResponse($image)),
            'attributes' => $this->code->pivot->attributes->map(fn(AttributeValue $attributeValue) => new AttributeValueResponse($attributeValue))
        ];
    }
}
