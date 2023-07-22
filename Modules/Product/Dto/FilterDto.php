<?php

namespace Modules\Product\Dto;

use Illuminate\Support\Collection;

class FilterDto
{
    private Collection $materials;

    private Collection $sizes;

    private Collection $colors;
    private Collection $attributes;

    public function __construct(Collection $materials,
                                Collection $sizes,
                                Collection $colors,
                                Collection $attributes)
    {
        $this->materials = $materials;
        $this->sizes = $sizes;
        $this->colors = $colors;
        $this->attributes = $attributes;
    }

    /**
     * @return Collection
     */
    public function getAttributes(): Collection
    {
        return $this->attributes;
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
