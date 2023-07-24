<?php

namespace Modules\Cart\Http\Requests;

use App\Models\Product;
use App\Models\VendorCode;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Cart\Dto\AddItemDto;

class AddItemRequest extends FormRequest
{
    public function getDto()
    {
        $data = $this->validated();
        return new AddItemDto($data['productId'], $data['vendorCodeId']);
    }

    public function rules()
    {
        return [
            'productId' => 'required|int|exists:' . Product::class . ',id',
            'vendorCodeId' => 'required|int|exists:' . VendorCode::class . ',id',
        ];
    }
}
