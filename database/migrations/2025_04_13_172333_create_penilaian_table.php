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
        Schema::create('penilaian', function (Blueprint $table) {
            $table->id('id_nilai');
            $table->foreignId('karyawan')->references('id_user')->on('user')->onDelete('cascade');
            $table->foreignId('kategori_id')->references('id_kategori_penilaian')->on('kategori_penilaian')->onDelete('cascade');
            $table->foreignId('tim_penilai')->references('id_user')->on('user')->onDelete('cascade');
            $table->integer('skor');
            $table->date('tanggal_penilaian');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian');
    }
};
