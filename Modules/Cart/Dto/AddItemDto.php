<?php

namespace Modules\Cart\Dto;

class AddItemDto
{
    private int $productVendorCodeId;

    public function __construct(int $productVendorCodeId)
    {
        $this->productVendorCodeId = $productVendorCodeId;
    }

    /**
     * @return int
     */
    public function getProductVendorCodeId(): int
    {
        return $this->productVendorCodeId;
    }
}
