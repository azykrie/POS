<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

route::get('/login', [LoginController::class, 'index']);
route::post('/login', [LoginController::class, 'login'])->name('login');
route::post('/logout', [LoginController::class, 'logout'])->name('logout');

route::middleware(['role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
});

Route::middleware(['role:cashier,admin'])->group(function () {
    Route::get('/transaction/invoice', [InvoiceController::class, 'pdf']);
    Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction.index');
});
