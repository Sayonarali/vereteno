<?php

namespace Modules\Category\Dto;

use Illuminate\Support\Collection;

class ResultListCategoriesDto
{
    private int $totalCount;
    private Collection $categories;

    public function __construct(int        $totalCount,
                                Collection $categories)
    {
        $this->totalCount = $totalCount;
        $this->categories = $categories;
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
    public function getCategories(): Collection
    {
        return $this->categories;
    }
}
