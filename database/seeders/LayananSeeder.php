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
        // 1. Bersihkan tabel layanan (Fresh Start)
        Schema::disableForeignKeyConstraints();
        Layanan::truncate();
        Schema::enableForeignKeyConstraints();

        // 2. Data Layanan (Tanpa menuliskan path PDF di setiap item agar kode lebih ringkas)
        $dataLayanan = [
            "Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu (DPMPTSP) Prov. Jawa Tengah" => [
                ['nama' => 'Izin Usaha Sektor Pertanian', 'biaya' => 'Gratis', 'syarat' => 'Ada Persyaratan'],
                ['nama' => 'Konsultasi Perizinan Terpadu', 'biaya' => 'Gratis', 'syarat' => 'Tidak Ada Persyaratan'],
            ],
            "Unit Pelaksana Teknis Badan Pelindungan Pekerja Migran Indonesia (UPT BP2MI) Kota Semarang" => [
                ['nama' => 'Pendaftaran Pekerja Migran (E-PMI)', 'biaya' => 'Gratis', 'syarat' => 'Ada Persyaratan'],
            ],
            "Unit Pengelolaan Pendapatan Daerah (UPPD) Kab. Sukoharjo" => [
                ['nama' => 'Pajak Kendaraan Tahunan', 'biaya' => 'Berbiaya', 'syarat' => 'Ada Persyaratan'],
                ['nama' => 'Ganti Plat 5 Tahunan', 'biaya' => 'Berbiaya', 'syarat' => 'Ada Persyaratan'],
            ],
            "Polres Sukoharjo" => [
                ['nama' => 'Pembuatan SKCK Baru', 'biaya' => 'Berbiaya', 'syarat' => 'Ada Persyaratan'],
                ['nama' => 'Perpanjangan SIM', 'biaya' => 'Berbiaya', 'syarat' => 'Ada Persyaratan'],
            ],
            "Kejaksaan Negeri Sukoharjo" => [
                ['nama' => 'Pengambilan Barang Bukti Tilang', 'biaya' => 'Berbiaya', 'syarat' => 'Ada Persyaratan'],
                ['nama' => 'Konsultasi Hukum', 'biaya' => 'Gratis', 'syarat' => 'Tidak Ada Persyaratan'],
            ],
            "Kementerian Agama Kab. Sukoharjo" => [
                ['nama' => 'Pendaftaran Haji', 'biaya' => 'Berbiaya', 'syarat' => 'Ada Persyaratan'],
                ['nama' => 'Rekomendasi Paspor Umroh', 'biaya' => 'Gratis', 'syarat' => 'Ada Persyaratan'],
            ],
            "Pengadilan Negeri Sukoharjo Kelas IA" => [
                ['nama' => 'Surat Keterangan Tidak Pidana', 'biaya' => 'Gratis', 'syarat' => 'Ada Persyaratan'],
            ],
            "Pengadilan Agama Kab. Sukoharjo" => [
                ['nama' => 'Gugatan Mandiri / Cerai', 'biaya' => 'Berbiaya', 'syarat' => 'Ada Persyaratan'],
            ],
            "Kantor Pajak Pratama (KPP) Kab. Sukoharjo" => [
                ['nama' => 'Aktivasi EFIN Pajak', 'biaya' => 'Gratis', 'syarat' => 'Ada Persyaratan'],
                ['nama' => 'Asistensi SPT Tahunan', 'biaya' => 'Gratis', 'syarat' => 'Tidak Ada Persyaratan'],
            ],
            "Loka POM Surakarta" => [
                ['nama' => 'Sertifikasi Izin Edar P-IRT', 'biaya' => 'Gratis', 'syarat' => 'Ada Persyaratan'],
            ],
            "PT Taspen" => [
                ['nama' => 'Klaim Tunjangan Pensiun', 'biaya' => 'Gratis', 'syarat' => 'Ada Persyaratan'],
            ],
            "BPJS Kesehatan" => [
                ['nama' => 'Pendaftaran Peserta JKN', 'biaya' => 'Berbiaya', 'syarat' => 'Ada Persyaratan'],
            ],
            "BPJS Ketenagakerjaan" => [
                ['nama' => 'Klaim Jaminan Hari Tua (JHT)', 'biaya' => 'Gratis', 'syarat' => 'Ada Persyaratan'],
            ],
            "Kantor Pertanahan Kab. Sukoharjo" => [
                ['nama' => 'Balik Nama Sertifikat', 'biaya' => 'Berbiaya', 'syarat' => 'Ada Persyaratan'],
                ['nama' => 'Pengecekan Sertifikat', 'biaya' => 'Berbiaya', 'syarat' => 'Ada Persyaratan'],
            ],
            "Dinas Kesehatan Kab. Sukoharjo" => [
                ['nama' => 'Penerbitan STR Tenaga Medis', 'biaya' => 'Gratis', 'syarat' => 'Ada Persyaratan'],
            ],
            "Dinas Perdagangan, Koperasi Usaha Kecil dan Menengah Kab. Sukoharjo" => [
                ['nama' => 'Tera Ulang Timbangan', 'biaya' => 'Berbiaya', 'syarat' => 'Ada Persyaratan'],
                ['nama' => 'Pendaftaran UMKM Baru', 'biaya' => 'Gratis', 'syarat' => 'Ada Persyaratan'],
            ],
            "Dinas Pekerjaan Umum dan Penataan Ruang Kab. Sukoharjo" => [
                ['nama' => 'Informasi Tata Ruang (KRK)', 'biaya' => 'Gratis', 'syarat' => 'Ada Persyaratan'],
            ],
            "Dinas Lingkungan Hidup Kab. Sukoharjo" => [
                ['nama' => 'Rekomendasi UKL-UPL', 'biaya' => 'Gratis', 'syarat' => 'Ada Persyaratan'],
            ],
            "Dinas Kependudukan dan Pencatatan Sipil Kab. Sukoharjo" => [
                ['nama' => 'Pencetakan KTP-el', 'biaya' => 'Gratis', 'syarat' => 'Ada Persyaratan'],
                ['nama' => 'Aktivasi IKD Digital', 'biaya' => 'Gratis', 'syarat' => 'Tidak Ada Persyaratan'],
            ],
            "Badan Keuangan Daerah (BKD) Kab. Sukoharjo" => [
                ['nama' => 'Pembayaran PBB-P2', 'biaya' => 'Berbiaya', 'syarat' => 'Ada Persyaratan'],
            ],
            "Dinas Sosial Kab. Sukoharjo" => [
                ['nama' => 'Penerbitan Kartu KIS PBI', 'biaya' => 'Gratis', 'syarat' => 'Ada Persyaratan'],
            ],
            "Dinas Pendidikan dan Kebudayaan Kab. Sukoharjo" => [
                ['nama' => 'Legalisir Ijazah', 'biaya' => 'Gratis', 'syarat' => 'Ada Persyaratan'],
            ],
            "Badan Kesatuan Bangsa dan Politik" => [
                ['nama' => 'Izin Penelitian', 'biaya' => 'Gratis', 'syarat' => 'Ada Persyaratan'],
            ],
            "Dinas Kearsipan dan Perpustakaan Kab. Sukoharjo" => [
                ['nama' => 'Pendaftaran Anggota Perpus', 'biaya' => 'Gratis', 'syarat' => 'Tidak Ada Persyaratan'],
            ],
            "Dinas Perhubungan Kab. Sukoharjo" => [
                ['nama' => 'Uji Kendaraan (KIR)', 'biaya' => 'Berbiaya', 'syarat' => 'Ada Persyaratan'],
            ],
            "Dinas Perindustrian dan Tenaga Kerja Kab. Sukoharjo" => [
                ['nama' => 'Pembuatan Kartu Kuning (AK1)', 'biaya' => 'Gratis', 'syarat' => 'Ada Persyaratan'],
            ],
            "Dinas Pengendalian Penduduk Keluarga Berencana dan Pemberdayaan Perempuan dan Perlindungan Anak (DPPKBP3A) Kab. Sukoharjo" => [
                ['nama' => 'Konsultasi KB Gratis', 'biaya' => 'Gratis', 'syarat' => 'Tidak Ada Persyaratan'],
            ],
            "Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu (DPMPTSP) Kab. Sukoharjo" => [
                ['nama' => 'Persetujuan Bangunan Gedung (PBG)', 'biaya' => 'Berbiaya', 'syarat' => 'Ada Persyaratan'],
                ['nama' => 'Izin Reklame', 'biaya' => 'Berbiaya', 'syarat' => 'Ada Persyaratan'],
            ],
            "Bank Jateng Cabang Sukoharjo" => [
                ['nama' => 'Pembukaan Rekening Bima', 'biaya' => 'Berbiaya', 'syarat' => 'Ada Persyaratan'],
            ],
            "BRI" => [
                ['nama' => 'Pengajuan KUR Mikro', 'biaya' => 'Berbiaya', 'syarat' => 'Ada Persyaratan'],
            ],
            "Bank Sukoharjo" => [
                ['nama' => 'Kredit Serbaguna', 'biaya' => 'Berbiaya', 'syarat' => 'Ada Persyaratan'],
            ],
            "PDAM Tirta Makmur" => [
                ['nama' => 'Pasang Baru PDAM', 'biaya' => 'Berbiaya', 'syarat' => 'Ada Persyaratan'],
                ['nama' => 'Pembayaran Tagihan', 'biaya' => 'Berbiaya', 'syarat' => 'Ada Persyaratan'],
            ],
            "PT. Pegadaian" => [
                ['nama' => 'Gadai Emas', 'biaya' => 'Berbiaya', 'syarat' => 'Ada Persyaratan'],
                ['nama' => 'Tabungan Emas', 'biaya' => 'Berbiaya', 'syarat' => 'Ada Persyaratan'],
            ],
        ];

        // 3. Masukkan layanan ke database
        foreach ($dataLayanan as $namaInstansi => $layanans) {
            $instansi = Instansi::where('nama_instansi', $namaInstansi)->first();

            if ($instansi) {
                foreach ($layanans as $layananItem) {
                    Layanan::create([
                        'instansi_id' => $instansi->id,
                        'nama'        => $layananItem['nama'],
                        'biaya'       => $layananItem['biaya'],
                        'syarat'      => $layananItem['syarat'],
                        // Semua layanan menggunakan path yang sama sesuai permintaan Anda
                        'layanan_Pdf'  => 'instansi/persyaratan.pdf', 
                    ]);
                }
            }
        }
    }
}