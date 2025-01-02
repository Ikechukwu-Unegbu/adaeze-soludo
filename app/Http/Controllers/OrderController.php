<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::withCount('orderItems')->with(['payment', 'orderItems'])->latest()->get();
        return view('order')->with('orders', $orders);
    }

    public function show(Order $order)
    {
        return view('order-details')->with('order', $order);
    }
}
