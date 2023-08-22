<?php

namespace Modules\User\Http\Responses;

class UserResponse implements \JsonSerializable
{
    private $user;
    public function __construct($user)
    {
        $this->user = $user;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->user->id,
            'name' => $this->user->name,
            'surname' => $this->user->surname,
            'patronymic' => $this->user->patronymic,
            'login' => $this->user->login,
            'email' => $this->user->email,
            'phone' => $this->user->phone,
            'email_verified_at' => $this->user->email_verified_at,
            'profile_image' => $this->user->profile_image,
        ];
    }
}
