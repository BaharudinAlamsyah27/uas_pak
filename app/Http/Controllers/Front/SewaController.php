<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use App\Models\Penyewaan;
use Illuminate\Http\Request;

class SewaController extends Controller
{
    // Menampilkan form sewa
    public function create($id)
    {
        $mobil = Kendaraan::findOrFail($id);
        return view('front.sewa', compact('mobil'));
    }

    // Menyimpan transaksi sewa (Poin 5b)
    public function store(Request $request)
    {
        $mobil = Kendaraan::findOrFail($request->kendaraan_id);
        
        $total_harga = $mobil->harga * $request->durasi_sewa;

        $sewa = Penyewaan::create([
            'kendaraan_id' => $request->kendaraan_id,
            'nama_penyewa' => $request->nama_penyewa,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'durasi_sewa' => $request->durasi_sewa,
            'metode_pembayaran' => $request->metode_pembayaran,
            'total_harga' => $total_harga,
            'status_pembayaran' => 'pending'
        ]);

        // Update status mobil menjadi disewa
        $mobil->update(['status' => 'disewa']);

        return redirect()->route('sewa.nota', $sewa->id)->with('success', 'Pemesanan Berhasil!');
    }

    // Menampilkan Nota (Poin 5c)
    public function nota($id)
    {
        $sewa = Penyewaan::with('kendaraan')->findOrFail($id);
        return view('front.nota', compact('sewa'));
    }
}