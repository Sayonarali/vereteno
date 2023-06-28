<?php

namespace Modules\Cart\Http\Requests\Cart;

use App\Models\CartItem;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Cart\Dto\CartItem\RemoveItemDto;

class DeleteItemRequest extends FormRequest
{
    public function getDto()
    {
        $data = $this->validated();
        return new RemoveItemDto(
            $data['cartItemId']
        );
    }

    public function rules()
    {
        return [
            'cartItemId' => 'required|int|exists:' . CartItem::class . ',id'
        ];
    }
}
