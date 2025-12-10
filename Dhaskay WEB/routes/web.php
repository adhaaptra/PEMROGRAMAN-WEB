<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\StockController;

// Auth Routes (guest middleware - hanya untuk yang belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Logout (hanya untuk yang sudah login)
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Product, Store, Stock Routes (protected dengan auth middleware)
Route::middleware('auth')->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('stores', StoreController::class);
    Route::resource('stocks', StockController::class);
});

// Dashboard / Home
Route::get('/', function () {
    return view('dashboard');
})->name('home');
