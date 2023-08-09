<?php

namespace Modules\Cart\Dto;

class CreateCartItemDto
{
    private int $productVendorCodeId;
    private int $quantity;
    private int $sizeId;

    public function __construct(int $productVendorCodeId, int $quantity, int $sizeId)
    {
        $this->productVendorCodeId = $productVendorCodeId;
        $this->quantity = $quantity;
        $this->sizeId = $sizeId;
    }

    public function getSizeId(): int
    {
        return $this->sizeId;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @return int
     */
    public function getProductVendorCodeId(): int
    {
        return $this->productVendorCodeId;
    }
}
