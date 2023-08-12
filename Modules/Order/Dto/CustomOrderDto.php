<?php

namespace Modules\Order\Dto;

use Illuminate\Support\Collection;

class CustomOrderDto
{
    private string $phone;
    private string $name;
    private string $description;

    public function __construct(string $phone, string $name, string $description)
    {
        $this->phone = $phone;
        $this->name = $name;
        $this->description = $description;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
