<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_kembali_peminjaman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kembali_peminjaman_id')->references('id')->on('kembali_peminjaman')->onDelete('cascade');
            $table->foreignId('alat_id')->references('id')->on('alat')->onDelete('cascade');
            $table->enum('kondisi_akhir', ['Baik', 'Rusak']);
            $table->integer('jumlah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_kembali_peminjaman');
    }
};
