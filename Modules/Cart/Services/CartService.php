<?php

namespace Modules\Cart\Services;

use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Modules\Cart\Dto\ResultShowCartDto;
use Modules\Cart\Dto\UpdateCartItemDto;

class CartService
{
    public function show()
    {
        $totalCount = CartItem::query()->where('user_id', Auth::user()->getAuthIdentifier())->count();

        $cartItems = CartItem::query()
            ->where('user_id', Auth::user()->getAuthIdentifier())
            ->with('product')
            ->get();

        return new ResultShowCartDto($totalCount, $cartItems);
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
