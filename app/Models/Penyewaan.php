<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penyewaan extends Model
{
    protected $fillable = [
        'kendaraan_id', 'nama_penyewa', 'nik', 'alamat', 
        'durasi_sewa', 'metode_pembayaran', 'status_pembayaran'
    ];

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }
}