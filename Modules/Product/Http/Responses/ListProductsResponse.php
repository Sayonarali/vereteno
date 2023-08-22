<?php

namespace Modules\Product\Http\Responses;

use App\Models\Product;
use Modules\Product\Dto\ResultListProductsDto;

class ListProductsResponse implements \JsonSerializable
{
    private ResultListProductsDto $dto;

    public function __construct(ResultListProductsDto $dto)
    {
        $this->dto = $dto;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'totalCount' => $this->dto->getTotalCount(),
            'products' => $this->dto->getProducts()->map(fn(Product $product) => new ProductResponse($product)),
        ];
    }
}
