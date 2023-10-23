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
        Schema::create('pakets', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('layanan_id');
            $table->string('nama_paket', 255);
            $table->string('harga', 255);
            $table->string('deskripsi', 255);
            $table->enum('status', ['tersedia', 'tidak tersedia'])->default('tidak tersedia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pakets');
    }
};
