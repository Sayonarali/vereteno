<?php

namespace Modules\Product\Http\Responses;

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
            'material' => $this->code->material,
            'color' => $this->code->color,
            'size' => $this->code->size,
        ];
    }
}
