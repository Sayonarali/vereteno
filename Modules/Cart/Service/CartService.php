<?php

namespace Modules\Cart\Service;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class CartService
{
    /**
     * @return mixed|string
     */
    public function show($id): mixed
    {
        return Cart::query()->with('items')->find($id);
    }

    public function update($data)
    {
        $already_cart = Cart::whereUserId(Auth::id())->where('order_id', null)->whereHas(
            'product',
            function (Builder $query) use ($data) {
                $query->where('slug', $data->slug);
            }
        )->first();
        if ($already_cart) {
            $already_cart->quantity = $already_cart->quantity + 1;
            $already_cart->amount   = $data->price + $already_cart->amount;
            if ($already_cart->product->stock < $already_cart->quantity || $already_cart->product->stock <= 0) {
                return back()->with('error', 'Stock not sufficient!.');
            }
            $already_cart->save();
        } else {
            $cart             = new Cart();
            $cart->user_id    = Auth::id();
            $cart->product_id = $data->id;
            $cart->price      = ($data->price - ($data->price * $data->discount) / 100);
            $cart->quantity   = 1;
            $cart->amount     = $cart->price * $cart->quantity;
            if ($cart->product->stock < $cart->quantity || $cart->product->stock <= 0) {
                return back()->with('error', 'Stock not sufficient!.');
            }
            $cart->save();
        }
    }

    public function empty($id)
    {
        $this->cart_repository->delete($id);
    }

    public function cartUpdate($data): RedirectResponse
    {
        if ($data->quantity) {
            $error   = [];
            $success = '';
            foreach ($data->quantity as $k => $quantities) {
                $id   = $data->qty_id[$k];
                $cart = Cart::findOrFail($id);
                if ($quantities > 0 && $cart) {
                    if ($cart->product->stock < $quantities) {
                        request()->session()->flash('error', 'Out of stock');

                        return back();
                    }
                    $cart->quantity = ($cart->product->stock > $quantities) ? $quantities : $cart->product->stock;

                    if ($cart->product->stock <= 0) {
                        continue;
                    }
                    $after_price  = ($cart->product->price - ($cart->product->price * $cart->product->discount) / 100);
                    $cart->amount = $after_price * $quantities;
                    $cart->save();
                    session()->put('cart', $cart);
                    $success = 'Cart successfully updated!';
                } else {
                    $error[] = 'Cart Invalid!';
                }
            }

            return back()->with($error)->with('success', $success);
        } else {
            return back()->with('Cart Invalid!');
        }
    }
}
