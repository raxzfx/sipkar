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
        Schema::create('histori', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pelaporan_id');
            $table->foreign('pelaporan_id')->references('id_pelaporan')->on('pelaporan')->onDelete('cascade');
            $table->foreignId('user_id')->references('id_user')->on('user')->onDelete('cascade');
            $table->enum('status', ['revisi', 'selesai', 'ditolak']);
            $table->decimal('nilai_akhir', 5, 2)->nullable();
            $table->string('komentar')->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histori');
    }
};
