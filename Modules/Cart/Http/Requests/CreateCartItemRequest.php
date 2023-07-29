<?php

namespace Modules\Cart\Http\Requests;

use App\Models\ProductVendorCode;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Cart\Dto\CreateCartItemDto;

class CreateCartItemRequest extends FormRequest
{
    public function getDto()
    {
        $data = $this->validated();
        return new CreateCartItemDto($data['productVendorCodeId'], $data['quantity']);
    }

    public function rules()
    {
        return [
            'productVendorCodeId' => 'required|int|exists:' . ProductVendorCode::class . ',id',
            'quantity' => 'required|int|min:1'
        ];
    }
}
