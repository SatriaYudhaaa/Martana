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
use App\Http\Controllers\OwnerLaporanController;

use App\Http\Controllers\Penjaga\DashboardController;
use App\Http\Controllers\Penjaga\PresensiController;
use App\Http\Controllers\Penjaga\BookinggController;
use App\Http\Controllers\Penjaga\TransaksiController;
use App\Http\Controllers\Penjaga\KelolaAkunController;
use App\Http\Controllers\Penjaga\KelolaLapanganController;
use App\Http\Controllers\Penjaga\LaporanController;


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
// BOOKING PELANGGAN
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

    Route::get('/payment/{id}', [PaymentController::class, 'show'])
        ->name('payment.show');

    Route::post('/payment/{id}/confirm', [PaymentController::class, 'confirm'])
        ->name('payment.confirm');

    Route::get('/payment/{id}/waiting', [PaymentController::class, 'waiting'])
        ->name('payment.waiting');

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

        // Dashboard
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

        // Laporan
        Route::get('/laporan/pendapatan', [OwnerReportController::class, 'revenue'])
            ->name('reports.revenue');

        Route::get('/laporan/booking', [OwnerReportController::class, 'bookings'])
            ->name('reports.bookings');

        Route::get('/laporan-penjaga/{id}/view', [OwnerLaporanController::class, 'view'])
            ->name('laporan-penjaga.view');

        // Laporan dari Penjaga
        Route::get('/laporan-penjaga', [OwnerLaporanController::class, 'index'])
            ->name('laporan-penjaga.index');

        Route::get('/laporan-penjaga/{id}/download', [OwnerLaporanController::class, 'download'])
            ->name('laporan-penjaga.download');

    });


// ==========================================
// DASHBOARD PENJAGA
// ==========================================

Route::middleware(['auth:admin', 'role:penjaga'])
    ->prefix('penjaga')
    ->name('penjaga.')
    ->group(function () {

        // ======================================
        // DASHBOARD
        // ======================================

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // ======================================
        // UPLOAD LAPORAN
        // ======================================

        Route::post('/laporan', [LaporanController::class, 'store'])
            ->name('laporan.store');

        // ======================================
        // PRESENSI
        // ======================================

        Route::get('/presensi', [PresensiController::class, 'index'])
            ->name('presensi');

        Route::post('/presensi/masuk', [PresensiController::class, 'masuk'])
            ->name('presensi.masuk');


        // ======================================
        // BOOKING PENJAGA
        // ======================================

        Route::get('/booking', [BookinggController::class, 'index'])
            ->name('booking');

        Route::get('/booking/export-pdf', [BookinggController::class, 'exportPdf'])
            ->name('booking.export-pdf');

        Route::post('/booking', [BookinggController::class, 'store'])
            ->name('booking.store');

        Route::put('/booking/{id}', [BookinggController::class, 'update'])
            ->name('booking.update');

        Route::delete('/booking/{id}', [BookinggController::class, 'destroy'])
            ->name('booking.destroy');

        Route::post('/booking/{id}/confirm', [BookinggController::class, 'confirm'])
            ->name('booking.confirm');

        Route::post('/booking/{id}/cancel', [BookinggController::class, 'cancel'])
            ->name('booking.cancel');


        // ======================================
        // KELOLA DATA LAPANGAN
        // ======================================

        Route::get('/kelola-lapangan', [KelolaLapanganController::class, 'index'])
            ->name('lapangan.index');

        Route::post('/kelola-lapangan', [KelolaLapanganController::class, 'store'])
            ->name('lapangan.store');

        Route::put('/kelola-lapangan/{id}', [KelolaLapanganController::class, 'update'])
            ->name('lapangan.update');

        Route::delete('/kelola-lapangan/{id}', [KelolaLapanganController::class, 'destroy'])
            ->name('lapangan.destroy');


        // ======================================
        // TRANSAKSI
        // ======================================

        // Menampilkan data transaksi
        Route::get('/transaksi', [TransaksiController::class, 'index'])
            ->name('transaksi');

        // DOWNLOAD PDF SELURUH TRANSAKSI
        Route::get('/transaksi/export-pdf', [TransaksiController::class, 'exportPdf'])
            ->name('transaksi.export-pdf');

        // Cetak kwitansi
        Route::get('/transaksi/{id}/kwitansi', [TransaksiController::class, 'kwitansi'])
            ->name('transaksi.kwitansi');

        // Hapus transaksi
        Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy'])
            ->name('transaksi.destroy');


        // ======================================
        // KELOLA AKUN
        // ======================================

        Route::get('/kelola-akun', [KelolaAkunController::class, 'index'])
            ->name('kelola-akun');

    });