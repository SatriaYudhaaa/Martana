<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FieldController;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');
 Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/lapangan/martana-prime', [FieldController::class, 'prime'])
    ->name('fields.prime');
Route::get('/lapangan/martana-arena', [FieldController::class, 'arena'])
    ->name('fields.arena');