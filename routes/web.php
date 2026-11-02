<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentVerificationController;
use App\Http\Controllers\ReceiptController;

// ========================================
// ROUTE PEMBAYARAN (MEMERLUKAN LOGIN)
// ========================================
Route::middleware('auth')->group(function () {

    // Halaman pembayaran pelanggan
    Route::get('/payment/{bookingId}', [PaymentController::class, 'create'])
        ->name('payment.create');

    Route::post('/payment/{bookingId}', [PaymentController::class, 'store'])
        ->name('payment.store');

    Route::get('/payment/status/{id}', [PaymentController::class, 'status'])
        ->name('payment.status');

    // Halaman verifikasi penjaga
    Route::get('/guard/payments', [PaymentVerificationController::class, 'index'])
        ->name('guard.payments');

    Route::patch('/guard/payments/{id}/verify', [PaymentVerificationController::class, 'verify'])
        ->name('guard.payments.verify');

    Route::patch('/guard/payments/{id}/reject', [PaymentVerificationController::class, 'reject'])
        ->name('guard.payments.reject');

    // Kuitansi pembayaran
    Route::get('/receipt/{id}', [ReceiptController::class, 'show'])
        ->name('receipt.show');
});

// ========================================
// HALAMAN UTAMA
// ========================================
Route::get('/', function () {
    return view('welcome');
});