<?php

namespace Modules\Order\Http\Requests;

use App\Models\CartItem;
use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Order\Dto\CreateUpdateOrderDto;

class CreateUpdateOrderRequest extends FormRequest
{
    public function getDto(): CreateUpdateOrderDto
    {
        $data = $this->validated();
        return new CreateUpdateOrderDto($data['status'] ?? 'new',
            $data['paymentStatus'] ?? 'unpaid',
            $data['paymentMethod'] ?? 'online',
            $data['cartItemIds'] ?? null,
            $data['country'] ?? '',
            $data['region'] ?? '',
            $data['city'] ?? '',
            $data['street'] ?? '',
            $data['postcode'] ?? null,
        );
    }

    public function rules()
    {
        return [
            'status' => ['nullable', Rule::in([Order::NEW_ORDER_STATUS, Order::PROCESS_ORDER_STATUS, Order::DELIVERED_ORDER_STATUS, Order::CANCEL_ORDER_STATUS])],
            'paymentStatus' => ['nullable', Rule::in([Order::PAID_PAYMENT_STATUS, Order::UNPAID_PAYMENT_STATUS])],
            'paymentMethod' => ['nullable', Rule::in([Order::ONLINE_PAYMENT_METHOD, Order::OFFLINE_PAYMENT_METHOD])],
            'cartItemIds' => 'nullable|array',
            'cartItemIds.*' => 'nullable|int|exists:' . CartItem::class . ',id',
            'country' => 'nullable|string',
            'region' => 'nullable|string',
            'city' => 'nullable|string',
            'street' => 'nullable|string',
            'postcode' => 'nullable|int',
        ];
    }
}
