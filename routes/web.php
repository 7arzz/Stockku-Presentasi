<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route(Auth::user()->role . '.dashboard');
    }
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Kasir Role (Only Transactions)
Route::middleware(['auth', 'role:kasir'])->group(function() {
    Route::get('/kasir/dashboard', function() {
        return view('dashboard', ['title' => 'Dashboard Kasir']);
    })->name('kasir.dashboard');

    Route::get('/kasir', [TransactionController::class, 'index'])->name('kasir.index');
    Route::post('/kasir', [TransactionController::class, 'store'])->name('kasir.store');
});

// Admin Role (Full CRUD Products, Reports)
Route::middleware(['auth', 'role:admin'])->group(function() {
    Route::get('/admin/dashboard', function() {
        return view('dashboard', ['title' => 'Dashboard Admin']);
    })->name('admin.dashboard');

    Route::resource('admin/products', ProductController::class)->names('products');
    Route::get('/admin/transactions', [TransactionController::class, 'history'])->name('admin.transactions');
});

// Gudang Role (Only see & update stock)
Route::middleware(['auth', 'role:gudang'])->group(function() {
    Route::get('/gudang/dashboard', function() {
        return view('dashboard', ['title' => 'Dashboard Gudang']);
    })->name('gudang.dashboard');

    Route::get('/gudang/products', [ProductController::class, 'index'])->name('gudang.products');
    Route::get('/gudang/products/{id}/edit', [ProductController::class, 'edit'])->name('gudang.products.edit');
    Route::put('/gudang/products/{id}', [ProductController::class, 'update'])->name('gudang.products.update');
});

// Owner Role (Read Only Reports)
Route::middleware(['auth', 'role:owner'])->group(function() {
    Route::get('/owner/dashboard', function() {
        return view('dashboard', ['title' => 'Dashboard Owner']);
    })->name('owner.dashboard');

    Route::get('/owner/products', [ProductController::class, 'index'])->name('owner.products');
    Route::get('/owner/transactions', [TransactionController::class, 'history'])->name('owner.transactions');
});
