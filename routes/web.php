<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;


Route::get('/', function () {
    $products = Product::all();
    return view('welcome', compact('products'));
});

Route::get('/checkout/{productId}', [PaymentController::class, 'checkout'])->name('checkout');
Route::post('/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
Route::post('/fail', [PaymentController::class, 'paymentFail'])->name('payment.fail');
Route::post('/cancel', [PaymentController::class, 'paymentCancel'])->name('payment.cancel');
// Route::post('/cancel', [PaymentController::class, 'paymentCancel'])->name('payment.cancel');

