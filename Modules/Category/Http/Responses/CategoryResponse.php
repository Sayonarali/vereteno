<?php

namespace Modules\Category\Http\Responses;

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
            'parent' => new ParentCategoryResponse($this->category->parent),
            'image' => $this->category->image->path
        ];
    }
}
