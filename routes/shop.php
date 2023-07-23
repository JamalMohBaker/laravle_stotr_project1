<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
// Route::get('/products/{product}', [ProductsController::class, 'show'] )
// ->name('shop.products.show');
// Route::get('/products/{product}', [ProductsController::class, 'show'] )
// ->name('shop.products.show');
Route::get('/cart', [CartController::class, 'index'] )
->name('cart');
Route::post('/cart', [CartController::class, 'store'] )
->name('cart');
Route::delete('/cart/{id}', [CartController::class, 'destroy'] )
->name('cart.destroy');
Route::get('/checkout', [CheckoutController::class, 'create'] )
->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'store']);
Route::get('/checkout/thankyou', [CheckoutController::class, 'success'] )
->name('checkout.success');
Route::get('/products/{product}', [ProductsController::class, 'show'])->name('shop.products.show');


