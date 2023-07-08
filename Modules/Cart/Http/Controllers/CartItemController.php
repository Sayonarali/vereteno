<?php

namespace Modules\Cart\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Modules\Cart\Http\Requests\UpdateCartItemRequest;
use Modules\Cart\Service\Cart\CartService;

class CartItemController extends Controller
{
    private CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function show()
    {
        $userId = Auth::user()->getAuthIdentifier();
        return CartItem::query()->where('user_id', $userId)->with('product')->get();
    }

    public function addItem(Product $product)
    {
        return CartItem::query()->create([
            'user_id' => Auth::user()->id,
            'product_id' => $product->id,
            'price' => $product->price,
            'amount' => $product->price,
            'quantity' => 1,
        ]);
    }

    public function removeItem(int $id)
    {
        return CartItem::find($id)->delete();
    }

    public function update(UpdateCartItemRequest $request)
    {
        $userId = Auth::user()->getAuthIdentifier();
        $dto = $request->getDto();
        $product = Product::find($dto->getProductId());

        CartItem::query()->where('user_id', $userId)->where('product_id', $dto->getProductId())
            ->update([
                'quantity' => $dto->getQuantity(),
                'amount' => $dto->getQuantity() * $product->price,
            ]);

    }

    public function empty()
    {
        $userId = Auth::user()->getAuthIdentifier();
        return CartItem::query()->where('user_id', $userId)->delete();
    }
}
