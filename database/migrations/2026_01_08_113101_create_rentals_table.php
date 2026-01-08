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
    Schema::create('rentals', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Peminjam
        $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Barang yang disewa
        $table->date('start_date'); // Tanggal mulai
        $table->date('end_date');   // Tanggal kembali
        $table->decimal('total_price', 10, 2); // Total harga sewa
        $table->enum('status', ['active', 'returned', 'overdue'])->default('active'); // Status sewa
        $table->date('returned_at')->nullable(); // Tanggal aktual pengembalian
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
