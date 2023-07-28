<?php

namespace Modules\User\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Modules\User\Dto\UpdateUserDto;

class UserService
{
    public function show()
    {
        return Auth::user();
    }

    public function update(UpdateUserDto $dto)
    {
        $user = User::find(Auth::user()->id);
        $user->update([
            'name' => $dto->getName() ?? $user->name,
            'surname' => $dto->getSurname() ?? $user->surname,
            'patronymic' => $dto->getPatronymic() ?? $user->patronymic,
            'email' => $dto->getEmail() ?? $user->email,
            'login' => $dto->getLogin() ?? $user->login,
            'phone' => $dto->getPhone() ?? $user->phone,
        ]);
        return $user;
    }
}
