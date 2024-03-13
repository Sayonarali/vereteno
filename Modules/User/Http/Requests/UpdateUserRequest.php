<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\User\Dto\UpdateUserDto;

class UpdateUserRequest extends FormRequest
{
    public function getDto()
    {
        $data = $this->validated();
        return new UpdateUserDto(
            $data['name'] ?? null,
            $data['surname'] ?? null,
            $data['patronymic'] ?? null,
            $data['login'] ?? null,
            $data['email'] ?? null,
            $data['phone'] ?? null,
        );
    }

    public function rules()
    {
        return [
            'name' => 'nullable|string',
            'surname' => 'nullable|string',
            'patronymic' => 'nullable|string',
            'email' => 'nullable|string|email|max:255',
            'login' => 'nullable|string|max:255',
            'phone' => 'nullable|string',
        ];
    }
}
