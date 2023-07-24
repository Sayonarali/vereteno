<?php

namespace Modules\Order\Dto;

use Illuminate\Support\Collection;

class CreateUpdateOrderDto
{

    private ?string $status;
    private ?string $paymentStatus;
    private ?string $paymentMethod;
    private ?Collection $cartItemIds;
    private ?string $country;
    private ?string $region;
    private ?string $city;
    private ?string $street;
    private ?int $postcode;

    public function __construct(?string $status,
                                ?string $paymentStatus,
                                ?string $paymentMethod,
                                ?Collection    $cartItemIds,
                                ?string $country,
                                ?string $region,
                                ?string $city,
                                ?string $street,
                                ?int    $postcode)
    {

        $this->status = $status;
        $this->paymentStatus = $paymentStatus;
        $this->paymentMethod = $paymentMethod;
        $this->cartItemIds = $cartItemIds;
        $this->country = $country;
        $this->region = $region;
        $this->city = $city;
        $this->street = $street;
        $this->postcode = $postcode;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @return string|null
     */
    public function getPaymentStatus(): ?string
    {
        return $this->paymentStatus;
    }

    /**
     * @return string|null
     */
    public function getPaymentMethod(): ?string
    {
        return $this->paymentMethod;
    }

    /**
     * @return Collection|null
     */
    public function getCartItemIds(): ?Collection
    {
        return $this->cartItemIds;
    }

    /**
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @return string|null
     */
    public function getRegion(): ?string
    {
        return $this->region;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @return int|null
     */
    public function getPostcode(): ?int
    {
        return $this->postcode;
    }
}
