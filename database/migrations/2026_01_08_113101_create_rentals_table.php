<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Ubah product_id menjadi kendaraan_id
            $table->foreignId('kendaraan_id')->constrained('kendaraan')->onDelete('cascade'); 
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('total_price', 15, 2); // 15,2 untuk angka rupiah besar
            $table->enum('status', ['active', 'returned', 'overdue'])->default('active');
            $table->date('returned_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rentals');
    }
};