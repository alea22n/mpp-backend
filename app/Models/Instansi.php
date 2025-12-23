<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Instansi extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model ini.
     * Diasumsikan nama tabel adalah 'instansis' (plural). 
     * Jika Anda menggunakan nama tabel singular 'instansi', uncomment baris di bawah.
     * @var string
     */
    // protected $table = 'instansi';

    /**
     * Atribut yang dapat diisi secara massal (mass assignable).
     * Sesuai dengan input form di detail-instansi.blade.php
     * @var array
     */
    protected $fillable = [
        'nama_instansi',
        'subtitle',
        'alamat',
        'kontak',
        'website',
        'logo_url',      // Path ke logo di storage
        'foto_gerai_url', // Path ke foto gerai di storage
        'slug',          // Kolom slug jika Anda menggunakannya
        // Tambahkan kolom lain yang relevan seperti 'status', 'kategori', dll.
    ];

    /**
     * Dapatkan semua layanan yang disediakan oleh Instansi ini.
     * (Relasi one-to-many: Instansi memiliki banyak Layanan)
     * @return HasMany
     */
    public function layanan(): HasMany
    {
        // Asumsi foreign key di tabel 'layanans' adalah 'instansi_id'
        return $this->hasMany(Layanan::class,'instansi_id');
    }

    /**
     * Mendapatkan URL lengkap untuk logo instansi
     * (Accessor - Optional, tapi sangat berguna di Blade)
     *
     * @return string|null
     */
    public function getLogoUrlAttribute($value)
    {
        // Mengembalikan URL storage jika path ada
        return $value ? url('storage/' . $value) : null;
    }

    /**
     * Mendapatkan URL lengkap untuk foto gerai
     * (Accessor - Optional)
     *
     * @return string|null
     */
    public function getFotoGeraiUrlAttribute($value)
    {
        // Mengembalikan URL storage jika path ada
        return $value ? url('storage/' . $value) : null;
    }
}