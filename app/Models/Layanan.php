<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Layanan extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model ini.
     * Diasumsikan nama tabel adalah 'layanans'. Jika Anda menggunakan 'layanan', uncomment baris di bawah.
     * @var string
     */
    // protected $table = 'layanan';

    /**
     * Atribut yang dapat diisi secara massal (mass assignable).
     * Sesuai dengan kolom yang digunakan di Controller.
     * @var array
     */
    protected $fillable = [
        'instansi_id', // Foreign Key
        'nama',
        'biaya',      // Contoh: 'Berbiaya', 'Tidak Berbiaya'
        'syarat',     // Contoh: 'Ada Persyaratan', 'Tidak Ada Persyaratan'
        'layananPdf', // Path file PDF persyaratan
    ];
    
    /**
     * Relasi: Dapatkan instansi pemilik layanan ini.
     * Digunakan untuk Route Model Binding di Controller.
     * @return BelongsTo
     */
    public function instansi(): BelongsTo
    {
        return $this->belongsTo(Instansi::class,'instansi_id');
    }
}