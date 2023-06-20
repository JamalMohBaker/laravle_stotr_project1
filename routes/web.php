<?php

use App\Http\Controllers\Admin\productsController;
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



Route::get('/', function () {
    return view('welcome');
});

// Route::get('/admin/products', [productsController::class,'index']);
// Route::get('/admin/products/create', [productsController::class,'create']);
// Route::post('/admin/products', [productsController::class,'store']);
// Route::get('/admin/products/{id}', [productsController::class,'show']);
// Route::get('/admin/products/{id}/edit', [productsController::class,'edit']);
// Route::put('/admin/products/{id}', [productsController::class,'update']);
// Route::delete('/admin/products/{id}', [productsController::class,'destroy']);
Route::resource('/admin/products', productsController::class);