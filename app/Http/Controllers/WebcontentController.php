<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HeroSlide;
use App\Models\WebsiteProfile;
use App\Models\WebsiteFooter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class WebcontentController extends Controller
{
    /**
     * Menampilkan halaman kelola konten.
     */
    public function index()
    {
        // 1. Ambil Hero Slides (Gunakan Accessor image_url dari Model jika sudah ada)
        $heroSlides = HeroSlide::orderBy('sort_order', 'asc')->get();

        // 2. Profil Website (Ambil data pertama, jika tidak ada buat objek baru)
        $profil = WebsiteProfile::first() ?? new WebsiteProfile();

        // 3. Footer Website
        $footer = WebsiteFooter::first() ?? new WebsiteFooter();

        return view('admin.kelola-konten-website', compact('heroSlides', 'profil', 'footer'));
    }

    /**
     * Menyimpan perubahan pada Hero Carousel.
     */
    public function saveHero(Request $request)
    {
        $request->validate([
            'slides' => 'required|array|min:1',
            'slides.*.title' => 'required|string|max:255',
            'slides.*.subtitle' => 'nullable|string|max:255',
            'slides.*.image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        try {
            DB::transaction(function () use ($request) {
                // Hapus slide yang tidak ada di input terbaru (karena user menekan tombol hapus)
                $incomingIds = collect($request->slides)->pluck('id')->filter()->toArray();
                $slidesToDelete = HeroSlide::whereNotIn('id', $incomingIds)->get();

                foreach ($slidesToDelete as $oldSlide) {
                    if ($oldSlide->image_path) {
                        Storage::disk('public')->delete($oldSlide->image_path);
                    }
                    $oldSlide->delete();
                }

                // Update atau Buat Slide Baru
                foreach ($request->slides as $index => $slideData) {
                    $slide = HeroSlide::findOrNew($slideData['id'] ?? null);
                    $slide->title = $slideData['title'];
                    $slide->subtitle = $slideData['subtitle'] ?? '';
                    $slide->sort_order = $index;

                    if ($request->hasFile("slides.$index.image")) {
                        // Hapus gambar lama jika sedang mengupdate slide yang sudah ada
                        if ($slide->image_path) {
                            Storage::disk('public')->delete($slide->image_path);
                        }
                        $slide->image_path = $request->file("slides.$index.image")->store('hero', 'public');
                    }
                    $slide->save();
                }
            });

            return redirect()->back()->with('success', 'Hero Carousel berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui Hero: ' . $e->getMessage());
        }
    }

    /**
     * Menyimpan perubahan pada Profil MPP.
     */
    public function saveProfil(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'vision'      => 'nullable|string',
            'mission'     => 'nullable|string',
            'image_1'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'image_2'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'image_3'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'video'       => 'nullable|mimes:mp4,mov,avi,wmv|max:25600', // Max 25MB
        ]);

        $profil = WebsiteProfile::firstOrNew(['id' => 1]);
        $profil->title = $request->title;
        $profil->description = $request->description;
        $profil->vision = $request->vision;
        $profil->mission = $request->mission;

        // Loop untuk 3 Gambar
        for ($i = 1; $i <= 3; $i++) {
            $inputName = "image_$i";
            $columnName = "image_path_$i";
            
            if ($request->hasFile($inputName)) {
                if ($profil->$columnName) {
                    Storage::disk('public')->delete($profil->$columnName);
                }
                $profil->$columnName = $request->file($inputName)->store('profil', 'public');
            }
        }

        // Upload Video
        if ($request->hasFile('video')) {
            if ($profil->video_path) {
                Storage::disk('public')->delete($profil->video_path);
            }
            $profil->video_path = $request->file('video')->store('profil/videos', 'public');
        }

        $profil->save();

        return redirect()->back()->with('success', 'Profil dan Media MPP berhasil diperbarui!');
    }

    /**
     * Menyimpan perubahan pada Footer & Lokasi.
     */
    public function saveFooter(Request $request)
    {
        $request->validate([
            'email'          => 'required|email|max:255',
            'phone'          => 'required|string|max:50',
            'whatsapp'       => 'nullable|string|max:50',
            'location_url'   => 'nullable|url',
            'facebook'       => 'nullable|url',
            'instagram'      => 'nullable|url',
            'youtube'        => 'nullable|url',
            'twitter'        => 'nullable|url',
            'address'        => 'required|string',
            'open_weekdays'  => 'required',
            'close_weekdays' => 'required',
            'open_friday'    => 'required',
            'close_friday'   => 'required',
            'weekend_notes'  => 'nullable|string|max:255',
        ]);

        WebsiteFooter::updateOrCreate(
            ['id' => 1],
            [
                'address'        => $request->address,
                'phone'          => $request->phone,
                'whatsapp'       => $request->whatsapp,
                'email'          => $request->email,
                'location_url'   => $request->location_url,
                'facebook'       => $request->facebook,
                'instagram'      => $request->instagram,
                'youtube'        => $request->youtube,
                'twitter'        => $request->twitter,
                'open_weekdays'  => $request->open_weekdays,
                'close_weekdays' => $request->close_weekdays,
                'open_friday'    => $request->open_friday,
                'close_friday'   => $request->close_friday,
                'weekend_notes'  => $request->weekend_notes ?? 'Sabtu - Minggu: Tutup',
            ]
        );

        return redirect()->back()->with('success', 'Informasi Footer dan Lokasi berhasil diperbarui!');
    }
}