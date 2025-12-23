<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HeroSlide;
use App\Models\WebsiteProfile;
use App\Models\WebsiteFooter;

class WebContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Seed Hero Slides (Carousel)
        $slides = [
            [
                'title' => 'Selamat Datang di MPP Kabupaten Sukoharjo',
                'subtitle' => 'Pusat Pelayanan Terpadu Satu Pintu yang Modern dan Nyaman',
                'image_path' => 'hero/gedung utama.jpg',
                'sort_order' => 1
            ],
            [
                'title' => 'Pojok Baca Digital',
                'subtitle' => 'Tersedia fasilitas literasi digital untuk menunggu dengan bermanfaat',
                'image_path' => 'hero/POJOK BACA.jpg',
                'sort_order' => 2
            ],
            [
                'title' => 'Fasilitas Ramah Anak',
                'subtitle' => 'Area bermain yang aman dan nyaman bagi buah hati Anda',
                'image_path' => 'hero/POJOK BERMAIN.jpg',
                'sort_order' => 3
            ],
        ];

        foreach ($slides as $slide) {
            HeroSlide::updateOrCreate(
                ['title' => $slide['title']], // Unik berdasarkan judul
                $slide
            );
        }

        // 2. Seed Website Profile (3 Gambar & 1 Video)
        WebsiteProfile::updateOrCreate(
            ['id' => 1],
            [
                'title' => 'Apa itu MPP?',
                'description' => 'Mal Pelayanan Publik (MPP) Kabupaten Sukoharjo adalah pengintegrasian berbagai layanan publik dari Pemerintah Pusat, Daerah, hingga BUMN/BUMD dalam satu tempat untuk meningkatkan kecepatan, kemudahan, jangkauan, keamanan, dan kenyamanan masyarakat.',
                'vision' => 'Mewujudkan pelayanan publik yang prima, akuntabel, dan berbasis teknologi informasi.',
                'mission' => "1. Meningkatkan kualitas sarana dan prasarana layanan.\n2. Mengintegrasikan berbagai jenis layanan dalam satu lokasi.\n3. Memberikan pelayanan yang cepat, tepat, dan transparan.",
                
                // Path gambar sesuai struktur folder storage/app/public/profil/
                'image_path_1' => 'profil/HAL UTAMA.jpg',
                'image_path_2' => 'profil/LAYANAN.jpg',
                'image_path_3' => 'profil/PRODUK BATIK.jpg',
                
                // Path video
                'video_path' => 'profil/contoh.mp4'
            ]
        );

        // 3. Seed Website Footer (Kontak, Sosmed, Lokasi & Jam Kerja)
        WebsiteFooter::updateOrCreate(
            ['id' => 1],
            [
                'address' => 'Jl. Abu Tholib Sastrotenoyo No. 378, Kelurahan Jombor, Kecamatan Bendosari, Sukoharjo, Jawa Tengah 57521',
                'phone' => '(0271) 593068',
                'whatsapp' => '6281234567890', // Format angka saja untuk link WA otomatis
                'email' => 'mpp@sukoharjokab.go.id',
                'location_url' => 'https://maps.app.goo.gl/3Q8mXJqY5zR2', // Contoh link Maps asli
                
                // Link Media Sosial
                'facebook' => 'https://facebook.com/mppsukoharjo',
                'instagram' => 'https://instagram.com/mppsukoharjo',
                'youtube' => 'https://youtube.com/@mppsukoharjo',
                'twitter' => 'https://twitter.com/mppsukoharjo',
                
                // Jam Operasional (Format HH:mm)
                'open_weekdays' => '08:00',
                'close_weekdays' => '15:30',
                'open_friday' => '08:00',
                'close_friday' => '11:30',
                'weekend_notes' => 'Sabtu - Minggu: Tutup'
            ]
        );

        $this->command->info('WebContentSeeder: Berhasil diperbarui!');
    }
}