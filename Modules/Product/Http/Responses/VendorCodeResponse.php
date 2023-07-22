<?php

namespace Modules\Product\Http\Responses;

class VendorCodeResponse implements \JsonSerializable
{
    private  $code;
    public function __construct( $code)
    {
        $this->code = $code;
    }

    public function jsonSerialize(): mixed
    {
//        dd($this->code->products->map(fn($product) => $product->attributes));
        return [
            'id' => $this->code->id,
            'code' => $this->code->code,
            'material' => $this->code->material,
            'color' => $this->code->color,
            'size' => $this->code->size,

            'discount_id' => $this->code->pivot->discount_id,
            'price' => $this->code->pivot->price,
            'quantity' => $this->code->pivot->quantity,

//            'attributes' => $this->code->pivot->attributes->map(fn( $attribute) => new AttributeResponse($attribute))
            'attributes' => $this->code->pivot->attributes->map(fn( $attribute) => new AttributeResponse($attribute))
        ];
    }
}
