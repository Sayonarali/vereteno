<?php

namespace Modules\Product\Http\Responses;

use App\Models\ProductVendorCode;
use Modules\Product\Dto\ResultListProductVendorCodeDto;

class ListProductVendorCodesResponse implements \JsonSerializable
{
    private ResultListProductVendorCodeDto $dto;

    public function __construct(ResultListProductVendorCodeDto $dto)
    {
        $this->dto = $dto;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'totalCount' => $this->dto->getTotalCount(),
            'productVendorCodes' => $this->dto->getProductVendorCodes()
                ->map(fn(ProductVendorCode $productVendorCode) => new ProductVendorCodeResponse($productVendorCode)),
        ];
    }
}
