<?php

// File: database/migrations/YYYY_MM_DD_HHMMSS_create_layanans_table.php

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
        Schema::create('layanans', function (Blueprint $table) {
            $table->id();
            
            // Foreign Key ke tabel Instansis
            $table->foreignId('instansi_id')
                  ->constrained('instansis')
                  ->onDelete('cascade');

            $table->string('nama');
            
            // PERUBAHAN DI SINI: Mengubah Enum menjadi String
            // Kita beri default 'Gratis' agar tetap aman jika data kosong
            $table->string('biaya')->default('Gratis'); 
            
            // Opsional: Jika Anda ingin 'syarat' juga lebih fleksibel, 
            // ubah juga menjadi string seperti di bawah ini:
            $table->string('syarat')->default('Tidak Ada Persyaratan');
            
            $table->string('layananPdf')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanans');
    }
};