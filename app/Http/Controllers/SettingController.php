<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Setting; // Pastikan Anda membuat model Setting atau menggunakan opsi lain
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    /**
     * Menampilkan halaman pengaturan sistem.
     */
    public function index()
    {
        // Biasanya pengaturan disimpan dalam tabel 'settings' dengan kolom 'key' dan 'value'
        // Untuk simulasi, kita lewatkan data statis atau ambil dari User yang sedang login
        $user = Auth::user();
        
        // Pastikan nama file di dalam folder admin adalah pengaturan-sistem.blade.php
        return view('admin.pengaturan-sistem', compact('user'));
    }

    /**
     * Menyimpan perubahan pengaturan sistem dan profil admin.
     */
    public function update(Request $request)
    {
        $request->validate([
            'system_name'   => 'required|string|max:255',
            'sender_email'  => 'required|email',
            'admin_name'    => 'required|string|max:255',
            'admin_email'   => 'required|email',
            'password'      => 'nullable|min:8|confirmed',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 1. Logika Update Pengaturan Umum (Simulasi menggunakan database settings)
        // Setting::updateOrCreate(['key' => 'system_name'], ['value' => $request->system_name]);
        // Setting::updateOrCreate(['key' => 'maintenance_mode'], ['value' => $request->has('maintenance_mode')]);

        // 2. Logika Update Data Admin (User Login)
        $user = Auth::user();
        $user->name = $request->admin_name;
        $user->email = $request->admin_email;

        // Update Password jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // 3. Logika Upload Foto Profil - Logika yang sudah diperbaiki
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');

            // Hapus foto lama jika ada
            if ($user->profile_photo_path && Storage::disk('public')->exists($user->profile_photo_path)) {
                // Gunakan disk 'public' untuk memastikan file lama dihapus dari lokasi penyimpanan yang benar
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            // Beri nama unik agar tidak bentrok: time_userid.ext
            $fileName = time() . '_' . $user->id . '.' . $file->getClientOriginalExtension();

            // Simpan foto baru ke folder 'profile-photos' di dalam disk 'public'
            $path = $file->storeAs('profile-photos', $fileName, 'public');

            // Update path di objek user. (hasilnya: profile-photos/namafile.jpg)
            $user->profile_photo_path = $path;
        }

        // Simpan semua perubahan (Nama, Email, Password, dan Profile Photo Path)
        $user->save();

        return redirect()->back()->with('success', 'Pengaturan berhasil diperbarui!');
    }

    /**
     * Fungsi Simulasi Backup Data.
     */
    public function backup()
    {
        // Di sini biasanya diletakkan perintah spatie/laravel-backup atau dump SQL
        // return Storage::download('backups/latest.zip');
        
        return response()->json(['message' => 'Backup berhasil dibuat.']);
    }

    /**
     * Fungsi Simulasi Reset Sistem.
     */
    public function reset(Request $request)
    {
        // Logika untuk membersihkan tabel tertentu atau mengembalikan ke seed default
        // Artisan::call('migrate:fresh --seed');
        
        return redirect()->back()->with('success', 'Sistem berhasil direset ke kondisi awal.');
    }
}