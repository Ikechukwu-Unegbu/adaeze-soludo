<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class OrderService
{
    public static function createOrder($data)
    {
        $carts = Session::get('cart', []);
        
        if (!count($carts)) {
            return redirect()->route('product.index');
        }

        $products = Product::whereIn('id', array_keys($carts))->get();

        if (request()->file('logo')) {
            $file = request()->file('logo');
            $data['logo'] = $file->storeAs('', Str::lower(Str::random(10)) . '.' . $file->getClientOriginalExtension(), 'logos');
        }
        
        $order = Order::create($data);

        collect($products)->each(function ($product) use ($order, $carts) {
            $order->orderItems()->create([
                'product_id' => $product->id,
                'quantity' => $carts[$product->id],
                'amount' => $product->price * $carts[$product->id]
            ]);
        });
        return $order;
    }
}