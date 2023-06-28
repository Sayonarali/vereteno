<?php

namespace Modules\Cart\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Cart\Http\Requests\Cart\DeleteItemRequest;
use Modules\Cart\Http\Requests\Cart\UpdateCartRequest;
use Modules\Cart\Service\Cart\CartService;

class CartController extends Controller
{
    private CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function show(int $id)
    {
        return $this->cartService->show($id);
    }

    public function update(int $id, UpdateCartRequest $request)
    {
        return $this->cartService->update($id, $request->getDto());
    }

    public function removeItem(DeleteItemRequest $request)
    {
        $this->cartService->removeItem($request->getDto());
    }

    public function empty($id)
    {
        $this->cartService->empty($id);
    }
}
