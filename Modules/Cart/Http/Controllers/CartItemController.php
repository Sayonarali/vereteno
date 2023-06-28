<?php

namespace Modules\Cart\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Cart\Http\Requests\Cart\DeleteItemRequest;
use Modules\Cart\Service\CartItem\CartItemService;

class CartItemController extends Controller
{
    private CartItemService $cartItemService;

    public function __construct(CartItemService $cartItemService)
    {
        $this->cartItemService = $cartItemService;
    }

    public function deleteItem(DeleteItemRequest $request)
    {
        $this->cartItemService->removeItem($request->getDto());
    }
}
