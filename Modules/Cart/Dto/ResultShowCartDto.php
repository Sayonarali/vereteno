<?php

namespace Modules\Cart\Dto;

use Illuminate\Support\Collection;

class ResultShowCartDto
{
    private int $totalCount;
    private Collection $items;

    public function __construct(int        $totalCount,
                                Collection $items)
    {
        $this->totalCount = $totalCount;
        $this->items = $items;
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
