<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Instansi;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Tampilkan daftar pengguna dengan fitur pencarian dan filter.
     */
    public function index(Request $request)
    {
        // 1. Inisialisasi Query dengan Eager Loading relasi instansi
        $query = User::with('instansi');

        // 2. Logika Pencarian Nama atau Email
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
            });
        }

        // 3. Logika Filter Role
        if ($request->has('role') && $request->role != '') {
            $query->where('role', $request->role);
        }

        // 4. Logika Filter Instansi (ID)
        if ($request->has('instansi_id') && $request->instansi_id != '') {
            $query->where('instansi_id', $request->instansi_id);
        }

        // 5. Eksekusi Query dengan Pagination
        // withQueryString() memastikan keyword pencarian tidak hilang saat pindah halaman (pagination)
        $users = $query->latest()->paginate(10)->withQueryString();

        // 6. Statistik Otomatis dari Database (tetap mengambil total keseluruhan)
        $totalUsers    = User::count();
        $totalAdmins   = User::where('role', 'Admin Instansi')->count();
        $totalStaff    = User::where('role', 'Petugas Instansi')->count();
        $totalNonAktif = User::where('status', 'Non-Aktif')->count();

        // 7. Data Instansi untuk Dropdown Filter & Modal Tambah Pengguna
        $instansiList = Instansi::all();

        return view('admin.data-pengguna', compact(
            'users', 
            'totalUsers', 
            'totalAdmins', 
            'totalStaff', 
            'totalNonAktif',
            'instansiList'
        ));
    }

    /**
     * Simpan data pengguna baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email',
            'password'    => 'required|min:8',
            'role'        => 'required',
            'instansi_id' => 'nullable|exists:instansis,id', // pastikan tabelnya bernama instansis
        ]);

        try {
            User::create([
                'name'        => $request->name,
                'email'       => $request->email,
                'password'    => Hash::make($request->password), // Enkripsi password
                'role'        => $request->role,
                'instansi_id' => $request->instansi_id,
                'status'      => 'Aktif', // Status default saat dibuat
            ]);

            return redirect()->back()->with('success', 'Pengguna berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan pengguna: ' . $e->getMessage());
        }
    }
}