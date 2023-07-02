<?php

namespace Modules\Cart\Http\Requests\Cart;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Cart\Dto\Cart\UpdateCartDto;

class UpdateCartRequest extends FormRequest
{
    public function getDto()
    {
        $data = $this->validated();
        return new UpdateCartDto(
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
