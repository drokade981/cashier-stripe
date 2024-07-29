<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChargeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\GPTController;
use App\Http\Controllers\StripeController;

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::middleware('auth')->group(function () {
   
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::post('/product/{id}/charge', [ProductController::class, 'charge'])->name('products.charge');
});

