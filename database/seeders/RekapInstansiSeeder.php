<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // Digunakan untuk menghasilkan tanggal acak yang lebih mudah

class RekapInstansiSeeder extends Seeder
{
    public function run(): void
    {
        $instansiNames = [
            "Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu (DPMPTSP) Prov. Jawa Tengah",
            "Unit Pelaksana Teknis Badan Pelindungan Pekerja Migran Indonesia (UPT BP2MI) Kota Semarang",
            "Unit Pengelolaan Pendapatan Daerah (UPPD) Kab. Sukoharjo",
            "Polres Sukoharjo",
            "Kejaksaan Negeri Sukoharjo",
            "Kementerian Agama Kab. Sukoharjo",
            "Pengadilan Negeri Sukoharjo Kelas IA",
            "Pengadilan Agama Kab. Sukoharjo",
            "Kantor Pajak Pratama (KPP) Kab. Sukoharjo",
            "Loka POM Surakarta",
            "PT Taspen",
            "BPJS Kesehatan",
            "BPJS Ketenagakerjaan",
            "Kantor Pertanahan Kab. Sukoharjo",
            "Dinas Kesehatan Kab. Sukoharjo",
            "Dinas Perdagangan, Koperasi Usaha Kecil dan Menengah Kab. Sukoharjo",
            "Dinas Pekerjaan Umum dan Penataan Ruang Kab. Sukoharjo",
            "Dinas Lingkungan Hidup Kab. Sukoharjo",
            "Dinas Kependudukan dan Pencatatan Sipil Kab. Sukoharjo",
            "Badan Keuangan Daerah (BKD) Kab. Sukoharjo",
            "Dinas Sosial Kab. Sukoharjo",
            "Dinas Pendidikan dan Kebudayaan Kab. Sukoharjo",
            "Badan Kesatuan Bangsa dan Politik",
            "Dinas Kearsipan dan Perpustakaan Kab. Sukoharjo",
            "Dinas Perhubungan Kab. Sukoharjo",
            "Dinas Perindustrian dan Tenaga Kerja Kab. Sukoharjo",
            "Dinas Pengendalian Penduduk Keluarga Berencana dan Pemberdayaan Perempuan dan Perlindungan Anak (DPPKBP3A) Kab. Sukoharjo",
            "Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu (DPMPTSP) Kab. Sukoharjo",
            "Bank Jateng Cabang Sukoharjo",
            "BRI",
            "Bank Sukoharjo",
            "PDAM Tirta Makmur",
            "PT. Pegadaian",
        ];

        $data = [];
        foreach ($instansiNames as $name) {
            // Logika sederhana untuk membuat data acak
            $layanan = rand(2, 20);
            $permohonan = rand(100, 2000);
            $pengguna = rand(5, 75);
            
            // Generate tanggal acak dalam 30 hari terakhir
            $updateDate = Carbon::now()->subDays(rand(1, 30))->toDateString();

            // Beberapa instansi kunci (Polres, DPMPTSP) diberi nilai yang lebih tinggi
            if (str_contains($name, 'DPMPTSP') || str_contains($name, 'Polres')) {
                 $permohonan = rand(1500, 4500);
                 $pengguna = rand(50, 150);
            }
            
            $data[] = [
                'nama_instansi' => $name,
                'jumlah_layanan' => $layanan,
                'total_permohonan' => $permohonan,
                'pengguna_aktif' => $pengguna,
                'update_terakhir' => $updateDate,
            ];
        }

        foreach ($data as $item) {
            DB::table('rekap_instansi')->updateOrInsert(
                // Kunci unik untuk update/insert adalah nama_instansi
                ['nama_instansi' => $item['nama_instansi']],
                // Data yang akan diisi/diperbarui
                array_merge($item, ['created_at' => now(), 'updated_at' => now()])
            );
        }
    }
}