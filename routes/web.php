<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StokMasukController;
use App\Http\Controllers\StokKeluarController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

// Auth Routes (Guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// Protected Routes (Authenticated)
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Dashboard - Semua role
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Barang - Semua role bisa lihat
    Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
    
    // Barang - Admin & Staf Gudang bisa tambah/edit
    Route::middleware('role:admin,staf_gudang')->group(function () {
        Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
        Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
        Route::get('/barang/{barang}/edit', [BarangController::class, 'edit'])->name('barang.edit');
        Route::put('/barang/{barang}', [BarangController::class, 'update'])->name('barang.update');
    });
    
    // Barang - Hanya Admin bisa hapus
    Route::delete('/barang/{barang}', [BarangController::class, 'destroy'])
        ->middleware('role:admin')
        ->name('barang.destroy');
    
    // Stok Masuk - Admin & Staf Gudang
    Route::middleware('role:admin,staf_gudang')->group(function () {
        Route::resource('stok-masuk', StokMasukController::class)->only(['index', 'create', 'store', 'destroy']);
    });
    
    // Stok Keluar - Admin & Kasir
    Route::middleware('role:admin,kasir')->group(function () {
        Route::resource('stok-keluar', StokKeluarController::class)->only(['index', 'create', 'store', 'destroy']);
    });
    
    // Laporan Stok - Semua role
    Route::get('/laporan/stok', [LaporanController::class, 'stok'])->name('laporan.stok');
    
    // Laporan Barang Masuk - Admin & Staf Gudang
    Route::get('/laporan/masuk', [LaporanController::class, 'masuk'])
        ->middleware('role:admin,staf_gudang')
        ->name('laporan.masuk');
    
    // Laporan Barang Keluar - Admin & Kasir
    Route::get('/laporan/keluar', [LaporanController::class, 'keluar'])
        ->middleware('role:admin,kasir')
        ->name('laporan.keluar');
    
    // User Management - Hanya Admin
    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class);
    });
});
