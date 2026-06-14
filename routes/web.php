<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman publik (tanpa autentikasi)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

// Rute autentikasi sederhana (email apa pun bisa login)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute yang memerlukan autentikasi
Route::middleware(['auth'])->group(function () {
    // Keranjang belanja
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');

    // Favorit
    Route::post('/favorite/{product}', [FavoriteController::class, 'toggle'])->name('favorite.toggle');
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');

    // Checkout dan pembayaran
    Route::get('/checkout', [OrderController::class, 'checkoutForm'])->name('checkout.form'); // checkout dari keranjang
    Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/direct/{product}', [OrderController::class, 'directCheckout'])->name('checkout.direct'); // langsung checkout tanpa keranjang (Order Now)

    // Halaman pembayaran spesifik (langsung diarahkan setelah checkout)
    Route::get('/payment/{order}/qris', [PaymentController::class, 'showQris'])->name('payment.qris');
    Route::get('/payment/{order}/cashier', [PaymentController::class, 'showCashier'])->name('payment.cashier');
    
    // Konfirmasi pembayaran sukses (di-trigger dari tombol simulasi di halaman payment)
    Route::post('/payment/success/{order}', [PaymentController::class, 'success'])->name('payment.success');
    
    // Barcode untuk pembayaran di kasir (jika perlu ditampilkan ulang)
    Route::get('/order/{order}/barcode', [OrderController::class, 'showBarcode'])->name('order.barcode');

    // Riwayat pesanan dan detail
    Route::get('/history', [OrderController::class, 'history'])->name('order.history');
    Route::get('/order/{order}', [OrderController::class, 'show'])->name('order.show');

    // Profil pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});