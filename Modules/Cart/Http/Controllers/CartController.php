<?php

namespace Modules\Cart\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Modules\Cart\Http\Requests\Cart\UpdateCartRequest;
use Modules\Cart\Service\Cart\CartService;

class CartController extends Controller
{
    private CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function show()
    {
        $userId = Auth::user()->getAuthIdentifier();
        return Cart::query()->where('user_id', $userId)->with('product')->get();
    }

    public function addProduct(Product $product)
    {
        return Cart::query()->create([
            'user_id' => Auth::user()->id,
            'product_id' => $product->id,
            'price' => $product->price,
            'amount' => $product->price,
            'quantity' => 1,
        ]);
    }

    public function removeProduct(Product $product)
    {
        $userId = Auth::user()->getAuthIdentifier();
        return Cart::query()->where('user_id', $userId)->where('product_id', $product->id)->delete();
    }

    public function update(UpdateCartRequest $request)
    {
        $userId = Auth::user()->getAuthIdentifier();
        $dto = $request->getDto();
        $product = Product::find($dto->getProductId());

        Cart::query()->where('user_id', $userId)->where('product_id', $dto->getProductId())
            ->update([
                'quantity' => $dto->getQuantity(),
                'amount' => $dto->getQuantity() * $product->price,
            ]);

    }

    public function empty()
    {
        $userId = Auth::user()->getAuthIdentifier();
        return Cart::query()->where('user_id', $userId)->delete();
    }
}
