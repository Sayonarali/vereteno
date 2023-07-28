<?php

namespace Modules\Product\Http\Responses;

use App\Models\Category;

class CategoryResponse implements \JsonSerializable
{
    private Category $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->category->id,
            'name' => $this->category->name,
            'description' => $this->category->description,
            'slug' => $this->category->slug,
            'level' => $this->category->level,
            'parent' => $this->category->parent->name,
        ];
    }
}
