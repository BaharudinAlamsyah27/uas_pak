<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('kendaraan', function (Blueprint $table) {
        $table->id();
        $table->string('merk');           // Contoh: Toyota Avanza
        $table->text('deskripsi');        // Fasilitas/Kondisi
        $table->integer('harga');         // Harga sewa per hari
        $table->string('plat_nomor');
        $table->string('gambar');         // Path foto mobil
        $table->enum('status', ['tersedia', 'disewa'])->default('tersedia');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraan');
    }
};
