<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Jika nantinya menggunakan database
use Carbon\Carbon;

class ActivityController extends Controller
{
    /**
     * Menampilkan halaman log aktivitas sistem.
     */
    public function index(Request $request)
    {
        // 1. DATA STATISTIK (DUMMY)
        // Di aplikasi nyata, Anda bisa menggunakan: ActivityLog::whereDate('created_at', Carbon::today())->count();
        $stats = [
            'today_count' => 128,
            'weekly_count' => 865,
            'weekly_growth' => '+12%',
            'active_users' => 46,
            'total_logs' => '15.4K'
        ];

        // 2. DATA UNTUK GRAFIK (7 Hari Terakhir)
        $chartData = [
            'labels' => ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
            'values' => [65, 80, 120, 100, 150, 90, 70]
        ];

        // 3. DATA LOG AKTIVITAS (Array untuk simulasi)
        // Jika pakai DB: $activities = Activity::query()->orderBy('created_at', 'desc');
        $activities = [
            [
                'time' => '2025-12-17 12:45:00',
                'user' => 'Admin Utama',
                'role' => 'Super Admin',
                'activity' => 'Tindak Lanjut',
                'description' => 'Pengaduan ID: PDN2025001 telah ditindak lanjuti',
                'status' => 'Berhasil'
            ],
            [
                'time' => '2025-12-17 11:15:00',
                'user' => 'Sistem',
                'role' => 'Sistem',
                'activity' => 'Pembaruan',
                'description' => 'Sistem berhasil diperbarui ke versi 3.1.0',
                'status' => 'Berhasil'
            ],
            [
                'time' => '2025-12-17 09:25:00',
                'user' => 'Admin Utama',
                'role' => 'Super Admin',
                'activity' => 'Hapus',
                'description' => 'Percobaan menghapus data pengguna (Otorisasi Gagal)',
                'status' => 'Dibatalkan'
            ],
            [
                'time' => '2025-12-16 14:00:00',
                'user' => 'Admin Perpustakaan',
                'role' => 'Admin Instansi',
                'activity' => 'Unggah',
                'description' => 'Mengunggah file "Brosur Layanan Terbaru.pdf"',
                'status' => 'Berhasil'
            ],
            // Tambahkan data lainnya sesuai kebutuhan...
        ];

        // Konversi ke format Carbon untuk manipulasi waktu di Blade jika perlu
        foreach ($activities as &$act) {
            $act['formatted_time'] = Carbon::parse($act['time'])->format('d/m/Y, H:i');
        }

        return view('admin.aktivitas-sistem', compact('stats', 'chartData', 'activities'));
    }

    /**
     * Fitur Export Data (Opsional)
     */
    public function export(Request $request)
    {
        $type = $request->input('type', 'excel');
        
        // Logika untuk export menggunakan library seperti Maatwebsite/Laravel-Excel atau DomPDF
        // return Excel::download(new ActivityExport, "activity-log.{$type}");

        return back()->with('success', "Data berhasil diekspor ke format {$type}");
    }
}