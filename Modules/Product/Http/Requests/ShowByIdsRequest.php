<?php

namespace Modules\Product\Http\Requests;

use App\Models\ProductVendorCode;
use Illuminate\Foundation\Http\FormRequest;

class ShowByIdsRequest extends FormRequest
{
    public function getProductVendorCodeIds(): array
    {
        $data = $this->validated();
        return $data['productVendorCodeIds'];
    }

    public function rules()
    {
        return [
            'productVendorCodeIds' => 'required|array',
            'productVendorCodeIds.*' => 'required|int|exists:' . ProductVendorCode::class . ',id',
        ];
    }
}
