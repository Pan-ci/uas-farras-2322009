<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransactionHistoryController;
use App\Http\Controllers\Auth\CustomerLoginController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Middlewares\RoleMiddleware;
use Spatie\Permission\Middlewares\PermissionMiddleware;
use Spatie\Permission\Middlewares\RoleOrPermissionMiddleware;
use App\Http\Middleware\Authenticate;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use App\Http\Controllers\Auth\CustomerRegisterController;

// Halaman Dashboard Admin yang hanya bisa diakses oleh admin
Route::middleware([
    'auth',
    CheckRole::class . ':admin'
])->group(function () {
    Route::get('/admin', [UserController::class, 'index'])->name('users.index');
    Route::get('/admin/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/admin/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/admin/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/admin/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/admin/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/transaction-history', [TransactionHistoryController::class, 'index'])->name('transaction-history.index');

    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::get('/categories/create-cat', [CategoryController::class, 'create_cat'])->name('categories-cat.create');
    Route::get('/categories/create-ed', [CategoryController::class, 'create_ed'])->name('categories-ed.create');

    Route::post('/products/products', [ProductController::class, 'store'])->name('products.store');
    Route::post('/categories/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::post('/categories/categories-cat', [CategoryController::class, 'store_cat'])->name('categories-cat.store');
    Route::post('/categories/categories-ed', [CategoryController::class, 'store_ed'])->name('categories-ed.store');

    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::get('/customers/{id}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');

    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::put('/customers/{id}', [CustomerController::class, 'update'])->name('customers.update');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');

    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});

Route::middleware([
    'auth',
    CheckRole::class . ':admin,seller'
])->group(function () {
    // hanya admin dan editor yang bisa mengakses rute ini
    Route::get('/transactions/{id}/receipt', [TransactionController::class, 'printReceipt'])->name('transactions.receipt');

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');

    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::post('/customers/customers', [CustomerController::class, 'store'])->name('customers.store');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('/transactions/transactions', [TransactionController::class, 'store'])->name('transactions.store');

    Route::get('/transaction/from-cart', [TransactionController::class, 'create_from_cart'])->name('transaction.from-cart');
    Route::post('/transaction/from-cart/store', [TransactionController::class, 'storeFromCart'])->name('transaction.store-from-cart');
    // Route::get('/cart/json', [CartController::class, 'json'])->name('cart.json');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/cart/{id}/process', [CartController::class, 'process'])->name('cart.process');
    Route::get('/cart/{id}/cancel', [CartController::class, 'cancel'])->name('cart.cancel');

    Route::get('/report', [ReportController::class, 'index'])->name('report.index');
});

Route::middleware([
    'auth',
    CheckRole::class . ':buyer,regular'
])->group(function () {
    Route::get('/transactions-customer', [TransactionController::class, 'index_customer'])->name('transactions.index-customer');
    Route::get('/cart-customer', [CartController::class, 'index_customer'])->name('cart.index-customer');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/cart/get', [CartController::class, 'getCart'])->name('cart.json');
});

// Halaman Welcome dan Dashboard yang bisa diakses oleh semua pengguna yang terverifikasi
Route::get('/', function () {
    return view('welcome');
})->name('/');

// di routes/web.php
Route::get('/dashboard', [DashboardController::class, 'index'])
->middleware(['auth', 'verified'])
->name('dashboard');

// Route untuk Profile (Setiap pengguna yang terverifikasi bisa akses)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Memuat file auth.php untuk rute otentikasi standar Laravel
require __DIR__.'/auth.php';
