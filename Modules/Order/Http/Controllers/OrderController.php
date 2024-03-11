<?php

namespace Modules\Order\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Modules\Order\Http\Requests\CreateUpdateOrderRequest;
use Modules\Order\Http\Requests\CustomOrderRequest;
use Modules\Order\Http\Responses\OrderResponse;
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

    public function create(CreateUpdateOrderRequest $request)
    {
        return new OrderResponse($this->orderService->create($request->getDto()));
    }

    public function custom(CustomOrderRequest $request)
    {
        return $this->orderService->custom($request->getDto());
    }

    public function updateOrderStatus(Order $order, CreateUpdateorderRequest $request)
    {
        return new OrderResponse($this->orderService->updateOrderStatus($order, $request->getDto()));
    }
}
