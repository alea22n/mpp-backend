<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Instansi extends Model
{
    use HasFactory;

    protected $table = 'instansis'; 

    /**
     * Atribut yang dapat diisi secara massal.
     * Nama-nama di bawah ini harus sama dengan yang ada di migration dan seeder.
     */
    protected $fillable = [
        'nama_instansi',
        'slug',
        'subtitle',
        'alamat',
        'email',
        'kontak',
        'website',
        'facebook',
        'instagram',
        'twitter',
        'logo_url',
        'foto_gerai',     // Sesuaikan dengan seeder (sebelumnya foto_gerai_url)
        'file_mekanisme', // Tambahkan ini karena dipanggil di seeder
    ];

    /**
     * Relasi ke Layanan (One to Many)
     */
    public function layanan(): HasMany
    {
        return $this->hasMany(Layanan::class, 'instansi_id');
    }

    /**
     * Accessor untuk Logo
     */
    public function getLogoFullUrlAttribute()
    {
        return $this->logo_url ? asset('storage/' . $this->logo_url) : asset('images/default-logo.png');
    }

    /**
     * Accessor untuk Foto Gerai
     * Diubah dari foto_gerai_url ke foto_gerai agar sesuai database/seeder
     */
    public function getFotoGeraiFullUrlAttribute()
    {
        return $this->foto_gerai ? asset('storage/' . $this->foto_gerai) : asset('images/default-gerai.jpg');
    }

    /**
     * Menggunakan slug untuk pencarian route
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}