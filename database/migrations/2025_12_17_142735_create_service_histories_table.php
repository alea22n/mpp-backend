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
        Schema::create('rekap_instansi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_instansi');
            $table->integer('jumlah_layanan'); // Jumlah jenis layanan yang tersedia
            $table->integer('total_permohonan'); // Total permohonan masuk
            $table->integer('pengguna_aktif'); // Jumlah user/petugas aktif
            $table->date('update_terakhir');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_histories');
    }
};
