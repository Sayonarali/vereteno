<?php

namespace Modules\Cart\Http\Requests;

use App\Models\ProductVendorCode;
use App\Models\Size;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Cart\Dto\CreateCartItemDto;

class CreateCartItemRequest extends FormRequest
{
    public function getDto()
    {
        $data = $this->validated();
        return new CreateCartItemDto($data['productVendorCodeIds'], $data['quantity'], $data['sizeIds']);
    }

    public function rules()
    {
        return [
            'productVendorCodeIds' => 'required|array',
            'productVendorCodeIds.*' => 'required|int|exists:' . ProductVendorCode::class . ',id',
            'quantity' => 'required|array',
            'quantity.*' => 'required|int|min:1',
            'sizeIds' => 'required|array',
            'sizeIds.*' => 'required|int|exists:' . Size::class . ',id'
        ];
    }
}
