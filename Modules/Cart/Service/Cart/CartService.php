<?php

namespace Modules\Cart\Service\Cart;

use App\Models\Cart;
use App\Models\CartItem;
use Modules\Cart\Dto\Cart\UpdateCartDto;
use Modules\Cart\Dto\CartItem\RemoveItemDto;

class CartService
{
    /**
     * @return mixed|string
     */
    public function show($id): mixed
    {
        return Cart::query()->with('items')->find($id);
    }

    public function update(int $id, UpdateCartDto $dto)
    {
        return Cart::query()->where('id', $id)
            ->with(['items' => function ($product) use ($dto) {
                return $product->where('id', $dto->getProductId())->update(['quantity' => $dto->getQuantity()]);
            }])->get();
    }

    public function removeItem(RemoveItemDto $dto)
    {
        CartItem::destroy($dto->getCartItemId());
    }

    public function empty($id)
    {
        CartItem::destroy($id);
    }
}
