<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [ProductController::class, 'index']);

Route::resource('products', ProductController::class);
Route::get('/cart', [CartController::class, 'index']);
Route::get('/cart/add/{product}', [CartController::class, 'add']);
Route::get('/cart/remove/{id}', [CartController::class, 'remove']);



Route::get('/show-checkout', [PaymentController::class, 'showCheckout']);
Route::post('/checkout', [PaymentController::class, 'checkout']);


Route::get('/payment/callback', function () {
    return redirect('/payment/success');
});

Route::get('/payment/success', [PaymentController::class, 'success']);
