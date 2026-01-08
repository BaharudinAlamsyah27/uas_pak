<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kendaraan;

class LandingController extends Controller
{
    // 1. Tambahkan fungsi index ini
    public function index() {
        $mobils = Kendaraan::where('status', 'tersedia')->get();
        return view('landing', compact('mobils'));
}

    // 2. Karena di route tadi kamu juga ada 'storeSewa',
    // sebaiknya buat sekalian kerangkanya agar tidak error nanti.
    public function storeSewa(Request $request)
    {
        // Logika penyimpanan sewa nanti di sini
        return "Proses Sewa Berhasil (Dummy)";
    }
}