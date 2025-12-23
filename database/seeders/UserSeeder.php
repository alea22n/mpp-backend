<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Instansi;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. BUAT SUPER ADMIN (Gunakan updateOrCreate agar data bisa diperbarui)
        User::updateOrCreate(
            ['email' => 'admin@mpp.go.id'],
            [
                'name' => 'Super Admin MPP',
                'password' => Hash::make('password123'),
                'role' => 'Super Admin',
                'status' => 'Aktif',
                'instansi_id' => null,
            ]
        );

        // 2. BUAT ADMIN UNTUK SETIAP INSTANSI
        // Mengambil semua instansi yang sudah masuk ke database dari InstansiSeeder
        $instansis = Instansi::all();

        if ($instansis->isEmpty()) {
            $this->command->warn("Tidak ada data instansi ditemukan. Pastikan InstansiSeeder dijalankan sebelum UserSeeder.");
            return;
        }

        foreach ($instansis as $instansi) {
            // Membuat email unik berdasarkan nama instansi
            $slug = Str::slug($instansi->nama_instansi);
            $emailPrefix = Str::limit($slug, 15, '');
            $email = str_replace('-', '.', $emailPrefix) . '@mpp.go.id';
            
            User::updateOrCreate(
                ['email' => $email],
                [
                    'name' => 'Admin ' . $instansi->nama_instansi,
                    'password' => Hash::make('password123'),
                    'role' => 'Admin Instansi',
                    'status' => 'Aktif', 
                    'instansi_id' => $instansi->id,
                ]
            );
        }

        $this->command->info("UserSeeder: Berhasil membuat Super Admin dan " . $instansis->count() . " Admin Instansi.");
    }
}