<?php

namespace Modules\Cart\Dto;

class CreateUpdateCartItemItemDto
{
    private int $productVendorCodeId;
    private int $quantity;

    public function __construct(int $productVendorCodeId, int $quantity)
    {
        $this->productVendorCodeId = $productVendorCodeId;
        $this->quantity = $quantity;
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
