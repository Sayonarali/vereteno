<?php

namespace Modules\Category\Services;

use App\Models\Category;
use Modules\Category\Dto\ListCategoriesDto;
use Modules\Category\Dto\ResultListCategoriesDto;

class CategoryService
{
    public function index(ListCategoriesDto $dto)
    {
        $categories = Category::query()
            ->when($dto->getLevel(), function ($query) use ($dto) {
                $query->where('level', $dto->getLevel());
            })
            ->when($dto->getParent(), function ($query) use ($dto) {
                $query->where('parent_id', $dto->getParent());
            })
            ->limit($dto->getLimit())->offset($dto->getOffset())
            ->get();

        return new ResultListCategoriesDto(
            Category::all()->count(),
            $categories
        );
    }
}
