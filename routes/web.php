
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\OwnerReportController;
use App\Http\Controllers\OwnerGuardController;

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

Route::get('/booking', [BookingController::class, 'index'])
    ->name('booking.index');

Route::post('/booking', [BookingController::class, 'store'])
    ->name('booking.store');

Route::post('/booking/checkout', [BookingController::class, 'store'])
    ->name('booking.checkout');


// ==========================================
// PAYMENT
// ==========================================

Route::get('/payment/{id}', [PaymentController::class, 'show'])
    ->name('payment.show');

Route::post('/payment/{id}/confirm', [PaymentController::class, 'confirm'])
    ->name('payment.confirm');


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
    });


// ==========================================
// DASHBOARD PENJAGA
// ==========================================

Route::middleware(['auth:admin', 'role:penjaga'])
    ->prefix('penjaga')
    ->name('penjaga.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('penjaga.dashboard');
        })->name('dashboard');

    });
