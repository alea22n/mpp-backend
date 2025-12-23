<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Layanan;
use App\Models\Instansi;
use Illuminate\Support\Facades\Schema;

class LayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Bersihkan tabel layanan sebelum mengisi
        Schema::disableForeignKeyConstraints();
        Layanan::truncate();
        Schema::enableForeignKeyConstraints();

        // 2. Ambil Instansi dengan nama yang SAMA PERSIS dengan InstansiSeeder
        
        // Mencari DPMPTSP Prov Jawa Tengah
        $dpmptsp = Instansi::where('nama_instansi', 'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu (DPMPTSP) Prov. Jawa Tengah')->first();
        
        // Mencari BKD Sukoharjo (Sesuai data di InstansiSeeder Anda)
        $bkd = Instansi::where('nama_instansi', 'Badan Keuangan Daerah (BKD) Kab. Sukoharjo')->first();
        
        // Mencari Dukcapil Sukoharjo
        $dukcapil = Instansi::where('nama_instansi', 'Dinas Kependudukan dan Pencatatan Sipil Kab. Sukoharjo')->first();

        // 3. Buat layanan dan hubungkan dengan Instansi menggunakan relasi

        if ($dpmptsp) {
            $dpmptsp->layanan()->createMany([
                [
                    'nama' => 'Izin Mendirikan Bangunan (IMB)',
                    'biaya' => 'Berbiaya',
                    'syarat' => 'Ada Persyaratan',
                    'layananPdf' => 'persyaratan/imb.pdf',
                ],
                [
                    'nama' => 'Izin Usaha Mikro Kecil (IUMK)',
                    'biaya' => 'Gratis',
                    'syarat' => 'Tidak Ada Persyaratan',
                    'layananPdf' => null,
                ],
            ]);
        }
        
        if ($bkd) {
            $bkd->layanan()->createMany([
                [
                    'nama' => 'Pembayaran Retribusi Daerah',
                    'biaya' => 'Berbiaya',
                    'syarat' => 'Ada Persyaratan',
                    'layananPdf' => 'persyaratan/retribusi.pdf',
                ],
            ]);
        }
        
        if ($dukcapil) {
             $dukcapil->layanan()->createMany([
                [
                    'nama' => 'Pencetakan KTP-el Baru',
                    'biaya' => 'Gratis',
                    'syarat' => 'Ada Persyaratan',
                    'layananPdf' => 'persyaratan/ktp_baru.pdf',
                ],
            ]);
        }
    }
}