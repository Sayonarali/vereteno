<?php

namespace Modules\Cart\Services;

use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Modules\Cart\Dto\CreateCartItemDto;
use Modules\Cart\Dto\UpdateCartItemItemDto;
use Modules\Cart\Dto\ResultShowCartDto;

class CartService
{
    public function show()
    {
        $totalCount = CartItem::query()->where('user_id', Auth::user()->getAuthIdentifier())->count();

        $cartItems = CartItem::query()
            ->where('user_id', Auth::user()->getAuthIdentifier())
            ->with('product')
            ->get();

        $totalSum = $cartItems->sum(function (CartItem $item) {
           return $item->product->price * $item->quantity;
        });

        return new ResultShowCartDto($totalCount, $cartItems, $totalSum);
    }

    public function create(CreateCartItemDto $dto)
    {
        $cartItem = CartItem::create([
            'user_id' => Auth::user()->getAuthIdentifier(),
            'product_vendor_code_id' => $dto->getProductVendorCodeId(),
            'quantity' => $dto->getQuantity(),
            'size_id' => $dto->getSizeId(),
        ]);

        return $cartItem;
    }

    public function update(CartItem $cartItem, UpdateCartItemItemDto $dto)
    {
        $cartItem->update([
            'quantity' => $dto->getQuantity(),
        ]);
        return $cartItem;
    }

    public function empty()
    {
        return CartItem::query()
            ->where('user_id', Auth::user()->getAuthIdentifier())
            ->delete();
    }

    public function removeItem(CartItem $cartItem)
    {
        return $cartItem->delete();
    }
}
