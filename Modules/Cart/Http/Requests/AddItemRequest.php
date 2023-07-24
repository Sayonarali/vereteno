<?php

namespace Modules\Cart\Http\Requests;

use App\Models\Product;
use App\Models\ProductVendorCode;
use App\Models\VendorCode;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Cart\Dto\AddItemDto;

class AddItemRequest extends FormRequest
{
    public function getDto()
    {
        $data = $this->validated();
        return new AddItemDto($data['productVendorCodeId']);
    }

    public function rules()
    {
        return [
            'productVendorCodeId' => 'required|int|exists:' . ProductVendorCode::class . ',id'
        ];
    }
}
