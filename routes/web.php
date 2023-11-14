<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[ProductController::class, 'welcome'])->name('welcome');

Route::get('/products', [ProductController::class, 'product'])->name('product');

Route::get('/product-{id}', [ProductController::class, 'productById'])->name('productById');

Route::get('/cart', [ShopController::class, 'cart'])->name('cart');

Route::get('/add-to-cart/{id}', [ShopController::class, 'addToCart'])->name('addToCart');

Route::patch('/update-cart/{id}', [ShopController::class, 'updateCartById'])->name('updateCartById');

Route::delete('/delete-cart/{id}', [ShopController::class, 'deleteCartById'])->name('deleteCartById');


Auth::routes();


Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::middleware('isAdmin')->group(function(){

    Route::prefix('/admin')->group(function(){
        //product
        Route::prefix('/product')->group(function(){
            Route::get('/', [ProductController::class, 'adminProductDashboard'])->name('adminProductDashboard');
            Route::get('/create-product', [ProductController::class, 'createProduct'])->name('createProduct');
            Route::post('/store-product', [ProductController::class, 'storeProduct'])->name('storeProduct');
            Route::get('/edit-product/{id}', [ProductController::class, 'edit'])->name('edit');
            Route::patch('/update-product/{id}', [ProductController::class, 'update'])->name('update');
            Route::delete('/delete-product/{id}', [ProductController::class, 'delete'])->name('delete');
            Route::get('/create-category', [CategoryController::class, 'createCategory'])->name('createCategory');
            Route::post('/store-category', [CategoryController::class, 'storeCategory'])->name('storeCategory');
            // Route::get('/list-dashboard', [ShopController::class, 'listDashboard'])->name('listDashboard');

            // Route::get('/{status}', [ShopController::class, 'filterPayments']);
            // Route::post('/verify/{id}', [ShopController::class, 'verifyPayment'])->name('verifyPayment');
            // Route::post('/reject/{id}', [ShopController::class, 'rejectPayment'])->name('rejectPayment');
        });

    });

});
