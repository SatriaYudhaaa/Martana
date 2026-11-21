<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\OwnerReportController;
use App\Http\Controllers\OwnerGuardController;
use App\Http\Controllers\OwnerAttendanceController;
use App\Http\Controllers\Penjaga\DashboardController;
use App\Http\Controllers\Penjaga\PresensiController;
use App\Http\Controllers\Penjaga\BookinggController;
use App\Http\Controllers\Penjaga\TransaksiController;
use App\Http\Controllers\Penjaga\KelolaAkunController;


// ==========================================
// HOME
// ==========================================

Route::get('/', [HomeController::class, 'index'])
    ->name('home');


// ==========================================
// REGISTER & LOGIN PELANGGAN
// ==========================================

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.submit');

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


// ==========================================
// PROFIL PELANGGAN
// ==========================================

Route::middleware('auth:web')->group(function () {

    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile.index');

    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

});


// ==========================================
// LOGIN & LOGOUT OWNER / PENJAGA
// ==========================================

Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])
    ->name('admin.login');

Route::post('/admin/login', [AdminAuthController::class, 'login'])
    ->name('admin.login.submit');

Route::post('/admin/logout', [AdminAuthController::class, 'logout'])
    ->middleware('auth:admin')
    ->name('admin.logout');


// ==========================================
// DETAIL LAPANGAN
// ==========================================

Route::get('/lapangan/martana-prime', [FieldController::class, 'prime'])
    ->name('fields.prime');

Route::get('/lapangan/martana-arena', [FieldController::class, 'arena'])
    ->name('fields.arena');


// ==========================================
// BOOKING
// ==========================================

Route::middleware('auth:web')->group(function () {

    Route::get('/booking', [BookingController::class, 'index'])
        ->name('booking.index');

    Route::post('/booking', [BookingController::class, 'store'])
        ->name('booking.store');

    Route::post('/booking/checkout', [BookingController::class, 'store'])
        ->name('booking.checkout');

});


// ==========================================
// PAYMENT
// ==========================================

Route::middleware('auth:web')->group(function () {

    // Halaman pembayaran
    Route::get('/payment/{id}', [PaymentController::class, 'show'])
        ->name('payment.show');

    // Mengirim pembayaran
    Route::post('/payment/{id}/confirm', [PaymentController::class, 'confirm'])
        ->name('payment.confirm');

    // Halaman menunggu verifikasi
    Route::get('/payment/{id}/waiting', [PaymentController::class, 'waiting'])
        ->name('payment.waiting');

    // Kwitansi pelanggan dalam format PNG
    Route::get('/payment/{id}/receipt', [PaymentController::class, 'receipt'])
        ->name('payment.receipt');

});


// ==========================================
// DASHBOARD OWNER
// ==========================================

Route::middleware(['auth:admin', 'role:owner'])
    ->prefix('owner')
    ->name('owner.')
    ->group(function () {

        Route::get('/dashboard', [OwnerController::class, 'dashboard'])
            ->name('dashboard');

        // Laporan
        Route::get('/laporan/pendapatan', [OwnerReportController::class, 'revenue'])
            ->name('reports.revenue');

        Route::get('/laporan/booking', [OwnerReportController::class, 'bookings'])
            ->name('reports.bookings');

        // Kelola Lapangan
        Route::get('/kelola/lapangan', [OwnerController::class, 'courts'])
            ->name('courts.index');

        // Kelola Penjaga
        Route::get('/kelola/penjaga', [OwnerGuardController::class, 'index'])
            ->name('guards.index');

        Route::post('/kelola/penjaga', [OwnerGuardController::class, 'store'])
            ->name('guards.store');

        Route::put('/kelola/penjaga/{id}', [OwnerGuardController::class, 'update'])
            ->name('guards.update');

        Route::delete('/kelola/penjaga/{id}', [OwnerGuardController::class, 'destroy'])
            ->name('guards.destroy');

        // Pengaturan
        Route::get('/pengaturan', [OwnerController::class, 'settings'])
            ->name('settings');
            
        // Presensi Penjaga
        Route::get('/presensi', [OwnerAttendanceController::class, 'index'])
            ->name('attendances.index');

    });


// ==========================================
// DASHBOARD PENJAGA
// ==========================================

Route::middleware(['auth:admin', 'role:penjaga'])
    ->prefix('penjaga')
    ->name('penjaga.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/presensi', [PresensiController::class, 'index'])
            ->name('presensi');

        Route::post('/presensi/masuk', [PresensiController::class, 'masuk'])
            ->name('presensi.masuk');

        // Booking
        Route::get('/booking', [BookinggController::class, 'index'])
            ->name('booking');

        Route::post('/booking/{id}/confirm', [BookinggController::class, 'confirm'])
            ->name('booking.confirm');

        Route::post('/booking/{id}/cancel', [BookinggController::class, 'cancel'])
            ->name('booking.cancel');

        // Transaksi
        Route::get('/transaksi', [TransaksiController::class, 'index'])
            ->name('transaksi');

        Route::get('/transaksi/{id}/kwitansi', [TransaksiController::class, 'kwitansi'])
            ->name('transaksi.kwitansi');

        // Kelola akun
        Route::get('/kelola-akun', [KelolaAkunController::class, 'index'])
            ->name('kelola-akun');

    });