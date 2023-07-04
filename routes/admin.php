<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\productsController;
use Illuminate\Support\Facades\Route;

// Route::resource('/admin/category', productsController::class);
Route::middleware(['auth', 'auth.type:admin,super-admin'])->prefix('/admin')->group(function(){

    Route::get('/products/trashed' , [productsController::class , 'trashed'])
            ->name('products.trashed')
            ->middleware('auth');
    Route::put('/products/{product}/restore' , [productsController::class , 'restore'])
            ->name('products.restore');
    Route::delete('/products/{product}/force' , [productsController::class , 'forceDelete'])
            ->name('products.force-delete');
    Route::resource('/products', productsController::class);
    Route::resource('/categories', CategoriesController::class);

});



?>
