<?php

namespace Modules\Product\Dto;

class ListProductsDto
{
    private int $limit;
    private int $offset;
    private ?string $sortBy;
    private ?bool $sortDesc;
    private FilterDto $filterDto;
    private ?string $search;

    public function __construct(int       $limit,
                                int       $offset,
                                ?string   $sortBy,
                                ?bool     $sortDesc,
                                ?string   $search,
                                FilterDto $filterDto)
    {
        $this->limit = $limit;
        $this->offset = $offset;
        $this->sortBy = $sortBy;
        $this->sortDesc = $sortDesc;
        $this->filterDto = $filterDto;
        $this->search = $search;
    }

    /**
     * @return string|null
     */
    public function getSearch(): ?string
    {
        return $this->search;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @return string|null
     */
    public function getSortBy(): ?string
    {
        return $this->sortBy;
    }

    /**
     * @return bool|null
     */
    public function getSortDesc(): ?bool
    {
        return $this->sortDesc;
    }

    /**
     * @return FilterDto
     */
    public function getFilterDto(): FilterDto
    {
        return $this->filterDto;
    }
}
