<?php

namespace Modules\User\Dto;

class UpdateUserDto
{
    private ?string $name;
    private ?string $surname;
    private ?string $patronymic;
    private ?string $login;
    private ?string $email;
    private ?string $phone;

    public function __construct(?string $name,
                                ?string $surname,
                                ?string $patronymic,
                                ?string $login,
                                ?string $email,
                                ?string $phone)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->patronymic = $patronymic;
        $this->login = $login;
        $this->email = $email;
        $this->phone = $phone;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function getLogin(): ?string
    {
        return $this->login;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getPatronymic(): ?string
    {
        return $this->patronymic;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @return string|null
     */
    public function getSurname(): ?string
    {
        return $this->surname;
    }

}
