<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // $products = Product::paginate(20);
        $orders = Order::withCount('orderItems')->with(['payment', 'orderItems'])->latest()->get();
        return view('dashboard', [
            'orders' =>  $orders
        ]);
    }
}
