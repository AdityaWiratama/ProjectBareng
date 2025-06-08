<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/orders/{order}/edit', [OrderController::class, 'edit'])->name('admin.orders.edit');
Route::put('/admin/orders/{order}', [OrderController::class, 'update'])->name('admin.orders.update');


Route::get('/', [ProductController::class, 'home'])->name('home');
Route::get('/order/create', [OrderController::class, 'create'])->name('order.create');
Route::post('/orders', [OrderController::class, 'store'])->name('order.store');
Route::get('/order/success', [OrderController::class, 'success'])->name('order.success');

Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});
Route::middleware(['auth', 'admin'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        // List semua order (halaman admin)
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

        // Detail order
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

        // Update order (misal update status)
        Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');

        // Hapus order
        Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
    });
});

// Route bawaan untuk autentikasi (login, register, dll)
require __DIR__.'/auth.php';