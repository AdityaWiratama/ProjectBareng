<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;  // Pastikan untuk mengimpor OrderController
use Illuminate\Support\Facades\Route;

/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
|
| Di sini adalah route untuk aplikasi web Anda. Route ini menggunakan
| middleware auth & verified agar hanya user login & terverifikasi yang
| bisa mengakses dashboard dan profile.
|
*/
Route::get('/', [ProductController::class, 'home'])->name('home');

// Halaman Dashboard (butuh login & verifikasi)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grup route yang hanya bisa diakses oleh user login
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Halaman Pemesanan Bika Ambon
Route::get('/order', [OrderController::class, 'create'])->name('order.create');  // Menampilkan halaman form pemesanan
Route::post('/order', [OrderController::class, 'store'])->name('order.store');  // Menyimpan pemesanan

// Halaman Konfirmasi Pemesanan
Route::get('/order/confirmation', [OrderController::class, 'confirmation'])->name('order.success');

// Route bawaan untuk auth (login, register, dll)
require __DIR__.'/auth.php';
