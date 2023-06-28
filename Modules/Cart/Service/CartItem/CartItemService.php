<?php

namespace Modules\Cart\Service\CartItem;

use App\Models\CartItem;
use Modules\Cart\Dto\CartItem\RemoveItemDto;

class CartItemService
{
    public function removeItem(RemoveItemDto $dto)
    {
        CartItem::destroy($dto->getCartItemId());
    }
}
