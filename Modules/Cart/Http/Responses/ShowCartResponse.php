<?php

namespace Modules\Cart\Http\Responses;

use App\Models\CartItem;
use Modules\Cart\Dto\ResultShowCartDto;

class ShowCartResponse implements \JsonSerializable
{
    private ResultShowCartDto $dto;

    public function __construct(ResultShowCartDto $dto)
    {
        $this->dto = $dto;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'totalCount' => $this->dto->getTotalCount(),
            'items' => $this->dto->getItems()->map(fn(CartItem $item) => new CartItemResponse($item)),
        ];
    }
}
