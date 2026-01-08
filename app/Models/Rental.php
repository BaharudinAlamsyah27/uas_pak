<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'start_date',
        'end_date',
        'total_price',
        'status',
        'returned_at'
    ];

    // Relasi ke User (Penyewa)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Produk
    public function product()
    {
       return $this->belongsTo(Product::class);
    }
}