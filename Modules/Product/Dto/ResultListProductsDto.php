<?php

namespace Modules\Product\Dto;

use Illuminate\Support\Collection;

class ResultListProductsDto
{
    private int $totalCount;
    private Collection $products;

    public function __construct(int        $totalCount,
                                Collection $products)
    {
        $this->totalCount = $totalCount;
        $this->products = $products;
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
    public function getProducts(): Collection
    {
        return $this->products;
    }
}
