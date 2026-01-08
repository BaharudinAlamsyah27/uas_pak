<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kendaraan_id', // Sesuaikan nama kolom
        'start_date',
        'end_date',
        'total_price',
        'status',
        'returned_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Kendaraan
    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'kendaraan_id');
    }
}