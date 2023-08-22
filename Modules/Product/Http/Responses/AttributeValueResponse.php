<?php

namespace Modules\Product\Http\Responses;

use App\Models\AttributeValue;

class AttributeValueResponse implements \JsonSerializable
{
    private AttributeValue $attributeValue;
    public function __construct(AttributeValue $attributeValue)
    {
        $this->attributeValue = $attributeValue;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'attributeValueId' => $this->attributeValue->id,
            'name' => $this->attributeValue->attribute->name,
            'value' => $this->attributeValue->value,
        ];
    }
}
