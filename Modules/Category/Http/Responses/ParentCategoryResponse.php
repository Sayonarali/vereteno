<?php

namespace Modules\Category\Http\Responses;

use App\Models\Category;

class ParentCategoryResponse implements \JsonSerializable
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
//            'name' => $this->category->name,
//            'level' => $this->category->level,
        ];
    }
}
