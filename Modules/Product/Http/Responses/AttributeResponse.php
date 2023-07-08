<?php

namespace Modules\Product\Http\Responses;

use App\Models\Attribute;

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
            'type' => $this->attribute->type,
            'value' => $this->attribute->value,
        ];
    }
}
