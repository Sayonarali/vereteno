<?php

namespace Modules\Cart\Service\Cart;

use App\Models\Cart;
use Modules\Cart\Dto\Cart\UpdateCartDto;

class CartService
{
    /**
     * @return mixed|string
     */
    public function show($userId): mixed
    {
        return Cart::query()->where('user_id', $userId)->with('products')->get();
    }

    public function update(int $id, UpdateCartDto $dto)
    {
        return Cart::query()->where('id', $id)
            ->with(['items' => function ($product) use ($dto) {
                return $product->where('product_id', $dto->getProductId())->update(['quantity' => $dto->getQuantity()]);
            }])->get();
    }

    public function empty(int $id)
    {
    }
}
