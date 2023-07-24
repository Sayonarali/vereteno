<?php

namespace Modules\Cart\Dto;

use Illuminate\Support\Collection;

class AddItemDto
{
    private int $productId;
    private int $vendorCodeId;

    public function __construct(int $productId,
                                int $vendorCodeId)
    {

        $this->productId = $productId;
        $this->vendorCodeId = $vendorCodeId;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * @return int
     */
    public function getVendorCodeId(): int
    {
        return $this->vendorCodeId;
    }
}
