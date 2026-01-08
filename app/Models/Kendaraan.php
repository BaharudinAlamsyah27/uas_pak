<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Tambahkan ini (opsional tapi disarankan)
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory; // Tambahkan ini jika ingin pakai seeder/factory

    /**
     * Menentukan nama tabel secara eksplisit.
     * Ini mengatasi error "no such table: kendaraans"
     */
    protected $table = 'kendaraan';

    protected $fillable = [
        'merk', 
        'deskripsi', 
        'harga', 
        'plat_nomor', 
        'gambar', 
        'status'
    ];

    public function penyewaan()
    {
        return $this->hasMany(Penyewaan::class);
    }
}