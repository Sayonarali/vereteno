<?php

namespace Modules\Product\Http\Responses;

use App\Models\Attribute;

class AttributeResponse implements \JsonSerializable
{
    private  $attribute;
    public function __construct( $attribute)
    {
        $this->attribute = $attribute;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->attribute->id,
            'name' => $this->attribute->name,
        ];
    }
}
