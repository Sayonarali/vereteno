<?php

namespace Modules\Cart\Dto;

use Illuminate\Support\Collection;

class CreateCartItemDto
{
    private Collection $productVendorCodeIds;
    private Collection $quantity;
    private Collection $sizeIds;

    public function __construct(Collection $productVendorCodeIds, Collection $quantity, Collection $sizeIds)
    {
        $this->productVendorCodeIds = $productVendorCodeIds;
        $this->quantity = $quantity;
        $this->sizeIds = $sizeIds;
    }

    public function getSizeIds(): Collection
    {
        return $this->sizeIds;
    }

    /**
     * @return Collection
     */
    public function getQuantity(): Collection
    {
        return $this->quantity;
    }

    /**
     * @return Collection
     */
    public function getProductVendorCodeIds(): Collection
    {
        return $this->productVendorCodeIds;
    }
}
