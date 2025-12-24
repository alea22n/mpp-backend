<?php

use App\Http\Controllers\User\UserBerandaController;
use App\Http\Controllers\User\UserInstansiController;
use App\Http\Controllers\User\UserPanduanController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\User\UserSkmController;
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
Route::get('/', [UserBerandaController::class, 'index']);

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
Route::resource('instansi', UserInstansiController::class)->only(['index','show']);
Route::get('panduan', [UserPanduanController::class, 'index']);
Route::get('profile', [UserProfileController::class, 'index']);
Route::get('skm', [UserSkmController::class, 'index']);