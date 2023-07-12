<?php

namespace Modules\Order\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\Product;
use Modules\Order\Http\Responses\ShowOrderResponse;
use Modules\Order\Services\OrderService;

class OrderController extends Controller
{
    private OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function show()
    {
        return new ShowOrderResponse($this->orderService->show());
    }

    public function update(OrderItem $orderItem, int $quantity)
    {
        return $this->orderService->update($orderItem, $quantity);
    }

    public function empty()
    {
        return $this->orderService->empty();
    }

    public function addItem(Product $product)
    {
        return $this->orderService->addItem($product);
    }

    public function removeItem(OrderItem $orderItem)
    {
        return $this->orderService->removeItem($orderItem);
    }
}
