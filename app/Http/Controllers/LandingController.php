<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    // 1. Tambahkan fungsi index ini
    public function index()
    {
        // Pastikan nama view-nya sesuai dengan file di resources/views
        // Contoh: jika nama filenya welcome.blade.php, tulis 'welcome'
        return view('landing'); 
    }

    // 2. Karena di route tadi kamu juga ada 'storeSewa',
    // sebaiknya buat sekalian kerangkanya agar tidak error nanti.
    public function storeSewa(Request $request)
    {
        // Logika penyimpanan sewa nanti di sini
        return "Proses Sewa Berhasil (Dummy)";
    }
}