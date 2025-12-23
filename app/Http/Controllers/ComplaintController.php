<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index()
    {
        // 1. Data Dummy Pengaduan (Array)
        $pengaduans = [
            [
                'id' => 1, 
                'nama' => "Budi Santoso", 
                'instansi' => "Polres Sukoharjo", 
                'isi' => "Petugas layanan SIM di loket MPP kurang responsif.", 
                'status' => "Pending", 
                'tanggal' => "2025-11-10"
            ],
            [
                'id' => 2, 
                'nama' => "Ani Wijaya", 
                'instansi' => "DPMPTSP", 
                'isi' => "Sistem antrean online sering down.", 
                'status' => "Diproses", 
                'tanggal' => "2025-11-09"
            ],
        ];

        // 2. Data Dummy Instansi (PENTING: Agar tidak undefined variable)
        $instansiList = [
            (object)['id' => 1, 'nama_instansi' => 'Polres Sukoharjo'],
            (object)['id' => 2, 'nama_instansi' => 'DPMPTSP'],
            (object)['id' => 3, 'nama_instansi' => 'Dinas Kesehatan'],
            (object)['id' => 4, 'nama_instansi' => 'Disdukcapil'],
        ];

        // 3. Hitung statistik
        $totalPengaduan = count($pengaduans);
        $totalPending = count(array_filter($pengaduans, fn($p) => $p['status'] == 'Pending'));
        $totalDiproses = count(array_filter($pengaduans, fn($p) => $p['status'] == 'Diproses'));
        $totalSelesai = count(array_filter($pengaduans, fn($p) => $p['status'] == 'Selesai'));

        // 4. Kirim SEMUA variabel ke view
        return view('admin.pengaduan-masukan', [
            'pengaduanList' => $pengaduans,
            'instansiList'  => $instansiList, // Tambahkan ini
            'totalPengaduan' => $totalPengaduan,
            'totalPending'   => $totalPending,
            'totalDiproses'  => $totalDiproses,
            'totalSelesai'   => $totalSelesai,
        ]);
    }
}