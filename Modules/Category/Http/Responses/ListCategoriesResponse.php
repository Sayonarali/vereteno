<?php

namespace Modules\Category\Http\Responses;

use App\Models\Category;
use Modules\Category\Dto\ResultListCategoriesDto;

class ListCategoriesResponse implements \JsonSerializable
{
    private ResultListCategoriesDto $dto;

    public function __construct(ResultListCategoriesDto $dto)
    {
        $this->dto = $dto;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'totalCount' => $this->dto->getTotalCount(),
            'categories' => $this->dto->getCategories()->map(fn(Category $category) => new CategoryResponse($category)),
        ];
    }
}
