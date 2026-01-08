<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Admin\KendaraanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Front\SewaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==========================================
// 1. LANDING PAGE (User / Frontend)
// ==========================================
Route::get('/', [LandingController::class, 'index']);

// Route untuk memproses sewa (disiapkan untuk nanti)
// Route::post('/sewa', [LandingController::class, 'storeSewa'])->name('sewa.store'); 


// ==========================================
// 2. ADMIN PANEL
// ==========================================
// Semua route di dalam sini otomatis diawali "/admin"
Route::prefix('admin')->group(function () {

    // A. Dashboard Admin
    // URL: http://127.0.0.1:8000/admin/dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Redirect: Jika buka "/admin" saja, lempar ke "/admin/dashboard"
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    // B. CRUD Kendaraan
    // URL: http://127.0.0.1:8000/admin/kendaraan
    // Ini otomatis membuat route: index, create, store, edit, update, destroy
    // Nama route otomatis: admin.kendaraan.index, admin.kendaraan.create, dst.
    Route::resource('kendaraan', KendaraanController::class, ['as' => 'admin']);

    // C. Route Tambahan (sewa)
    Route::get('/sewa/{id}', [SewaController::class, 'create'])->name('sewa.create');
Route::post('/sewa/proses', [SewaController::class, 'store'])->name('sewa.store');
Route::get('/sewa/nota/{id}', [SewaController::class, 'nota'])->name('sewa.nota');
});