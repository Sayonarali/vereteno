<?php

namespace Modules\Cart\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Cart\Dto\UpdateCartItemDto;

class UpdateCartItemRequest extends FormRequest
{
    public function getDto()
    {
        $data = $this->validated();
        return new UpdateCartItemDto(
            $data['productId'],
            $data['quantity']
        );
    }

    public function rules()
    {
        return [
            'productId' => 'required|int|exists:' . Product::class . ',id',
            'quantity' => 'required|int|min:1'
        ];
    }
}
