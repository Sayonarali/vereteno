<?php

namespace Modules\Cart\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Cart\Service\CartService;

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

    public function update($id, $productId, $productQuantity)
    {
        return $this->cartService->update($id, $productId, $productQuantity);
    }

    public function empty($id)
    {
    }
}
