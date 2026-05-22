<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\POS\POSController;
use App\Http\Controllers\POS\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [POSController::class, 'dashboard'])->name('dashboard');
    Route::get('/cashier', [POSController::class, 'index'])->name('pos.cashier');
    Route::get('/transactions', [POSController::class, 'transactions'])->name('pos.transactions');

    // Route untuk manajemen produk CRUD (Hanya boleh diakses oleh Admin)
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/products', [ProductController::class, 'index'])->name('pos.products.index');
        Route::post('/products', [ProductController::class, 'store'])->name('pos.products.store');
        Route::put('/products/{id}', [ProductController::class, 'update'])->name('pos.products.update');
        Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('pos.products.destroy');
    });

    // API Routes untuk AJAX Checkout (memerlukan session web)
    Route::prefix('api')->group(function () {
        Route::get('/products/search', [\App\Http\Controllers\API\POSController::class, 'searchProducts']);
        Route::post('/checkout', [\App\Http\Controllers\API\POSController::class, 'checkout']);
    });

    // Profile routes bawaan Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
