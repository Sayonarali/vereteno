<?php

namespace Modules\Cart\Http\Requests\CartItem;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Cart\Dto\CartItem\AddItemDto;

class AddItemRequest extends FormRequest
{
    public function getDto()
    {
        $data = $this->validated();
        return new AddItemDto(
            $data['productId']
        );
    }

    public function rules()
    {
        return [
            'productId' => 'required|int|exists:' . Product::class . ',id'
        ];
    }
}
