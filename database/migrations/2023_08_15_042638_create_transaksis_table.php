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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('pelanggan_id');
            $table->unsignedBigInteger('hewan_id');
            $table->unsignedBigInteger('layanan_id');
            $table->unsignedBigInteger('paket_id');
            $table->unsignedBigInteger('dokter_id')->nullable();
            $table->date('tgl_transaksi');
            $table->time('jam_antar');
            $table->time('jam_jemput');
            $table->string('total', 255);
            $table->enum('status', ['belum dikonfirmasi', 'proses', 'selesai', 'dll'])->default('belum dikonfirmasi');
            $table->integer('nomor_antrian')->default(1);
            $table->datetime('deadline')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
