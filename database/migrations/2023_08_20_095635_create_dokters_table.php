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
        Schema::create('dokters', function (Blueprint $table) {
            $table->id('id');
            $table->string('nama_dokter', 255);
            $table->string('foto', 255);
            $table->string('ttl', 255);
            $table->string('alamat_praktek', 255);
            $table->string('no_rek', 255);
            $table->string('tgl_rek', 255);
            $table->string('certificate_photo', 150)->nullable();
            $table->string('masa_berlaku', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokters');
    }
};
