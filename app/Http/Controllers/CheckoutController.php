<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Services\PayStackService;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{

    public function index(Request $request)
    {
        $cart = Session::get('cart', []);
        if (!count($cart)) {
            return redirect()->route('product.index');
        }
        $products = Product::whereIn('id', array_keys($cart))->get();
        return view('checkout', [
            'products' => $products,
            'carts' => $cart
        ]);
    }

    public function store(Request $request)
    {
        $cart = Session::get('cart', []);

        $quantities = $request->input('quantities');
        
        foreach ($quantities as $productId => $quantity) {
            if (isset($cart[$productId])) {
                $cart[$productId] = $quantity; 
            }
        }
        
        Session::put('cart', $cart);

        return redirect()->route('checkout.index');
    }

    public function payment(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'address' => ['required', 'string', 'max:200'],
            'phone_number' => ['required', 'regex:/^0(70|80|81|90|91|80|81|70)\d{8}$/'],
            'custom_logo' => ['required', Rule::in(['1', '0'])],
            'logo' => [
                Rule::requiredIf($request->custom_logo === '1'),
                'file',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048',
            ],
        ]);

        $payStackService = PayStackService::initializePayment($validated);

        $response = json_decode($payStackService);
        
        if (isset($response->status)) {
            if ($response->status) {
                return redirect()->to($response->paymentLink);
            }
            
            return redirect()->back()->withErrors('Unable to process your payment. Please try again.');
        }

        return redirect()->back()->withErrors('Unable to process your payment. Please try again.');
    }

    public function verifyPayment(Request $request)
    {
        if ($request->has('reference')) {
            $verifyPayment = PayStackService::verifyPayment($request->reference);
            $response = json_encode($verifyPayment);
            if ($response) {
                Session::forget('cart');
                $order = Order::where('order_id', $request->reference)->first();
                session()->flash('success', 'Payment Successful');
                return redirect()->route('checkout.summary', $order->uuid);
            }
            return redirect()->back();
        }
    }

    public function summary(Order $order)
    {
        return view('summary')->with('order', $order);
    }
}
