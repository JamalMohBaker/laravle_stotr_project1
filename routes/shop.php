<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
Route::get('/products/{product}', [ProductsController::class, 'show'] )
->name('shop.products.show');
