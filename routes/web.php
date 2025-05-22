<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Route untuk aplikasi web, dengan middleware auth & verified untuk 
| membatasi akses ke dashboard dan profile.
|
*/

// Route untuk halaman utama (homepage)

Route::get('/admin/orders/{order}/edit', [OrderController::class, 'edit'])->name('admin.orders.edit');
Route::put('/admin/orders/{order}', [OrderController::class, 'update'])->name('admin.orders.update');


Route::get('/', [ProductController::class, 'home'])->name('home');

// Halaman pemesanan Bika Ambon
Route::get('/order', [OrderController::class, 'create'])->name('order.create');  // Form pemesanan
Route::post('/order', [OrderController::class, 'store'])->name('order.store');  // Proses simpan pesanan

// Halaman konfirmasi/sukses pemesanan
Route::get('/order/confirmation', [OrderController::class, 'confirmation'])->name('order.success');

// Group route yang memerlukan autentikasi dan verifikasi
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile management
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // Admin routes untuk Order, prefix dan name group admin
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
