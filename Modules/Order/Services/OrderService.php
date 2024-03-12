<?php

namespace Modules\Order\Services;

use App\Mail\CustomOrderMail;
use App\Models\CartItem;
use App\Models\CustomOrder;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderItem;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Modules\Order\Dto\CreateUpdateOrderDto;
use Modules\Order\Dto\CustomOrderDto;
use Modules\Order\Dto\ResultShowOrderDto;

class OrderService
{
    public function show()
    {
        $totalCount = Order::query()->where('user_id', Auth::user()->getAuthIdentifier())->count();

        $orderItems = Order::query()
            ->where('user_id', Auth::user()->getAuthIdentifier())
            ->with('items')
            ->get();

        return new ResultShowOrderDto($totalCount, $orderItems);
    }

    public function create(CreateUpdateOrderDto $dto)
    {
        $order = new Order([
            'user_id' => Auth::user()->getAuthIdentifier(),
            'status' => $dto->getStatus(),
            'total' => 2000,
            'payment_status' => $dto->getPaymentStatus(),
            'payment_method' => $dto->getPaymentMethod(),
        ]);

        $orderAddress = new OrderAddress([
            'country' => $dto->getCountry(),
            'region' => $dto->getRegion(),
            'city' => $dto->getCity(),
            'street' => $dto->getStreet(),
            'postcode' => $dto->getPostcode(),
        ]);

        DB::transaction(function () use ($order, $dto, $orderAddress) {
            $order->save();
            is_null($dto->getCartItemIds()) ?: $this->saveOrderItems($order, $dto->getCartItemIds());
            $order->address()->save($orderAddress);
        });

        CartItem::query()->whereIn('id', $dto->getCartItemIds())->delete();

        return $order;
    }

    public function custom(CustomOrderDto $dto)
    {
        $order = CustomOrder::create([
            'phone' => $dto->getPhone(),
            'name' => $dto->getName(),
            'description' => $dto->getDescription(),
        ]);
        Mail::to('elizaveta_shevchenko_00@inbox.ru')->send(new CustomOrderMail($order));
        return true;
    }

    public function saveOrderItems(Order $order, Collection $cartItemIds)
    {
        $order->items()->saveMany($cartItemIds->map(function (int $cartItemId) {
            $cartItem = CartItem::find($cartItemId);
            return new OrderItem([
                'product_vendor_code_id' => $cartItem->product_vendor_code_id,
                'price' => $cartItem->product->price,
                'amount' => $cartItem->product->price * $cartItem->quantity,
                'quantity' => $cartItem->quantity,
            ]);
        }));
    }

    public function updateOrderStatus(Order $order, CreateUpdateOrderDto $dto)
    {
        $order->update([
            'status' => $dto->getStatus(),
        ]);

        return $order;
    }
}
