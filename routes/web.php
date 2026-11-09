<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');


/*
|--------------------------------------------------------------------------
| REGISTER PELANGGAN
|--------------------------------------------------------------------------
*/

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.submit');


/*
|--------------------------------------------------------------------------
| LOGIN & LOGOUT PELANGGAN
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
| PROFIL PELANGGAN
|--------------------------------------------------------------------------
*/

Route::middleware('auth:web')->group(function () {

    // Menampilkan profil pelanggan
    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile.index');

    // Menyimpan perubahan profil pelanggan
    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

});


/*
|--------------------------------------------------------------------------
| LOGIN & LOGOUT OWNER DAN PENJAGA
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])
    ->name('admin.login');

Route::post('/admin/login', [AdminAuthController::class, 'login'])
    ->name('admin.login.submit');

Route::post('/admin/logout', [AdminAuthController::class, 'logout'])
    ->middleware('auth:admin')
    ->name('admin.logout');


/*
|--------------------------------------------------------------------------
| DASHBOARD OWNER
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:admin', 'role:owner'])
    ->prefix('owner')
    ->name('owner.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.owner.dashboard');
        })->name('dashboard');

    });


/*
|--------------------------------------------------------------------------
| DASHBOARD PENJAGA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:admin', 'role:penjaga'])
    ->prefix('penjaga')
    ->name('penjaga.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.penjaga.dashboard');
        })->name('dashboard');

    });


/*
|--------------------------------------------------------------------------
| DETAIL LAPANGAN
|--------------------------------------------------------------------------
*/

Route::get('/lapangan/martana-prime', [FieldController::class, 'prime'])
    ->name('fields.prime');

Route::get('/lapangan/martana-arena', [FieldController::class, 'arena'])
    ->name('fields.arena');


/*
|--------------------------------------------------------------------------
| BOOKING LAPANGAN
|--------------------------------------------------------------------------
*/

Route::get('/booking', [BookingController::class, 'index'])
    ->name('booking.index');

Route::post('/booking', [BookingController::class, 'store'])
    ->name('booking.store');

Route::post('/booking/checkout', [BookingController::class, 'store'])
    ->name('booking.checkout');


/*
|--------------------------------------------------------------------------
| PAYMENT
|--------------------------------------------------------------------------
*/

Route::get('/payment/{id}', [PaymentController::class, 'show'])
    ->name('payment.show');

Route::post('/payment/{id}/confirm', [PaymentController::class, 'confirm'])
    ->name('payment.confirm');