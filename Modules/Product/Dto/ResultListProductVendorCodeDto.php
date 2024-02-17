<?php

namespace Modules\Product\Dto;

use Illuminate\Support\Collection;

class ResultListProductVendorCodeDto
{
    private int $totalCount;
    private Collection $productVendorCodes;

    public function __construct(int        $totalCount,
                                Collection $productVendorCodes)
    {
        $this->totalCount = $totalCount;
        $this->productVendorCodes = $productVendorCodes;
    }

    /**
     * @return int
     */
    public function getTotalCount(): int
    {
        return $this->totalCount;
    }

    /**
     * @return Collection
     */
    public function getProductVendorCodes(): Collection
    {
        return $this->productVendorCodes;
    }
}
