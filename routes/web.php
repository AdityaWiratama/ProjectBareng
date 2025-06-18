<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;

Route::get('/products', [ProductController::class, 'allProducts'])->name('products.all');
Route::get('/', [ProductController::class, 'home'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/riwayat', [OrderController::class, 'history'])->name('order.history');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/order/create', [OrderController::class, 'create'])->name('order.create');
    Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
    Route::get('/order/success', [OrderController::class, 'success'])->name('order.success');
});


// Form pemesanan (user)
Route::get('/order/create', [OrderController::class, 'create'])->name('order.create');
Route::post('/orders', [OrderController::class, 'store'])->name('order.store');
Route::get('/order/success', [OrderController::class, 'success'])->name('order.success');

// =======================
// User Dashboard & Profil (Login biasa)
// =======================
Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });
});

// =======================
// Admin Routes
// =======================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // CRUD pesanan (order) - khusus admin
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');
    Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');

    // CRUD produk
    Route::resource('products', ProductController::class);
});


// =======================
// Authentication Routes (Login/Register)
// =======================
require __DIR__.'/auth.php';
