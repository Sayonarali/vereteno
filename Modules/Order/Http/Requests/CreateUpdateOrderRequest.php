<?php

namespace Modules\Order\Http\Requests;

use App\Models\CartItem;
use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Modules\Order\Dto\CreateUpdateOrderDto;

class CreateUpdateOrderRequest extends FormRequest
{
    public function getDto(): CreateUpdateOrderDto
    {
        $data = $this->validated();
        return new CreateUpdateOrderDto($data['status'],
            $data['paymentStatus'],
            $data['paymentMethod'],
            new Collection($data['cartItemIds'] ?? []),
            $data['country'],
            $data['region'],
            $data['city'],
            $data['street'],
            $data['postcode'],
        );
    }

    public function rules()
    {
        return [
            'status' => ['required', Rule::in([Order::NEW_ORDER_STATUS, Order::PROCESS_ORDER_STATUS, Order::DELIVERED_ORDER_STATUS, Order::CANCEL_ORDER_STATUS])],
            'paymentStatus' => ['required', Rule::in([Order::PAID_PAYMENT_STATUS, Order::UNPAID_PAYMENT_STATUS])],
            'paymentMethod' => ['required', Rule::in([Order::ONLINE_PAYMENT_METHOD, Order::OFFLINE_PAYMENT_METHOD])],
            'cartItemIds' => 'required|array',
            'cartItemIds.*' => 'required|int|exists:' . CartItem::class . ',id',
            'country' => 'required|string',
            'region' => 'required|string',
            'city' => 'required|string',
            'street' => 'required|string',
            'postcode' => 'required|int',
        ];
    }
}
