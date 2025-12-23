<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use App\Models\Instansi;
use App\Models\Layanan;
// use App\Http\Controllers\Controller; // Tidak perlu, karena sudah di extends
use Illuminate\Support\Str; 
use Illuminate\Support\Collection; // Digunakan untuk testing/mengembalikan koleksi kosong

class InstansiController extends Controller
{
    /**
     * Tampilkan halaman kelola instansi (Daftar Instansi).
     *
     * @return View
     */
    public function index(): View
    {
        // -----------------------------------------------
        // PERBAIKAN KRITIS: MENGGUNAKAN DATA NYATA DARI DB
        // Mengambil semua instansi, sekaligus memuat (eager load) relasi layanan.
        $instansiList = Instansi::with('layanan')->get(); 
        // -----------------------------------------------
        
        return view('admin.kelola-instansi', compact('instansiList')); 
    }

    /**
     * Tampilkan detail instansi tertentu (Mencari berdasarkan SLUG).
     * Mapped to route: /detail-instansi/{slug}
     *
     * @param string $slug
     * @return View | RedirectResponse
     */
    public function show(string $slug): View|RedirectResponse
    {
        // Mencari berdasarkan kolom 'slug'
        $instansi = Instansi::where('slug', $slug)->first(); 
        
        if (!$instansi) {
            // Jika tidak ditemukan, arahkan kembali ke daftar instansi
            return redirect()->route('kelola-instansi')->with('error', 'Instansi tidak ditemukan.');
        }

        // Mengambil layanan terkait
        $layananList = $instansi->layanan; 

        return view('admin.detail-instansi', compact('instansi', 'layananList')); 
    }
    
    /**
     * Menyimpan dan memperbarui data utama instansi.
     * Menggunakan SLUG untuk mencari model.
     *
     * @param Request $request
     * @param string $slug
     * @return RedirectResponse
     */
    public function update(Request $request, string $slug): RedirectResponse
    {
        $instansi = Instansi::where('slug', $slug)->firstOrFail(); 
        
        $request->validate([
            'nama_instansi' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            // ... (validasi lainnya) ...
            'logo_file' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'foto_gerai_file' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:5120',
        ]);

        $data = $request->only(['nama_instansi', 'subtitle', 'alamat', 'kontak', 'website']);
        
        // 1. Penanganan Upload Logo
        if ($request->hasFile('logo_file')) {
            if ($instansi->logo_url) {
                Storage::delete($instansi->logo_url);
            }
            $data['logo_url'] = $request->file('logo_file')->store('public/instansi/logo');
            $data['logo_url'] = str_replace('public/', '', $data['logo_url']);
        }

        // 2. Penanganan Upload Foto Gerai
        if ($request->hasFile('foto_gerai_file')) {
            if ($instansi->foto_gerai_url) {
                Storage::delete($instansi->foto_gerai_url);
            }
            $data['foto_gerai_url'] = $request->file('foto_gerai_file')->store('public/instansi/gerai');
            $data['foto_gerai_url'] = str_replace('public/', '', $data['foto_gerai_url']);
        }
        
        // Pembuatan/pembaruan slug
        if (isset($data['nama_instansi'])) {
            $data['slug'] = Str::slug($data['nama_instansi']);
        }

        $instansi->update($data);

        return redirect()->route('detail-instansi', $instansi)->with('success', 'Data Instansi berhasil diperbarui.');
    }
    
    /**
     * Menyinkronkan (CRUD) data layanan.
     * Menggunakan SLUG untuk mencari model.
     *
     * @param Request $request
     * @param string $slug
     * @return RedirectResponse
     */
    public function syncLayanan(Request $request, string $slug): RedirectResponse
    {
        $instansi = Instansi::where('slug', $slug)->firstOrFail(); 
        
        $dataLayanan = $request->input('layanan', []);
        $layananToDelete = $request->input('layanan_to_delete', []);
        
        // 1. Proses Penghapusan Layanan
        if (!empty($layananToDelete)) {
            $deletedServices = $instansi->layanan()->whereIn('id', $layananToDelete)->get();
            foreach ($deletedServices as $service) {
                if ($service->layananPdf) {
                    Storage::delete('public/' . $service->layananPdf);
                }
            }
            $instansi->layanan()->whereIn('id', $layananToDelete)->delete();
        }

        // 2. Proses Tambah/Update Layanan
        foreach ($dataLayanan as $index => $layananData) {
            $layananId = $layananData['id'] ?? null;
            $pdfFile = $request->file("layanan.$index.pdf_file");
            
            $data = [
                'nama' => $layananData['nama'],
                'biaya' => $layananData['biaya'],
                'syarat' => $layananData['syarat'],
                'layananPdf' => $layananData['layananPdf_existing'] ?? null, 
            ];
            
            // Penanganan PDF
            if ($pdfFile) {
                if ($layananId) {
                    $layanan = Layanan::find($layananId);
                    if ($layanan && $layanan->layananPdf) {
                        Storage::delete('public/' . $layanan->layananPdf);
                    }
                }
                $pdfPath = $pdfFile->store("public/instansi/layanan/{$instansi->id}");
                $data['layananPdf'] = str_replace('public/', '', $pdfPath);
            } 
            elseif ($data['syarat'] !== 'Ada Persyaratan') {
                if ($layananId) {
                    $layanan = Layanan::find($layananId);
                    if ($layanan && $layanan->layananPdf) {
                        Storage::delete('public/' . $layanan->layananPdf);
                    }
                }
                $data['layananPdf'] = null;
            }


            if ($layananId) {
                $instansi->layanan()->find($layananId)->update($data);
            } else {
                $instansi->layanan()->create($data);
            }
        }

        return redirect()->route('detail-instansi', $instansi)->with('success', 'Daftar Layanan berhasil diperbarui.');
    }
    
    /**
     * Tampilkan halaman kelola layanan (Daftar Layanan).
     * @return View
     */
    public function layananIndex(): View
    {
        return view('admin.kelola-layanan'); 
    }
}