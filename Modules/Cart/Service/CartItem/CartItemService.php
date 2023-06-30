<?php

namespace Modules\Cart\Service\CartItem;

use App\Models\CartItem;
use Modules\Cart\Dto\CartItem\AddItemDto;
use Modules\Cart\Dto\CartItem\RemoveItemDto;

class CartItemService
{
    public function addItem(int $id, AddItemDto $dto)
    {
        return CartItem::query()->create([
            'product_id' => $dto->getProductId(),
            'cart_id' => $id,
            'quantity' => 1
        ]);
    }

    public function removeItem(RemoveItemDto $dto)
    {
        return CartItem::destroy($dto->getCartItemId());
    }
}
