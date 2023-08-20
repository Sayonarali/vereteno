<?php

namespace Modules\Cart\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use Modules\Cart\Http\Requests\CreateCartItemRequest;
use Modules\Cart\Http\Requests\UpdateCartItemRequest;
use Modules\Cart\Http\Responses\CartItemResponse;
use Modules\Cart\Http\Responses\ShowCartResponse;
use Modules\Cart\Services\CartService;

class CartController extends Controller
{
    private CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function show()
    {
        return new ShowCartResponse($this->cartService->show());
    }

    public function create(CreateCartItemRequest $request)
    {
        return $this->cartService->create($request->getDto())->map(fn(CartItem $item) => new CartItemResponse($item));
    }

    public function update(CartItem $cartItem, UpdateCartItemRequest $request)
    {
        return new CartItemResponse($this->cartService->update($cartItem, $request->getDto()));
    }

    public function empty()
    {
        return $this->cartService->empty();
    }

    public function removeItem(CartItem $cartItem)
    {
        return $this->cartService->removeItem($cartItem);
    }
}
