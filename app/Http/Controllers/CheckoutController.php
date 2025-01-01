<?php

namespace App\Http\Controllers;

use App\Services\PayStackService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $cart = Session::get('cart', []);

        $quantities = $request->input('quantities');

        foreach ($quantities as $productId => $quantity) {
            if (isset($cart[$productId])) {
                $cart[$productId] = $quantity; 
            }
        }
        
        Session::put('cart', $cart);

        $payStackService = PayStackService::initializePayment();

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
                session()->flash('success', 'Payment Successful');
                return redirect()->route('dashboard');
            }
            return redirect()->back();
        }
    }
}
