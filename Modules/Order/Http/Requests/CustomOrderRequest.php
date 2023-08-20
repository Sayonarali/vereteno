<?php

namespace Modules\Order\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Order\Dto\CustomOrderDto;

class CustomOrderRequest extends FormRequest
{
    public function getDto()
    {
        $data = $this->validated();
        return new CustomOrderDto($data['phone'], $data['name'], $data['description']);
    }

    public function rules()
    {
        return [
            'phone' => 'required|string',
            'name' => 'required|string',
            'description' => 'required|string',
        ];
    }
}
