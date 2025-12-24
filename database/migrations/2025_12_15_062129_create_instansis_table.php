<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('instansis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_instansi')->unique();
            $table->string('slug')->unique();
            $table->string('subtitle')->nullable();
            $table->text('alamat')->nullable();
            $table->string('kontak', 50)->nullable();
            $table->string('email')->nullable(); // Disamakan dengan Seeder
            $table->string('website')->nullable();
            
            // Sosial Media
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            
            // File Upload
            $table->string('logo_url')->nullable(); 
            $table->string('foto_gerai')->nullable(); // Disamakan dengan Seeder
            $table->string('file_mekanisme')->nullable(); // Disamakan dengan Seeder

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('instansis');
    }
};