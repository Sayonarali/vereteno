<?php

namespace Modules\Cart\Http\Requests;

use App\Models\Product;
use App\Models\ProductVendorCode;
use App\Models\VendorCode;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Cart\Dto\CreateUpdateCartItemItemDto;

class CreateUpdateCartItemRequest extends FormRequest
{
    public function getDto()
    {
        $data = $this->validated();
        return new CreateUpdateCartItemItemDto($data['productVendorCodeId'], $data['quantity']);
    }

    public function rules()
    {
        return [
            'productVendorCodeId' => 'required|int|exists:' . ProductVendorCode::class . ',id',
            'quantity' => 'nullable|int|min:1'
        ];
    }
}
