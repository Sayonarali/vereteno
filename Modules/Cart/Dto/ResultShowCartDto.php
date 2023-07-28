<?php

namespace Modules\Cart\Dto;

use Illuminate\Support\Collection;

class ResultShowCartDto
{
    private int $totalCount;
    private Collection $items;
    private $totalSum;

    public function __construct(int        $totalCount,
                                Collection $items,
                                           $totalSum)
    {
        $this->totalCount = $totalCount;
        $this->items = $items;
        $this->totalSum = $totalSum;
    }

    public function getTotalSum()
    {
        return $this->totalSum;
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
    public function getItems(): Collection
    {
        return $this->items;
    }
}
