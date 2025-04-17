<?php

use App\Http\Controllers\OrderController;

Route::get('/order', [OrderController::class, 'create'])->name('order.create');
Route::post('/order', [OrderController::class, 'store'])->name('order.store');
Route::get('/order/success', [OrderController::class, 'success'])->name('order.success');

Route::get('/', function () {
    return view('home');
});
Route::get('/orders/success', function () {
    return view('orders.success');
})->name('orders.success');
