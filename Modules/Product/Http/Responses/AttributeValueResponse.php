<?php

namespace Modules\Product\Http\Responses;

use App\Models\AttributeValue;

class AttributeValueResponse implements \JsonSerializable
{
    private AttributeValue $attribute;
    public function __construct(AttributeValue $attribute)
    {
        $this->attribute = $attribute;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->attribute->id,
            'name' => $this->attribute->attribute->name,
            'value' => $this->attribute->value,
        ];
    }
}
