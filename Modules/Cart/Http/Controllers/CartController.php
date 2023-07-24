<?php

namespace Modules\Cart\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use Modules\Cart\Http\Requests\AddItemRequest;
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

    public function update(CartItem $cartItem, int $quantity)
    {
        return $this->cartService->update($cartItem, $quantity);
    }

    public function empty()
    {
        return $this->cartService->empty();
    }

    public function addItem(AddItemRequest $request)
    {
        return $this->cartService->addItem($request->getDto());
    }

    public function removeItem(CartItem $cartItem)
    {
        return $this->cartService->removeItem($cartItem);
    }
}
