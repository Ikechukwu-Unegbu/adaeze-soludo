<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
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

Route::prefix('checkout')->as('checkout.')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('index');
    Route::post('/', [CheckoutController::class, 'store'])->name('store');
    Route::post('/process-payment', [CheckoutController::class, 'payment'])->name('payment');
    Route::get('/verify-payment', [CheckoutController::class, 'verifyPayment'])->name('verify-payment');
    Route::get('/summary/{order:uuid}', [CheckoutController::class, 'summary'])->name('summary');
});
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/order', [OrderController::class, 'index'])->middleware(['auth', 'verified'])->name('order.index');
Route::get('/order/{order:uuid}/show', [OrderController::class, 'show'])->middleware(['auth', 'verified'])->name('order.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
