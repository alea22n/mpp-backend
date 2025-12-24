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
        Schema::create('layanans', function (Blueprint $table) {
            $table->id();
            
            // Foreign Key ke tabel instansis
            $table->foreignId('instansi_id')
                  ->constrained('instansis')
                  ->onDelete('cascade');

            $table->string('nama');
            
            // Menggunakan string untuk biaya (contoh: "Gratis", "Rp 50.000")
            $table->string('biaya')->default('Gratis'); 
            
            // Menggunakan text agar bisa menampung banyak baris persyaratan
            $table->text('syarat')->nullable();
            
            // Path ke file PDF persyaratan
            $table->string('layanan_pdf')->nullable();

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