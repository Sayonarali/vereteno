<?php

namespace Modules\Cart\Http\Responses;

use App\Models\Size;

class SizeResponse implements \JsonSerializable
{
    private Size $size;

    public function __construct(Size $size)
    {
        $this->size = $size;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->size->id,
            'number' => $this->size->number,
            'quantity' => $this->size->pivot->quantity
        ];
    }
}
