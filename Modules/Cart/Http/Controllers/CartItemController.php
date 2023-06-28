<?php

namespace Modules\Cart\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Cart\Http\Requests\CartItem\AddItemRequest;
use Modules\Cart\Http\Requests\CartItem\DeleteItemRequest;
use Modules\Cart\Service\CartItem\CartItemService;

class CartItemController extends Controller
{
    private CartItemService $cartItemService;

    public function __construct(CartItemService $cartItemService)
    {
        return $this->cartItemService = $cartItemService;
    }

    public function addItem(int $id, AddItemRequest $request)
    {
        return $this->cartItemService->addItem($id, $request->getDto());
    }

    public function deleteItem(DeleteItemRequest $request)
    {
        return $this->cartItemService->removeItem($request->getDto());
    }
}
