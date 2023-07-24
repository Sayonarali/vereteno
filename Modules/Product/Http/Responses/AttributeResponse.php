<?php

namespace Modules\Product\Http\Responses;

use App\Models\Attribute;
use App\Models\AttributeValue;

class AttributeResponse implements \JsonSerializable
{
    private Attribute $attribute;
    public function __construct(Attribute $attribute)
    {
        $this->attribute = $attribute;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->attribute->id,
            'name' => $this->attribute->name,
            'values' => $this->attribute->values->map(fn(AttributeValue $attributeValue) => new AttributeValueResponse($attributeValue)),
        ];
    }
}
