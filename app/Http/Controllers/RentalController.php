<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class RentalController extends Controller
{
    // ==========================================================
    // 1. TAMPILKAN HALAMAN FORM SEWA
    // ==========================================================
    public function create($kendaraan_id)
    {
        // Cari kendaraan, pastikan statusnya Tersedia
        $kendaraan = Kendaraan::where('id', $kendaraan_id)
                        ->where('status', 'Tersedia')
                        ->firstOrFail();

        return view('front.rental.create', compact('kendaraan'));
    }

    // ==========================================================
    // 2. PROSES SIMPAN DATA SEWA
    // ==========================================================
    public function store(Request $request)
    {
        // A. Validasi Input
        $request->validate([
            'kendaraan_id' => 'required|exists:kendaraan,id',
            'start_date'   => 'required|date|after_or_equal:today',
            'end_date'     => 'required|date|after:start_date',
        ]);

        $kendaraan = Kendaraan::findOrFail($request->kendaraan_id);

        // B. Cek Status Terakhir (Mencegah Double Booking)
        if ($kendaraan->status !== 'Tersedia') {
            return back()->with('error', 'Maaf, kendaraan ini baru saja disewa orang lain.');
        }

        // C. Hitung Durasi Hari
        $start = Carbon::parse($request->start_date);
        $end = Carbon::parse($request->end_date);
        $days = $start->diffInDays($end);
        
        // Jika sewa hari yang sama, dihitung 1 hari
        $days = $days == 0 ? 1 : $days; 

        // D. Hitung Total Harga
        $totalPrice = $kendaraan->harga * $days; 

        // E. Simpan Data ke Tabel Rentals
        Rental::create([
            'user_id'      => Auth::id(),
            'kendaraan_id' => $kendaraan->id,
            'start_date'   => $request->start_date,
            'end_date'     => $request->end_date,
            'total_price'  => $totalPrice,
            'status'       => 'active'
        ]);

        // F. Update Status Kendaraan Menjadi "Sedang Disewa"
        $kendaraan->update([
            'status' => 'Sedang Disewa'
        ]);

        // G. Redirect ke Halaman Riwayat
        return redirect()->route('rental.history')->with('success', 'Sewa berhasil dibuat! Silakan cek status Anda.');
    }

    // ==========================================================
    // 3. HALAMAN RIWAYAT SEWA USER
    // ==========================================================
    public function history()
    {
        // Ambil data sewa milik user yang sedang login
        $rentals = Rental::where('user_id', Auth::id())
                        ->with('kendaraan') // Load relasi kendaraan
                        ->latest()
                        ->get();

        return view('front.rental.history', compact('rentals'));
    }

    // ==========================================================
    // 4. DETAIL / NOTA TRANSAKSI (Opsional/Tambahan)
    // ==========================================================
    public function show($id)
    {
        $rental = Rental::with('kendaraan')->where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('front.rental.show', compact('rental'));
    }

    // ==========================================================
    // 5. PROSES PENGEMBALIAN (RETURN)
    // ==========================================================
    // Fungsi ini biasanya dipanggil oleh Admin, atau User (jika sistem self-return)
    public function returnItem($id)
    {
        // Cari data rental
        $rental = Rental::findOrFail($id);

        // Pastikan rental statusnya masih active
        if ($rental->status !== 'active') {
            return back()->with('error', 'Transaksi ini sudah selesai sebelumnya.');
        }

        // 1. Update status rental
        $rental->update([
            'status' => 'returned',
            'returned_at' => Carbon::now()
        ]);

        // 2. Kembalikan status Kendaraan menjadi "Tersedia"
        $kendaraan = Kendaraan::findOrFail($rental->kendaraan_id);
        $kendaraan->update([
            'status' => 'Tersedia'
        ]);

        return back()->with('success', 'Kendaraan berhasil dikembalikan.');
    }
}