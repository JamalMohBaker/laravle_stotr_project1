<?php

use App\Http\Controllers\Admin\productsController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products/{product}', [\App\Http\Controllers\Admin\productsController::class, 'show'] )
->name('shop.products.show');

// Route::get('/admin/products', [productsController::class,'index']);
// Route::get('/admin/products/create', [productsController::class,'create']);
// Route::post('/admin/products', [productsController::class,'store']);
// Route::get('/admin/products/{id}', [productsController::class,'show']);
// Route::get('/admin/products/{id}/edit', [productsController::class,'edit']);
// Route::put('/admin/products/{id}', [productsController::class,'update']);
// Route::delete('/admin/products/{id}', [productsController::class,'destroy']);

Route::resource('/admin/category', productsController::class);
Route::get('/admin/products/trashed' , [productsController::class , 'trashed'])
        ->name('products.trashed');
Route::put('/admin/products/{product}/restore' , [productsController::class , 'restore'])
        ->name('products.restore');
Route::delete('/admin/products/{product}/force' , [productsController::class , 'forceDelete'])
        ->name('products.force-delete');
Route::resource('/admin/products', productsController::class);