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
        $table->foreignId('kendaraan_id')->constrained('kendaraan')->onDelete('cascade');
        $table->string('nama_penyewa');
        $table->string('nik');
        $table->text('alamat');
        $table->integer('durasi_sewa'); // dalam hari
        $table->string('metode_pembayaran');
        $table->string('status_pembayaran')->default('Lunas');
        $table->integer('total_harga');
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
