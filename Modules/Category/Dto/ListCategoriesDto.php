<?php

namespace Modules\Category\Dto;

class ListCategoriesDto
{
    private int $limit;
    private int $offset;
    private ?int $level;
    private ?int $parent;

    public function __construct(int $limit,
                                int $offset,
                                ?int $level,
                                ?int $parent)
    {
        $this->limit = $limit;
        $this->offset = $offset;
        $this->level = $level;
        $this->parent = $parent;
    }

    /**
     * @return ?int
     */
    public function getLevel(): ?int
    {
        return $this->level;
    }

    /**
     * @return ?int
     */
    public function getParent(): ?int
    {
        return $this->parent;
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
}
