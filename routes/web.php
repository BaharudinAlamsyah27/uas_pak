<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Admin\KendaraanController; // Pastikan ini mengarah ke folder Admin
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RentalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==========================================
// 1. LANDING PAGE (Public)
// ==========================================
Route::get('/', [LandingController::class, 'index'])->name('home');


// ==========================================
// 2. ADMIN PANEL ROUTES
// ==========================================
// Kita hapus "->name('admin.')" agar nama routenya kembali standar (kendaraan.index, dll)
Route::prefix('admin')->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Redirect root admin ke dashboard
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    // CRUD KENDARAAN
    // URL: /admin/kendaraan
    // Route Names: kendaraan.index, kendaraan.create, kendaraan.store, dll.
    Route::resource('kendaraan', KendaraanController::class);

});


// ==========================================
// 3. USER ROUTES (Fitur Sewa - Login Required)
// ==========================================
Route::middleware(['auth'])->group(function () {
    
    // Halaman Riwayat Transaksi
    Route::get('/riwayat-sewa', [RentalController::class, 'history'])->name('rental.history');

    // Halaman Form Sewa
    Route::get('/sewa/{kendaraan_id}', [RentalController::class, 'create'])->name('rental.create');
    
    // Proses Simpan Data Sewa
    Route::post('/sewa', [RentalController::class, 'store'])->name('rental.store');
    
    // Proses Pengembalian
    Route::post('/rentals/{id}/return', [RentalController::class, 'returnItem'])->name('rental.return');
});

