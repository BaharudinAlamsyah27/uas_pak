<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $fillable = [
        'merk', 'deskripsi', 'harga', 'plat_nomor', 'gambar', 'status'
    ];

    public function penyewaan()
    {
        return $this->hasMany(Penyewaan::class);
    }
}