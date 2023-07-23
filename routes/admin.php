<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\productsController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\ProductsController as ControllersProductsController;
use Illuminate\Support\Facades\Route;

// Route::resource('/admin/category', productsController::class);
Route::middleware(['auth', 'auth.type:admin,super-admin'])->prefix('/admin')->group(function(){
    // Route::resource('/category', ControllersProductsController::class);
    Route::get('/products/trashed' , [productsController::class , 'trashed'])
            ->name('products.trashed')
            ->middleware('auth');
    Route::put('/products/{product}/restore' , [productsController::class , 'restore'])
            ->name('products.restore');
    Route::delete('/products/{product}/force' , [productsController::class , 'forceDelete'])
            ->name('products.force-delete');
    Route::resource('/products', productsController::class);

    Route::get('/categories/trashed' , [CategoriesController::class , 'trashed'])
        ->name('categories.trashed')
        ->middleware('auth');
    Route::put('/categories/{category}/restore' , [CategoriesController::class , 'restore'])
                ->name('categories.restore');

    Route::delete('/categories/{category}/force' , [CategoriesController::class , 'forceDelete'])
                ->name('categories.force-delete');
    Route::get('/users/trashed' , [UsersController::class , 'trashed'])
        ->name('users.trashed')
        ->middleware('auth');
    Route::put('/users/{user}/restore' , [UsersController::class , 'restore'])
                ->name('users.restore');

    Route::delete('/users/{user}/force' , [UsersController::class , 'forceDelete'])
                ->name('users.force-delete');
    Route::put('/users/updatepass/{user}' , [UsersController::class , 'updatepass'])
    ->name('users.updatepass');
    Route::get('/users/{user}/editpass' , [UsersController::class , 'editpass'])
    ->name('users.editpass');
    Route::get('/users/createe', [UsersController::class, 'create'])->name('usres.createe');

    Route::resource('/users', UsersController::class);
    Route::resource('/categories', CategoriesController::class);
    Route::resource('/orders', OrdersController::class);




});



?>
