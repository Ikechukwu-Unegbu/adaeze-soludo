<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class OrderService
{
    public static function createOrder()
    {
        $carts = Session::get('cart', []);
        $products = Product::whereIn('id', array_keys($carts))->get();
        $order = Order::create();
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