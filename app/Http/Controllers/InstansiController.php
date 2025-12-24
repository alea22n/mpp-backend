<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use App\Models\Instansi;
use App\Models\Layanan;
use Illuminate\Support\Str; 
use Illuminate\Support\Collection;

class InstansiController extends Controller
{
    /**
     * Tampilkan halaman kelola instansi (Daftar Instansi).
     */
    public function index(): View
    {
        // Mengambil semua instansi dengan relasi layanan
        $instansiList = Instansi::with('layanan')->get(); 
        
        return view('admin.kelola-instansi', compact('instansiList')); 
    }

    /**
     * Tampilkan detail instansi tertentu.
     */
    public function show(string $slug): View|RedirectResponse
    {
        $instansi = Instansi::where('slug', $slug)->first(); 
        
        if (!$instansi) {
            return redirect()->route('kelola-instansi')->with('error', 'Instansi tidak ditemukan.');
        }

        $layananList = $instansi->layanan; 

        return view('admin.detail-instansi', compact('instansi', 'layananList')); 
    }
    
    /**
     * Menyimpan dan memperbarui data utama instansi (Informasi Lainnya & Sosmed).
     */
    public function update(Request $request, string $slug): RedirectResponse
    {
        $instansi = Instansi::where('slug', $slug)->firstOrFail(); 
        
        // Validasi field baru (email & sosmed)
        $request->validate([
            'nama_instansi'   => 'required|string|max:255',
            'subtitle'        => 'nullable|string|max:255',
            'alamat'          => 'nullable|string',
            'email'           => 'nullable|email|max:255',
            'kontak'          => 'nullable|string|max:50',
            'website'         => 'nullable|url|max:255',
            'facebook'        => 'nullable|url|max:255',
            'instagram'       => 'nullable|url|max:255',
            'twitter'         => 'nullable|url|max:255',
            'logo_file'       => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'foto_gerai_file' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:5120',
        ]);

        // Mengambil data input
        $data = $request->only([
            'nama_instansi', 'subtitle', 'alamat', 'email', 
            'kontak', 'website', 'facebook', 'instagram', 'twitter'
        ]);
        
        // 1. Penanganan Upload Logo
        if ($request->hasFile('logo_file')) {
            if ($instansi->logo_url) {
                Storage::delete('public/' . $instansi->logo_url);
            }
            $path = $request->file('logo_file')->store('public/instansi/logo');
            $data['logo_url'] = str_replace('public/', '', $path);
        }

        // 2. Penanganan Upload Foto Gerai
        if ($request->hasFile('foto_gerai_file')) {
            if ($instansi->foto_gerai_url) {
                Storage::delete('public/' . $instansi->foto_gerai_url);
            }
            $path = $request->file('foto_gerai_file')->store('public/instansi/gerai');
            $data['foto_gerai_url'] = str_replace('public/', '', $path);
        }
        
        // Update Slug jika nama instansi berubah
        if ($instansi->nama_instansi !== $data['nama_instansi']) {
            $data['slug'] = Str::slug($data['nama_instansi']);
        }

        $instansi->update($data);

        return redirect()->route('detail-instansi', $instansi->slug)
                         ->with('success', 'Data Instansi berhasil diperbarui.');
    }
    
    /**
     * Menyinkronkan (CRUD) data layanan.
     */
    public function syncLayanan(Request $request, string $slug): RedirectResponse
    {
        $instansi = Instansi::where('slug', $slug)->firstOrFail(); 
        
        $dataLayanan = $request->input('layanan', []);
        $layananToDelete = $request->input('layanan_to_delete', []);
        
        // 1. Proses Penghapusan Layanan
        if (!empty($layananToDelete)) {
            // Filter hanya ID yang memang milik instansi ini (keamanan)
            $deletedServices = $instansi->layanan()->whereIn('id', $layananToDelete)->get();
            foreach ($deletedServices as $service) {
                if ($service->layananPdf) {
                    Storage::delete('public/' . $service->layananPdf);
                }
                $service->delete();
            }
        }

        // 2. Proses Tambah/Update Layanan
        foreach ($dataLayanan as $index => $layananData) {
            // Abaikan jika nama layanan kosong
            if (empty($layananData['nama'])) continue;

            $layananId = $layananData['id'] ?? null;
            $pdfFile = $request->file("layanan.$index.pdf_file");
            
            $data = [
                'nama'   => $layananData['nama'],
                'biaya'  => $layananData['biaya'],
                'syarat' => $layananData['syarat'],
            ];
            
            // Logika Update atau Create
            $layanan = null;
            if ($layananId && $layananId !== 'new') {
                $layanan = $instansi->layanan()->find($layananId);
            }

            // Penanganan PDF
            if ($pdfFile) {
                // Hapus PDF lama jika ada
                if ($layanan && $layanan->layananPdf) {
                    Storage::delete('public/' . $layanan->layananPdf);
                }
                $path = $pdfFile->store("public/instansi/layanan/{$instansi->id}");
                $data['layananPdf'] = str_replace('public/', '', $path);
            } 
            // Jika syarat diubah jadi 'Tidak Ada Persyaratan', hapus PDF yang ada
            elseif ($data['syarat'] !== 'Ada Persyaratan') {
                if ($layanan && $layanan->layananPdf) {
                    Storage::delete('public/' . $layanan->layananPdf);
                }
                $data['layananPdf'] = null;
            }

            if ($layanan) {
                $layanan->update($data);
            } else {
                $instansi->layanan()->create($data);
            }
        }

        return redirect()->route('detail-instansi', $instansi->slug)
                         ->with('success', 'Daftar Layanan berhasil diperbarui.');
    }
}