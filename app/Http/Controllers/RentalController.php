<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class RentalController extends Controller
{
    // Fungsi untuk memproses Sewa (Store)
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date'   => 'required|date|after:start_date',
        ]);

        $product = Product::findOrFail($request->product_id);

        // 2. Cek ketersediaan barang (Opsional: jika stok terbatas)
        // Jika Anda punya kolom 'stock' atau 'is_available' di tabel products
        if ($product->stock < 1) {
            return response()->json(['message' => 'Barang sedang tidak tersedia'], 400);
        }

        // 3. Hitung Durasi dan Total Harga
        $start = Carbon::parse($request->start_date);
        $end = Carbon::parse($request->end_date);
        $days = $start->diffInDays($end);
        
        // Minimal hitungan 1 hari jika dikembalikan di hari yang sama (opsional)
        $days = $days == 0 ? 1 : $days; 

        $totalPrice = $product->price_per_day * $days;

        // 4. Simpan ke Database
        $rental = Rental::create([
            'user_id'     => Auth::id(), // Asumsi user sudah login
            'product_id'  => $product->id,
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date,
            'total_price' => $totalPrice,
            'status'      => 'active'
        ]);

        // 5. Kurangi Stok (Jika ada manajemen stok)
        $product->decrement('stock');

        return response()->json([
            'message' => 'Sewa berhasil dibuat',
            'data' => $rental
        ], 201);
    }

    // Fungsi Pengembalian Barang (Return)
    public function returnItem($id)
    {
        $rental = Rental::findOrFail($id);

        if ($rental->status !== 'active') {
            return response()->json(['message' => 'Transaksi ini sudah selesai sebelumnya'], 400);
        }

        // Update status
        $rental->update([
            'status' => 'returned',
            'returned_at' => Carbon::now()
        ]);

        // Kembalikan Stok Produk
        $product = Product::findOrFail($rental->product_id);
        $product->increment('stock');

        return response()->json(['message' => 'Barang berhasil dikembalikan'], 200);
    }
}