<?php

namespace Modules\Cart\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Cart\Dto\UpdateCartItemItemDto;

class UpdateCartItemRequest extends FormRequest
{
    public function getDto()
    {
        $data = $this->validated();
        return new UpdateCartItemItemDto($data['quantity']);
    }

    public function rules()
    {
        return [
            'quantity' => 'required|int|min:1'
        ];
    }
}
