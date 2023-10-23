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
        Schema::create('jadwal_dokter', function (Blueprint $table) {
            $table->id('id_jadwal');
            $table->unsignedBigInteger('id_dokter'); // Kolom ID Dokter
            $table->integer('day'); // Kolom Day (integer)
            $table->time('jam_mulai'); // Kolom Jam Mulai (time)
            $table->time('jam_selesai'); // Kolom Jam Selesai (time)
            $table->text('keterangan')->nullable(); // Kolom Keterangan (text) dengan opsi nullable
            $table->enum('status', ['aktif', 'tidak_aktif'])->default('aktif'); // ENUM 'status'
            $table->timestamps(); // Kolom created_at dan updated_at untuk penanda waktu
            $table->foreign('id_dokter')->references('id')->on('dokters'); // Kunci asing ke tabel 'dokters'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_dokter');
    }
};
