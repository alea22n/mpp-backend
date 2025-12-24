<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Layanan extends Model
{
    use HasFactory;

    protected $table = 'layanans';

    /**
     * Pastikan semua field yang ada di Seeder masuk ke sini.
     */
    protected $fillable = [
        'instansi_id',
        'nama',
        'biaya',
        'syarat',
        'layananPdf', // Pastikan nama ini sama dengan di Migration
    ];

    /**
     * Relasi ke Instansi (Many to One)
     */
    public function instansi(): BelongsTo
    {
        return $this->belongsTo(Instansi::class, 'instansi_id');
    }

    /**
     * Accessor untuk URL PDF
     * Memudahkan pemanggilan di Blade: {{ $layanan->pdf_url }}
     */
    public function getPdfUrlAttribute()
    {
        // Pastikan menggunakan properti yang benar 'layananPdf'
        return $this->layananPdf ? asset('storage/' . $this->layanan_Pdf) : null;
    }
}