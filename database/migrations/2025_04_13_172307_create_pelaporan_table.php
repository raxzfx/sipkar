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
        Schema::create('pelaporan', function (Blueprint $table) {
            $table->id('id_pelaporan');
            $table->string('kode_unik');
            $table->date('tanggal_pelaporan');
            $table->text('aktivitas');
            $table->text('keterangan');
            $table->foreignId('user_id')->references('id_user')->on('user')->onDelete('cascade');
            $table->enum('status', ['pending', 'selesai', 'revisi', 'ditolak' ])->default('pending');
            $table->string('file')->nullable(); 
            $table->string('komentar')->nullable();
            $table->decimal('nilai_akhir', 5, 2)->nullable();
            $table->integer('nilai_1')->nullable();
            $table->integer('nilai_2')->nullable();
            $table->integer('nilai_3')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelaporan');
    }
};
