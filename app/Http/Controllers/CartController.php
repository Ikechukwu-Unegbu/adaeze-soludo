<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function store($productId)
    {
      
        $cart = Session::get('cart', []);

        // Add the product to the cart (if it doesn't already exist)
        if (!isset($cart[$productId])) {
            $cart[$productId] = 1; // Set quantity as 1 for this example
        } else {
            $cart[$productId] += 1; // Increase quantity if product is already in the cart
        }

        // Store the updated cart back in the session
        Session::put('cart', $cart);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function index()
    {
        $cart = Session::get('cart', []);
        $products = Product::whereIn('id', array_keys($cart))->get();

        return view('cart', compact('products', 'cart'));
    }

    public function destroy($productId)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
        }

        Session::put('cart', $cart);
        
        return redirect()->back()->with('success', 'Product removed from cart successfully');
    }
}
