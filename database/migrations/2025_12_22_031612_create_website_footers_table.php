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
        Schema::create('website_footers', function (Blueprint $table) {
            $table->id();
            
            // Informasi Kontak & Alamat
            $table->text('address')->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('whatsapp', 50)->nullable();
            $table->string('email')->nullable();
            
            // Lokasi Kami (Gunakan TEXT karena URL Google Maps seringkali sangat panjang)
            $table->text('location_url')->nullable(); 
            
            // Media Sosial (Gunakan string atau text)
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('twitter')->nullable();
            
            // Jam Operasional (Format HH:mm)
            $table->string('open_weekdays', 10)->default('08:00');
            $table->string('close_weekdays', 10)->default('15:30');
            $table->string('open_friday', 10)->default('08:00');
            $table->string('close_friday', 10)->default('11:30');
            
            // Catatan Akhir Pekan
            $table->string('weekend_notes')->default('Sabtu - Minggu: Tutup');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_footers');
    }
};