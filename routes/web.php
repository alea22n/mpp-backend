<?php

use App\Http\Controllers\ViewController;
use Illuminate\Support\Facades\Route;

// Import Controller
use App\Http\Controllers\{
    AuthController,
    DashboardController,
    InstansiController,
    UserController,
    ReportController,
    ComplaintController,
    WebcontentController,
    ActivityController,
    SettingController,
    NotificationController,
    ProfileController
};

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});


// Auth Routes
Route::get('/log-in', [AuthController::class, 'showLogin'])->name('login');
Route::post('/log-in', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Area (Protected)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Laporan & Statistik
    Route::prefix('laporan-statistik')->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('laporan-statistik');
        Route::get('/export/excel', [ReportController::class, 'exportExcel'])->name('laporan.export.excel');
        Route::get('/export/pdf', [ReportController::class, 'exportPdf'])->name('laporan.export.pdf');
    });

    // Data Pengguna
    Route::prefix('data-pengguna')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('data-pengguna');
        Route::post('/store', [UserController::class, 'store'])->name('users.store');
    });

    // Kelola Instansi
    Route::prefix('kelola-instansi')->group(function () {
        Route::get('/', [InstansiController::class, 'index'])->name('kelola-instansi');
        Route::get('/detail/{slug}', [InstansiController::class, 'show'])->name('detail-instansi');
        Route::post('/update/{slug}', [InstansiController::class, 'update'])->name('instansi.update');
        Route::post('/layanan/{slug}/sync', [InstansiController::class, 'syncLayanan'])->name('layanan.sync');
    });

    // Pengaduan & Masukan
    Route::prefix('pengaduan-masukan')->group(function () {
        Route::get('/', [ComplaintController::class, 'index'])->name('pengaduan-masukan');
        Route::delete('/{id}', [ComplaintController::class, 'destroy'])->name('complaint.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | KELOLA KONTEN WEBSITE (FIXED NAMES)
    |--------------------------------------------------------------------------
    */
    Route::prefix('kelola-konten-website')->group(function () {
        // Halaman Utama Kelola Konten
        Route::get('/', [WebcontentController::class, 'index'])->name('kelola-konten-website');
        
        // Simpan Hero Carousel (Disesuaikan dengan route('admin.hero.save') di Blade)
        Route::post('/hero', [WebcontentController::class, 'saveHero'])->name('admin.hero.save');
        
        // Simpan Profil MPP (Disesuaikan dengan route('admin.profil.save') di Blade)
        Route::post('/profil', [WebcontentController::class, 'saveProfil'])->name('admin.profil.save');
        
        // Simpan Footer & Kontak (Disesuaikan dengan route('admin.footer.save') di Blade)
        Route::post('/footer', [WebcontentController::class, 'saveFooter'])->name('admin.footer.save');
    });

    // Aktivitas Sistem
    Route::prefix('aktivitas-sistem')->group(function () {
        Route::get('/', [ActivityController::class, 'index'])->name('aktivitas-sistem');
        Route::get('/export', [ActivityController::class, 'export'])->name('aktivitas.export');
    });

    // Pengaturan Sistem
    Route::prefix('pengaturan-sistem')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('pengaturan-sistem');
        Route::post('/update', [SettingController::class, 'update'])->name('settings.update');
        Route::post('/backup', [SettingController::class, 'backup'])->name('settings.backup');
        Route::post('/reset', [SettingController::class, 'reset'])->name('settings.reset');
    });

    // Notifikasi
    Route::get('/notifikasi', [NotificationController::class, 'index'])->name('notifikasi');

    // Profile User
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

Route::get('bank-bri', [ViewController::class, 'bankBri']);
Route::get('bank-jateng', [ViewController::class, 'bankJateng']);
Route::get('bkd-sukoharjo', [ViewController::class, 'BkdSukoharjo']);
Route::get('bpjs-kesehatan', [ViewController::class, 'BpjsKesehatan']);
Route::get('bpjs-ketenagakerjaan', [ViewController::class, 'BpjsKetenagakerjaan']);
Route::get('dinas-pendidikan', [ViewController::class, 'DinasPendidikan']);
Route::get('dinkes-sukoharjo', [ViewController::class, 'DinkesSukoharjo']);
Route::get('dinsos', [ViewController::class, 'Dinsos']);
Route::get('disdukcapil', [ViewController::class, 'Disdukcapil']);
Route::get('dishub', [ViewController::class, 'Dishub']);
Route::get('diskopumdag', [ViewController::class, 'Diskopumdag']);
Route::get('dispernaker', [ViewController::class, 'Dispernaker']);
Route::get('dispusip', [ViewController::class, 'Dispusip']);
Route::get('dlh', [ViewController::class, 'Dlh']);
Route::get('dpmptsp-jateng', [ViewController::class, 'DpmptspJateng']);
Route::get('dpmptsp-sukoharjo', [ViewController::class, 'DpmptspSukoharjo']);
Route::get('dppkbp3a', [ViewController::class, 'Dppkbp3a']);
Route::get('dpupr', [ViewController::class, 'Dpupr']);
Route::get('kantor-pertahanan', [ViewController::class, 'KantorPertahanan']);
Route::get('kejaksaan-sukoharjo', [ViewController::class, 'KejaksaanSukoharjo']);
Route::get('kementerian-agama', [ViewController::class, 'KementerianAgama']);
Route::get('kesbangpol', [ViewController::class, 'Kesbangpol']);
Route::get('kpp-sukoharjo', [ViewController::class, 'KppSukoharjo']);
Route::get('loka-pom-surakarta', [ViewController::class, 'LokaPomSurakarta']);
Route::get('pdam-tirta', [ViewController::class, 'PdamTirta']);
Route::get('pengadilan-agama', [ViewController::class, 'PengadilanAgama']);
Route::get('pengadilan-negeri-kelas-IA', [ViewController::class, 'PengadilanNegeriKelasIa']);
Route::get('polres-sukoharjo', [ViewController::class, 'PolresSukoharjo']);
Route::get('pt-penggadaian', [ViewController::class, 'PtPenggadaian']);
Route::get('taspen', [ViewController::class, 'Taspen']);
Route::get('uppd-sukoharjo', [ViewController::class, 'UppdSukoharjo']);
Route::get('upt-bp2mi', [ViewController::class, 'UptBp2mi']);
Route::get('beranda', [ViewController::class, 'Beranda']);
Route::get('instansi', [ViewController::class, 'Instansi']);
Route::get('panduan', [ViewController::class, 'Panduan']);
Route::get('profile', [ViewController::class, 'Profile']);
Route::get('skm', [ViewController::class, 'Skm']);