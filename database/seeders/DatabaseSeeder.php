<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Panggil InstansiSeeder PERTAMA KALI
        $this->call([
            InstansiSeeder::class,       // Harus nomor 1 agar ID Instansi tersedia
        ]);

        // 2. Buat Super Admin
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

        // 3. Panggil Seeder sisanya
        $this->call([
            UserSeeder::class,           // Sekarang Instansi sudah ada isinya, loop akan jalan
            LayananSeeder::class,
            RekapInstansiSeeder::class,
            WebContentSeeder::class,
        ]);
    }
}