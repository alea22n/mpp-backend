<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Instansi;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

class InstansiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Matikan proteksi foreign key agar bisa menghapus data yang berelasi
        Schema::disableForeignKeyConstraints();
        
        // 2. Kosongkan tabel agar data lama tidak menumpuk (reset ke 0)
        Instansi::truncate();
        
        // 3. Hidupkan kembali proteksi foreign key
        Schema::enableForeignKeyConstraints();

        // 4. Data instansi (Total 33 data)
        $instansis = [
            [
                'nama_instansi' => 'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu (DPMPTSP) Prov. Jawa Tengah',
                'subtitle' => 'DPMPTSP JAWA TENGAH',
                'alamat' => 'Jl. Menteri Supeno No. 6, Kota Semarang',
                'kontak' => '(024) 831-3456',
                'website' => 'https://dpmptsp.jatengprov.go.id',
                'logo_url' => 'instansi/DPMPTSP JATENG.png',
            ],
            [
                'nama_instansi' => 'Unit Pelaksana Teknis Badan Pelindungan Pekerja Migran Indonesia (UPT BP2MI) Kota Semarang',
                'subtitle' => 'UPT B2MI KOTA SEMARANG',
                'alamat' => 'Jl. Pamularsih Raya No. 10, Kota Semarang',
                'kontak' => '(024) 760-1122',
                'website' => 'https://bp2mi.go.id',
                'logo_url' => 'instansi/BP2MI.png',
            ],
            [
                'nama_instansi' => 'Unit Pengelolaan Pendapatan Daerah (UPPD) Kab. Sukoharjo',
                'subtitle' => 'UPPD SUKOHARJO',
                'alamat' => 'Jl. Jenderal Sudirman No. 199, Sukoharjo',
                'kontak' => '(0271) 593-456',
                'website' => 'https://bapenda.jatengprov.go.id',
                'logo_url' => 'instansi/UPPD.png',
            ],
            [
                'nama_instansi' => 'Polres Sukoharjo',
                'subtitle' => 'POLRES SUKOHARJO',
                'alamat' => 'Jl. Ir. Soekarno No. 5, Sukoharjo',
                'kontak' => '(0271) 593-110',
                'website' => 'https://polressukoharjo.polri.go.id',
                'logo_url' => 'instansi/polres.jpg',
            ],
            [
                'nama_instansi' => 'Kejaksaan Negeri Sukoharjo',
                'subtitle' => 'KEJAKSAAN SUKOHARJO',
                'alamat' => 'Jl. Jaksa Agung R. Suprapto No. 1, Sukoharjo',
                'kontak' => '(0271) 593-221',
                'website' => 'https://kejari-sukoharjo.kejaksaan.go.id',
                'logo_url' => 'instansi/KEJAKSAAN.png',
            ],
            [
                'nama_instansi' => 'Kementerian Agama Kab. Sukoharjo',
                'subtitle' => 'KEMENTERIAN AGAMA SUKOHARJO',
                'alamat' => 'Jl. Veteran No. 8, Sukoharjo',
                'kontak' => '(0271) 593-889',
                'website' => 'https://sukoharjo.kemenag.go.id',
                'logo_url' => 'instansi/KEMENTERIAN AGAMA.png',
            ],
            [
                'nama_instansi' => 'Pengadilan Negeri Sukoharjo Kelas IA',
                'subtitle' => 'PENGADILAN NEGERI SUKOHARJO KELAS IA',
                'alamat' => 'Jl. Jaksa Agung R. Suprapto No. 10, Sukoharjo',
                'kontak' => '(0271) 593-333',
                'website' => 'https://pn-sukoharjo.go.id',
                'logo_url' => 'instansi/PENGADILAN NEGERI.png',
            ],
            [
                'nama_instansi' => 'Pengadilan Agama Kab. Sukoharjo',
                'subtitle' => 'PENGADILAN AGAMA SUKOHARJO',
                'alamat' => 'Jl. Ir. Soekarno No. 12, Sukoharjo',
                'kontak' => '(0271) 593-444',
                'website' => 'https://pa-sukoharjo.go.id',
                'logo_url' => 'instansi/PENGADILAN AGAMA.png',
            ],
            [
                'nama_instansi' => 'Kantor Pajak Pratama (KPP) Kab. Sukoharjo',
                'subtitle' => 'KPP SUKOHARJO',
                'alamat' => 'Jl. Slamet Riyadi No. 150, Sukoharjo',
                'kontak' => '(0271) 593-567',
                'website' => 'https://www.pajak.go.id',
                'logo_url' => 'instansi/KPP.png',
            ],
            [
                'nama_instansi' => 'Loka POM Surakarta',
                'subtitle' => 'LOKA POM SURAKARTA',
                'alamat' => 'Jl. Letjen Sutoyo No. 6, Surakarta',
                'kontak' => '(0271) 714-678',
                'website' => 'https://www.pom.go.id',
                'logo_url' => 'instansi/LOKA POM.png',
            ],
            [
                'nama_instansi' => 'PT Taspen',
                'subtitle' => 'PT. TASPEN',
                'alamat' => 'Jl. Slamet Riyadi No. 120, Surakarta',
                'kontak' => '(0271) 714-789',
                'website' => 'https://www.taspen.co.id',
                'logo_url' => 'instansi/TASPEN.png',
            ],
            [
                'nama_instansi' => 'BPJS Kesehatan',
                'subtitle' => 'BPJS KESEHATAN',
                'alamat' => 'Jl. Slamet Riyadi No. 210, Sukoharjo',
                'kontak' => '(0271) 593-678',
                'website' => 'https://www.bpjs-kesehatan.go.id',
                'logo_url' => 'instansi/BPJS KESEHATAN.png',
            ],
            [
                'nama_instansi' => 'BPJS Ketenagakerjaan',
                'subtitle' => 'BPJS KETENAGAKERJAAN',
                'alamat' => 'Jl. Slamet Riyadi No. 215, Sukoharjo',
                'kontak' => '(0271) 593-679',
                'website' => 'https://www.bpjsketenagakerjaan.go.id',
                'logo_url' => 'instansi/BPJS KETENAGAKERJAAN.png',
            ],
            [
                'nama_instansi' => 'Kantor Pertanahan Kab. Sukoharjo',
                'subtitle' => 'KANTOR PERTAHANAN SUKOHARJO',
                'alamat' => 'Jl. Ir. Soekarno No. 25, Sukoharjo',
                'kontak' => '(0271) 593-700',
                'website' => 'https://www.atrbpn.go.id',
                'logo_url' => 'instansi/KANTOR PERTAHANAN.png',
            ],
            [
                'nama_instansi' => 'Dinas Kesehatan Kab. Sukoharjo',
                'subtitle' => 'DINKES SUKOHARJO',
                'alamat' => 'Jl. Raya Solo–Sukoharjo KM 5, Sukoharjo',
                'kontak' => '(0271) 593-555',
                'website' => 'https://dinkes.sukoharjokab.go.id',
                'logo_url' => 'instansi/DINAS KESEHATAN.png',
            ],
            [
                'nama_instansi' => 'Dinas Perdagangan, Koperasi Usaha Kecil dan Menengah Kab. Sukoharjo',
                'subtitle' => 'DISKOPUMDAG SUKOHARJO',
                'alamat' => 'Jl. Veteran No. 15, Sukoharjo',
                'kontak' => '(0271) 593-601',
                'website' => 'https://disdagkopukm.sukoharjokab.go.id',
                'logo_url' => 'instansi/DINAS PERDAGANGAN.png',
            ],
            [
                'nama_instansi' => 'Dinas Pekerjaan Umum dan Penataan Ruang Kab. Sukoharjo',
                'subtitle' => 'DPUPR SUKOHARJO',
                'alamat' => 'Jl. Ir. Soekarno No. 18, Sukoharjo',
                'kontak' => '(0271) 593-610',
                'website' => 'https://pupr.sukoharjokab.go.id',
                'logo_url' => 'instansi/DINAS PEKERJAAN UMUM.png',
            ],
            [
                'nama_instansi' => 'Dinas Lingkungan Hidup Kab. Sukoharjo',
                'subtitle' => 'DLH SUKOHARJO',
                'alamat' => 'Jl. Jenderal Sudirman No. 22, Sukoharjo',
                'kontak' => '(0271) 593-620',
                'website' => 'https://dlh.sukoharjokab.go.id',
                'logo_url' => 'instansi/DINAS LINGKUNGAN HIDUP.png',
            ],
            [
                'nama_instansi' => 'Dinas Kependudukan dan Pencatatan Sipil Kab. Sukoharjo',
                'subtitle' => 'DISDUKCAPIL SUKOHARJO',
                'alamat' => 'Jl. Raya Sukoharjo–Solo KM 5, Sukoharjo',
                'kontak' => '(0271) 555-789',
                'website' => 'https://dukcapil.sukoharjokab.go.id',
                'logo_url' => 'instansi/DUKCAPIL.png',
            ],
            [
                'nama_instansi' => 'Badan Keuangan Daerah (BKD) Kab. Sukoharjo',
                'subtitle' => 'BKD SUKOHARJO',
                'alamat' => 'Jl. Jenderal Sudirman No. 30, Sukoharjo',
                'kontak' => '(0271) 593-630',
                'website' => 'https://bkd.sukoharjokab.go.id',
                'logo_url' => 'instansi/BKD.png',
            ],
            [
                'nama_instansi' => 'Dinas Sosial Kab. Sukoharjo',
                'subtitle' => 'DINSOS SUKOHARJO',
                'alamat' => 'Jl. Veteran No. 20, Sukoharjo',
                'kontak' => '(0271) 593-640',
                'website' => 'https://dinsos.sukoharjokab.go.id',
                'logo_url' => 'instansi/DINSOS.png',
            ],
            [
                'nama_instansi' => 'Dinas Pendidikan dan Kebudayaan Kab. Sukoharjo',
                'subtitle' => 'DISDIK SUKOHARJO',
                'alamat' => 'Jl. Ir. Soekarno No. 35, Sukoharjo',
                'kontak' => '(0271) 593-650',
                'website' => 'https://disdikbud.sukoharjokab.go.id',
                'logo_url' => 'instansi/DINAS PENDIDIKAN.png',
            ],
            [
                'nama_instansi' => 'Badan Kesatuan Bangsa dan Politik',
                'subtitle' => 'KESBANGPOL',
                'alamat' => 'Jl. Jenderal Sudirman No. 40, Sukoharjo',
                'kontak' => '(0271) 593-660',
                'website' => 'https://kesbangpol.sukoharjokab.go.id',
                'logo_url' => 'instansi/BADAN KESATUAN BANGSA DAN POLITIK.png',
            ],
            [
                'nama_instansi' => 'Dinas Kearsipan dan Perpustakaan Kab. Sukoharjo',
                'subtitle' => 'DISPUSIP SUKOHARJO',
                'alamat' => 'Jl. Slamet Riyadi No. 300, Sukoharjo',
                'kontak' => '(0271) 593-670',
                'website' => 'https://dispussip.sukoharjokab.go.id',
                'logo_url' => 'instansi/DISPUSIP.png',
            ],
            [
                'nama_instansi' => 'Dinas Perhubungan Kab. Sukoharjo',
                'subtitle' => 'DISHUB SUKOHARJO',
                'alamat' => 'Jl. Ir. Soekarno No. 45, Sukoharjo',
                'kontak' => '(0271) 593-680',
                'website' => 'https://dishub.sukoharjokab.go.id',
                'logo_url' => 'instansi/DISHUB.png',
            ],
            [
                'nama_instansi' => 'Dinas Perindustrian dan Tenaga Kerja Kab. Sukoharjo',
                'subtitle' => 'DISPERMAKER SUKOHARJO',
                'alamat' => 'Jl. Veteran No. 25, Sukoharjo',
                'kontak' => '(0271) 593-690',
                'website' => 'https://disperinaker.sukoharjokab.go.id',
                'logo_url' => 'instansi/DISPERMAKER.png',
            ],
            [
                'nama_instansi' => 'Dinas Pengendalian Penduduk Keluarga Berencana dan Pemberdayaan Perempuan dan Perlindungan Anak (DPPKBP3A) Kab. Sukoharjo',
                'subtitle' => 'DPPKBP3A SUKOHARJO',
                'alamat' => 'Jl. Jenderal Sudirman No. 50, Sukoharjo',
                'kontak' => '(0271) 593-701',
                'website' => 'https://dppkbp3a.sukoharjokab.go.id',
                'logo_url' => 'instansi/DPPKBP3A.png',
            ],
            [
                'nama_instansi' => 'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu (DPMPTSP) Kab. Sukoharjo',
                'subtitle' => 'DPMPTSP SUKOHARJO',
                'alamat' => 'Jl. Raya Sukoharjo–Solo KM 6, Sukoharjo',
                'kontak' => '(0271) 593-710',
                'website' => 'https://dpmptsp.sukoharjokab.go.id',
                'logo_url' => 'instansi/DPMPTSP SUKOHARJO.png',
            ],
            [
                'nama_instansi' => 'Bank Jateng Cabang Sukoharjo',
                'subtitle' => 'BANK JATENG',
                'alamat' => 'Jl. Slamet Riyadi No. 88, Sukoharjo',
                'kontak' => '(0271) 593-720',
                'website' => 'https://www.bankjateng.co.id',
                'logo_url' => 'instansi/BANK JATENG.png',
            ],
            [
                'nama_instansi' => 'BRI',
                'subtitle' => 'BANK BRI',
                'alamat' => 'Jl. Slamet Riyadi No. 90, Sukoharjo',
                'kontak' => '(0271) 593-730',
                'website' => 'https://bri.co.id',
                'logo_url' => 'instansi/BRI.png',
            ],
            [
                'nama_instansi' => 'Bank Sukoharjo',
                'subtitle' => 'BANK SUKOHARJO',
                'alamat' => 'Jl. Jenderal Sudirman No. 60, Sukoharjo',
                'kontak' => '(0271) 593-740',
                'website' => 'https://www.banksukoharjo.co.id',
                'logo_url' => 'instansi/BANK SUKOHARJO.png',
            ],
            [
                'nama_instansi' => 'PDAM Tirta Makmur',
                'subtitle' => 'PDAM TIRTA MAKMUR',
                'alamat' => 'Jl. Ir. Soekarno No. 55, Sukoharjo',
                'kontak' => '(0271) 593-750',
                'website' => 'https://pdam.sukoharjokab.go.id',
                'logo_url' => 'instansi/TIRTA.png',
            ],
            [
                'nama_instansi' => 'PT. Pegadaian',
                'subtitle' => 'PT. PEGADAIAN',
                'alamat' => 'Jl. Slamet Riyadi No. 95, Sukoharjo',
                'kontak' => '(0271) 593-760',
                'website' => 'https://www.pegadaian.co.id',
                'logo_url' => 'instansi/PEGADAIAN.png',
            ],
        ];

        // 5. Loop untuk insert data
        foreach ($instansis as $instansiData) {
            Instansi::create([
                'nama_instansi' => $instansiData['nama_instansi'],
                'subtitle' => $instansiData['subtitle'],
                'alamat' => $instansiData['alamat'],
                'kontak' => $instansiData['kontak'],
                'website' => $instansiData['website'],
                'logo_url' => $instansiData['logo_url'],
                // Membuat slug otomatis dari nama instansi
                'slug' => Str::slug($instansiData['nama_instansi']),
            ]);
        }
    }
}