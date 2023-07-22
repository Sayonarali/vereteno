<?php

namespace Modules\Product\Http\Responses;

use App\Models\AttributeValue;
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
            'code' => $this->code->code,
            'material' => $this->code->material->name,
            'color' => $this->code->color,
            'size' => $this->code->size->number,
            'discount_id' => $this->code->pivot->discount_id,
            'price' => $this->code->pivot->price,
            'quantity' => $this->code->pivot->quantity,
            'attributes' => $this->code->pivot->attributes->map(fn(AttributeValue $attribute) => new AttributeValueResponse($attribute))
        ];
    }
}
