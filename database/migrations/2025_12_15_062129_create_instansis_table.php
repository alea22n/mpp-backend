<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations (Membuat tabel instansis).
     */
    public function up(): void
    {
        Schema::create('instansis', function (Blueprint $table) {
            $table->id();
            
            // Kolom Data Utama (sesuai Instansi.php dan Controller update)
            $table->string('nama_instansi')->unique(); // Wajib unik
            $table->string('subtitle')->nullable();
            $table->text('alamat')->nullable();
            $table->string('kontak', 50)->nullable();
            $table->string('website')->nullable();
            
            // Kolom File Upload (sesuai InstansiController::update)
            $table->string('logo_url')->nullable(); 
            $table->string('foto_gerai_url')->nullable();
            
            // Kolom untuk URL (Route Model Binding)
            $table->string('slug')->unique()->nullable(); 

            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations (Menghapus tabel instansis jika di-rollback).
     */
    public function down(): void
    {
        Schema::dropIfExists('instansis');
    }
};