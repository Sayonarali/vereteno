<?php

namespace Modules\Cart\Service\Cart;

use App\Models\CartItem;
use Modules\Cart\Dto\Cart\UpdateCartItemDto;

class CartService
{
    /**
     * @return mixed|string
     */
    public function show($userId): mixed
    {
        return CartItem::query()->where('user_id', $userId)->with('products')->get();
    }

    public function update(int $id, UpdateCartItemDto $dto)
    {
        return CartItem::query()->where('id', $id)
            ->with(['items' => function ($product) use ($dto) {
                return $product->where('product_id', $dto->getProductId())->update(['quantity' => $dto->getQuantity()]);
            }])->get();
    }

    public function empty(int $id)
    {
    }
}
