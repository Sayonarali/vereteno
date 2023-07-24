<?php

namespace Modules\Order\Http\Responses;

use App\Models\Order;
use Modules\Order\Dto\ResultShowOrderDto;

class ShowOrderResponse implements \JsonSerializable
{
    private ResultShowOrderDto $dto;

    public function __construct(ResultShowOrderDto $dto)
    {
        $this->dto = $dto;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'totalCount' => $this->dto->getTotalCount(),
            'orders' => $this->dto->getOrders()->map(fn(Order $item) => new OrderResponse($item)),
        ];
    }
}
