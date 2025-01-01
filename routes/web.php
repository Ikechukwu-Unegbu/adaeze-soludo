<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/products', [ProductController::class, 'index'])->name('product.index');
Route::post('/products', [ProductController::class, 'store'])->name('product.store');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/product/{id}/destroy', [ProductController::class, 'destroy'])->name('product.destroy');

Route::get('cart', [CartController::class, 'index'])->name('cart.index');
Route::get('cart/{productId}', [CartController::class, 'store'])->name('cart.store');
Route::delete('cart/{productId}/delete', [CartController::class, 'destroy'])->name('cart.delete');

Route::middleware('auth')->group(function () {
    Route::post('checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::get('checkout/verify-payment', [CheckoutController::class, 'verifyPayment'])->name('checkout.verify-payment');
});
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
