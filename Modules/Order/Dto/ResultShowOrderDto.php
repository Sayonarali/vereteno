<?php

namespace Modules\Order\Dto;

use Illuminate\Support\Collection;

class ResultShowOrderDto
{
    private int $totalCount;
    private Collection $orders;

    public function __construct(int        $totalCount,
                                Collection $orders)
    {
        $this->totalCount = $totalCount;
        $this->orders = $orders;
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
    public function getOrders(): Collection
    {
        return $this->orders;
    }
}
