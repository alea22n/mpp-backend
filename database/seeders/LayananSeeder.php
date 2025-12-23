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

        // 2. Pemetaan Data Instansi dan Layanannya
        $dataLayanan = [
            "Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu (DPMPTSP) Prov. Jawa Tengah" => [
                ['nama' => 'Izin Usaha Sektor Pertanian', 'biaya' => 'Gratis', 'syarat' => 'NIB, KTP', 'layananPdf' => 'perizinan/pertanian.pdf'],
                ['nama' => 'Konsultasi Perizinan Terpadu', 'biaya' => 'Gratis', 'syarat' => 'Tanpa Syarat', 'layananPdf' => null],
            ],
            "Unit Pelaksana Teknis Badan Pelindungan Pekerja Migran Indonesia (UPT BP2MI) Kota Semarang" => [
                ['nama' => 'Pendaftaran Pekerja Migran (E-PMI)', 'biaya' => 'Gratis', 'syarat' => 'Paspor, Kontrak Kerja', 'layananPdf' => 'bp2mi/pendaftaran.pdf'],
            ],
            "Unit Pengelolaan Pendapatan Daerah (UPPD) Kab. Sukoharjo" => [
                ['nama' => 'Pembayaran Pajak Kendaraan Tahunan', 'biaya' => 'Berbiaya', 'syarat' => 'STNK, KTP Asli', 'layananPdf' => 'uppd/pajak_tahunan.pdf'],
                ['nama' => 'Ganti Plat Nomor (5 Tahunan)', 'biaya' => 'Berbiaya', 'syarat' => 'Cek Fisik, BPKB, STNK', 'layananPdf' => 'uppd/ganti_plat.pdf'],
            ],
            "Polres Sukoharjo" => [
                ['nama' => 'Pembuatan SKCK Baru', 'biaya' => 'Berbiaya', 'syarat' => 'Rumus Sidik Jari, KTP', 'layananPdf' => 'polres/skck.pdf'],
                ['nama' => 'Perpanjangan SIM A/C', 'biaya' => 'Berbiaya', 'syarat' => 'SIM Lama, Tes Psikologi', 'layananPdf' => 'polres/sim.pdf'],
            ],
            "Kejaksaan Negeri Sukoharjo" => [
                ['nama' => 'Pengambilan Barang Bukti Tilang', 'biaya' => 'Berbiaya', 'syarat' => 'Surat Tilang, Bukti Bayar', 'layananPdf' => null],
                ['nama' => 'Konsultasi Hukum Gratis', 'biaya' => 'Gratis', 'syarat' => 'KTP', 'layananPdf' => null],
            ],
            "Kementerian Agama Kab. Sukoharjo" => [
                ['nama' => 'Pendaftaran Haji Resmi', 'biaya' => 'Berbiaya', 'syarat' => 'Setoran Awal, Domisili', 'layananPdf' => 'kemenag/haji.pdf'],
                ['nama' => 'Rekomendasi Paspor Umroh', 'biaya' => 'Gratis', 'syarat' => 'Surat Travel PPIU', 'layananPdf' => null],
            ],
            "Pengadilan Negeri Sukoharjo Kelas IA" => [
                ['nama' => 'Surat Keterangan Tidak Pernah Dipidana', 'biaya' => 'Gratis', 'syarat' => 'KTP, SKCK', 'layananPdf' => 'pn/surat_ket.pdf'],
            ],
            "Pengadilan Agama Kab. Sukoharjo" => [
                ['nama' => 'Pendaftaran Gugatan Mandiri', 'biaya' => 'Berbiaya', 'syarat' => 'Buku Nikah, KTP', 'layananPdf' => 'pa/gugatan.pdf'],
            ],
            "Kantor Pajak Pratama (KPP) Kab. Sukoharjo" => [
                ['nama' => 'Aktivasi EFIN Pajak', 'biaya' => 'Gratis', 'syarat' => 'KTP, NPWP', 'layananPdf' => null],
                ['nama' => 'Asistensi Laporan SPT Tahunan', 'biaya' => 'Gratis', 'syarat' => 'Bukti Potong Gaji', 'layananPdf' => null],
            ],
            "Loka POM Surakarta" => [
                ['nama' => 'Sertifikasi Izin Edar P-IRT', 'biaya' => 'Gratis', 'syarat' => 'NIB, Sampel Produk', 'layananPdf' => 'pom/pirt.pdf'],
            ],
            "PT Taspen" => [
                ['nama' => 'Pengajuan Dana Pensiun', 'biaya' => 'Gratis', 'syarat' => 'SK Pensiun, KTP', 'layananPdf' => 'taspen/pensiun.pdf'],
            ],
            "BPJS Kesehatan" => [
                ['nama' => 'Pendaftaran Peserta Baru JKN', 'biaya' => 'Berbiaya', 'syarat' => 'KK, KTP, Rekening Bank', 'layananPdf' => 'bpjs/jkn.pdf'],
                ['nama' => 'Perubahan Data Faskes', 'biaya' => 'Gratis', 'syarat' => 'Kartu BPJS', 'layananPdf' => null],
            ],
            "BPJS Ketenagakerjaan" => [
                ['nama' => 'Klaim Jaminan Hari Tua (JHT)', 'biaya' => 'Gratis', 'syarat' => 'Paklaring, KTP', 'layananPdf' => 'bpjstk/jht.pdf'],
            ],
            "Kantor Pertanahan Kab. Sukoharjo" => [
                ['nama' => 'Pengecekan Sertifikat Tanah', 'biaya' => 'Berbiaya', 'syarat' => 'Sertifikat Asli', 'layananPdf' => 'bpn/cek_sertifikat.pdf'],
                ['nama' => 'Peralihan Hak (Balik Nama)', 'biaya' => 'Berbiaya', 'syarat' => 'Akta Jual Beli', 'layananPdf' => 'bpn/balik_nama.pdf'],
            ],
            "Dinas Kesehatan Kab. Sukoharjo" => [
                ['nama' => 'Penerbitan STR Tenaga Medis', 'biaya' => 'Gratis', 'syarat' => 'Ijazah Terlegalisir', 'layananPdf' => 'dinkes/str.pdf'],
            ],
            "Dinas Perdagangan, Koperasi Usaha Kecil dan Menengah Kab. Sukoharjo" => [
                ['nama' => 'Pelatihan UMKM Naik Kelas', 'biaya' => 'Gratis', 'syarat' => 'KTP Sukoharjo', 'layananPdf' => null],
                ['nama' => 'Tera Ulang Timbangan Pedagang', 'biaya' => 'Berbiaya', 'syarat' => 'Alat Ukur/Timbang', 'layananPdf' => null],
            ],
            "Dinas Pekerjaan Umum dan Penataan Ruang Kab. Sukoharjo" => [
                ['nama' => 'Keterangan Rencana Kabupaten (KRK)', 'biaya' => 'Gratis', 'syarat' => 'Sertifikat Tanah, KTP', 'layananPdf' => 'pupr/krk.pdf'],
            ],
            "Dinas Lingkungan Hidup Kab. Sukoharjo" => [
                ['nama' => 'Rekomendasi Dokumen UKL-UPL', 'biaya' => 'Gratis', 'syarat' => 'Draft Dokumen LH', 'layananPdf' => 'dlh/ukl_upl.pdf'],
            ],
            "Dinas Kependudukan dan Pencatatan Sipil Kab. Sukoharjo" => [
                ['nama' => 'Pencetakan KTP-el Rusak/Hilang', 'biaya' => 'Gratis', 'syarat' => 'Surat Kehilangan/KTP Lama', 'layananPdf' => 'dispenduk/ktp.pdf'],
                ['nama' => 'Aktivasi Identitas Kependudukan Digital', 'biaya' => 'Gratis', 'syarat' => 'Smartphone, KTP', 'layananPdf' => null],
            ],
            "Badan Keuangan Daerah (BKD) Kab. Sukoharjo" => [
                ['nama' => 'Pembayaran PBB-P2', 'biaya' => 'Berbiaya', 'syarat' => 'SPPT PBB', 'layananPdf' => 'bkd/pbb.pdf'],
                ['nama' => 'Pendaftaran Objek Pajak Baru', 'biaya' => 'Gratis', 'syarat' => 'Sertifikat, IMB/PBG', 'layananPdf' => null],
            ],
            "Dinas Sosial Kab. Sukoharjo" => [
                ['nama' => 'Rekomendasi KIS PBI (Gratis)', 'biaya' => 'Gratis', 'syarat' => 'Surat Ket. Tidak Mampu', 'layananPdf' => 'dinsos/kis.pdf'],
            ],
            "Dinas Pendidikan dan Kebudayaan Kab. Sukoharjo" => [
                ['nama' => 'Legalisir Ijazah Sekolah', 'biaya' => 'Gratis', 'syarat' => 'Ijazah Asli', 'layananPdf' => null],
            ],
            "Badan Kesatuan Bangsa dan Politik" => [
                ['nama' => 'Izin Penelitian / Riset', 'biaya' => 'Gratis', 'syarat' => 'Proposal Penelitian', 'layananPdf' => 'kesbangpol/izin_riset.pdf'],
            ],
            "Dinas Kearsipan dan Perpustakaan Kab. Sukoharjo" => [
                ['nama' => 'Pembuatan Kartu Anggota Perpus', 'biaya' => 'Gratis', 'syarat' => 'KTP/Kartu Pelajar', 'layananPdf' => null],
            ],
            "Dinas Perhubungan Kab. Sukoharjo" => [
                ['nama' => 'Uji Berkala Kendaraan (KIR)', 'biaya' => 'Berbiaya', 'syarat' => 'Buku Uji, STNK', 'layananPdf' => 'dishub/kir.pdf'],
            ],
            "Dinas Perindustrian dan Tenaga Kerja Kab. Sukoharjo" => [
                ['nama' => 'Pembuatan Kartu Kuning (AK-1)', 'biaya' => 'Gratis', 'syarat' => 'Ijazah, KTP', 'layananPdf' => 'disperinaker/ak1.pdf'],
            ],
            "Dinas Pengendalian Penduduk Keluarga Berencana dan Pemberdayaan Perempuan dan Perlindungan Anak (DPPKBP3A) Kab. Sukoharjo" => [
                ['nama' => 'Konsultasi KB dan Kesehatan Reproduksi', 'biaya' => 'Gratis', 'syarat' => 'Kartu Keluarga', 'layananPdf' => null],
            ],
            "Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu (DPMPTSP) Kab. Sukoharjo" => [
                ['nama' => 'Izin Reklame Produk', 'biaya' => 'Berbiaya', 'syarat' => 'Desain Reklame, KTP', 'layananPdf' => 'dpmptsp/reklame.pdf'],
                ['nama' => 'Persetujuan Bangunan Gedung (PBG)', 'biaya' => 'Berbiaya', 'syarat' => 'Gambar Teknis, Sertifikat', 'layananPdf' => 'dpmptsp/pbg.pdf'],
            ],
            "Bank Jateng Cabang Sukoharjo" => [
                ['nama' => 'Pembukaan Tabungan Bima', 'biaya' => 'Berbiaya', 'syarat' => 'Setoran Awal, KTP', 'layananPdf' => null],
            ],
            "BRI" => [
                ['nama' => 'Pengajuan KUR Mikro', 'biaya' => 'Berbiaya', 'syarat' => 'KTP, SKU/NIB', 'layananPdf' => 'bri/kur.pdf'],
            ],
            "Bank Sukoharjo" => [
                ['nama' => 'Kredit Multiguna Pegawai', 'biaya' => 'Berbiaya', 'syarat' => 'Slip Gaji, SK Kerja', 'layananPdf' => null],
            ],
            "PDAM Tirta Makmur" => [
                ['nama' => 'Sambungan Air Minum Baru', 'biaya' => 'Berbiaya', 'syarat' => 'Fotokopi KTP, KK', 'layananPdf' => 'pdam/pasang_baru.pdf'],
                ['nama' => 'Pembayaran Tagihan Air', 'biaya' => 'Berbiaya', 'syarat' => 'ID Pelanggan', 'layananPdf' => null],
            ],
            "PT. Pegadaian" => [
                ['nama' => 'Gadai Emas Cepat', 'biaya' => 'Berbiaya', 'syarat' => 'Barang Jaminan, KTP', 'layananPdf' => null],
                ['nama' => 'Tabungan Emas Pegadaian', 'biaya' => 'Berbiaya', 'syarat' => 'KTP', 'layananPdf' => 'pegadaian/emas.pdf'],
            ],
        ];

        // 3. Loop Data untuk Input ke Database
        foreach ($dataLayanan as $namaInstansi => $listLayanan) {
            $instansi = Instansi::where('nama_instansi', $namaInstansi)->first();

            if ($instansi) {
                // Gunakan createMany untuk memasukkan daftar layanan ke instansi terkait
                $instansi->layanan()->createMany($listLayanan);
            }
        }
    }
}