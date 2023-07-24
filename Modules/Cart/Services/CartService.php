<?php

namespace Modules\Cart\Services;

use App\Models\CartItem;
use App\Models\ProductVendorCode;
use Illuminate\Support\Facades\Auth;
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

        return new ResultShowCartDto($totalCount, $cartItems);
    }

    public function update(CartItem $cartItem, int $quantity)
    {
        return $cartItem->update([
            'quantity' => $quantity,
        ]);
    }

    public function empty()
    {
        return CartItem::query()
            ->where('user_id', Auth::user()->getAuthIdentifier())
            ->delete();
    }

    public function addItem(ProductVendorCode $product)
    {
        return CartItem::query()->create([
            'user_id' => Auth::user()->getAuthIdentifier(),
            'product_vendor_code_id' => $product->id,
            'quantity' => 1,
        ]);
    }

    public function removeItem(CartItem $cartItem)
    {
        return $cartItem->delete();
    }
}
