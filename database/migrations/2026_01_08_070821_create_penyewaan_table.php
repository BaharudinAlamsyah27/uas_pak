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
    Schema::create('penyewaan', function (Blueprint $table) {
        $table->id();
        $table->foreignId('kendaraan_id')->constrained('kendaraans')->onDelete('cascade');
        $table->string('nama_penyewa');
        $table->string('nik');
        $table->text('alamat');
        $table->integer('durasi_sewa');   // Hitungan hari
        $table->enum('metode_pembayaran', ['tunai', 'transfer']);
        $table->enum('status_pembayaran', ['lunas', 'belum_lunas'])->default('belum_lunas');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyewaan');
    }
};
