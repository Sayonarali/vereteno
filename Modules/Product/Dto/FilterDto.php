<?php

namespace Modules\Product\Dto;

use Illuminate\Support\Collection;

class FilterDto
{
    private Collection $materials;

    private Collection $sizes;

    private Collection $colors;

    public function __construct(Collection $materials,
                                Collection $sizes,
                                Collection $colors)
    {
        $this->materials = $materials;
        $this->sizes = $sizes;
        $this->colors = $colors;
    }

    /**
     * @return Collection
     */
    public function getMaterials(): Collection
    {
        return $this->materials;
    }

    /**
     * @return Collection
     */
    public function getSizes(): Collection
    {
        return $this->sizes;
    }

    /**
     * @return Collection
     */
    public function getColors(): Collection
    {
        return $this->colors;
    }
}
