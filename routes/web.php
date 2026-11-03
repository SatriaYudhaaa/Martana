<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

// Register
Route::get('/register', function () {
    return view('auth.register');
})->middleware('guest');

Route::post('/register', [AuthController::class, 'register'])
    ->middleware('guest');

// Login
Route::get('/login', function () {
    return view('auth.login');
})->middleware('guest');

Route::post('/login', [AuthController::class, 'login'])
    ->middleware('guest');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth');