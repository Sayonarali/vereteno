<?php

namespace Modules\Order\Services;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Modules\Order\Dto\ResultShowOrderDto;

class OrderService
{
    public function show()
    {
        $totalCount = Order::query()->where('user_id', Auth::user()->getAuthIdentifier())->count();

        $orderItems = Order::query()
            ->where('user_id', Auth::user()->getAuthIdentifier())
            ->with('items')
            ->get();

        return new ResultShowOrderDto($totalCount, $orderItems);
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

    public function addItem(Product $product)
    {
        return CartItem::query()->create([
            'user_id' => Auth::user()->getAuthIdentifier(),
            'product_id' => $product->id,
            'quantity' => 1,
        ]);
    }

    public function removeItem(CartItem $cartItem)
    {
        return $cartItem->delete();
    }
}
