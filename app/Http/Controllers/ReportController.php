<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Menampilkan halaman laporan statistik rekap instansi.
     */
    public function index(Request $request)
    {
        // 1. Ambil Parameter Filter
        $dateFrom = $request->input('date_from', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $dateTo = $request->input('date_to', Carbon::now()->endOfMonth()->format('Y-m-d'));
        
        // Variabel ini harus tetap didefinisikan dan dilewatkan.
        $serviceType = $request->input('service_type', 'all'); 

        // 2. Query Data dari tabel rekap_instansi (dengan Pagination)
        $reports = DB::table('rekap_instansi')
            ->whereBetween('update_terakhir', [$dateFrom, $dateTo])
            ->orderBy('total_permohonan', 'desc')
            // PERUBAHAN UTAMA: Mengganti ->get() menjadi ->paginate(10)
            ->paginate(10); 

        // 3. Hitung Statistik untuk KPI Cards (Agregasi Data)
        // Kita gunakan query terpisah untuk menghitung total keseluruhan (non-paginated)
        $aggregatedData = DB::table('rekap_instansi')
            ->whereBetween('update_terakhir', [$dateFrom, $dateTo])
            ->selectRaw('COUNT(*) as total_instansi, 
                         SUM(jumlah_layanan) as total_layanan, 
                         SUM(total_permohonan) as total_permohonan, 
                         SUM(pengguna_aktif) as total_pengguna')
            ->first();

        // **Catatan Penting**: Karena Blade Anda sebelumnya mengharapkan key seperti 
        // 'total_selesai', 'avg_time', dll., saya akan memetakan ini ke data rekap yang benar, 
        // tetapi Anda harus menyesuaikan Blade Anda di masa mendatang agar lebih konsisten
        // dengan data rekap instansi ini.
        $stats = [
            'total_instansi'   => $aggregatedData->total_instansi ?? 0,
            'total_layanan'    => $aggregatedData->total_layanan ?? 0,
            'total_permohonan' => $aggregatedData->total_permohonan ?? 0,
            'pengguna_aktif'   => $aggregatedData->total_pengguna ?? 0, // Menggunakan key lama (pengguna_aktif)
        ];

        // 4. Kirim ke View dengan data yang sudah difilter
        return view('admin.laporan-statistik', compact(
            'reports', 
            'stats', 
            'dateFrom', 
            'dateTo',
            'serviceType' 
        ));
    }

    /**
     * API untuk data grafik batang per instansi
     */
    public function getChartData(Request $request)
    {
        $dateFrom = $request->input('date_from', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $dateTo = $request->input('date_to', Carbon::now()->endOfMonth()->format('Y-m-d'));

        $data = DB::table('rekap_instansi')
            ->select('nama_instansi as label', 'total_permohonan as value')
            ->whereBetween('update_terakhir', [$dateFrom, $dateTo])
            // Tetap menggunakan get() di sini karena ini adalah data API untuk chart, 
            // yang seringkali membutuhkan semua data terfilter.
            ->get(); 

        return response()->json($data);
    }
}