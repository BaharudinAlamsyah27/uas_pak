<?php  // <--- JANGAN LUPA INI

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Admin\KendaraanController;
use App\Http\Controllers\AdminController; 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Landing Page (User)
Route::get('/', [LandingController::class, 'index'])->name('home');
Route::post('/sewa', [LandingController::class, 'storeSewa'])->name('sewa.store'); // Untuk proses booking

// 2. Admin Panel (Prefix /admin biar rapi)
Route::prefix('admin')->group(function () {
    
    // Dashboard Admin
    Route::get('/', [KendaraanController::class, 'index'])->name('admin.dashboard');
    
    // Resource Controller untuk CRUD Kendaraan
    Route::resource('kendaraan', KendaraanController::class);
    
    // Route tambahan untuk melihat data penyewaan
    Route::get('/penyewaan', [KendaraanController::class, 'dataPenyewaan'])->name('admin.penyewaan');

    // Route untuk Dashboard Admin
    Route::get('/admin-dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});
