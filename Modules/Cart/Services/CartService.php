<?php

namespace Modules\Cart\Services;

use App\Models\CartItem;
use App\Models\ProductVendorCode;
use Illuminate\Support\Facades\Auth;
use Modules\Cart\Dto\CreateUpdateCartItemItemDto;
use Modules\Cart\Dto\ResultShowCartDto;
use Modules\Order\Dto\CreateUpdateOrderDto;

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
           return $item->product->price;
        });

        return new ResultShowCartDto($totalCount, $cartItems, $totalSum);
    }

    public function update(CartItem $cartItem, CreateUpdateCartItemItemDto $dto)
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

    public function create(CreateUpdateCartItemItemDto $dto)
    {
        return CartItem::query()->create([
            'user_id' => Auth::user()->getAuthIdentifier(),
            'product_vendor_code_id' => $dto->getProductVendorCodeId(),
            'quantity' => 1,
        ]);
    }

    public function removeItem(CartItem $cartItem)
    {
        return $cartItem->delete();
    }
}
