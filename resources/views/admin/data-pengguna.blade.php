@extends('layouts.app')

@section('title', 'Manajemen Pengguna')

@push('styles')
<style>
    :root {
      --bg: #f6f8fb;
      --card: #ffffff;
      --muted: #7b7b7b;
      --accent: #1a73e8;
      --shadow: 0 6px 18px rgba(20, 20, 50, 0.06);
    }
    
    /* 1. WIDGET STATISTIK */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 25px;
    }
    .stat-card {
        background: var(--card);
        padding: 20px;
        border-radius: 12px;
        box-shadow: var(--shadow);
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
    }
    .stat-card:hover {
        transform: translateY(-2px);
        transition: transform 0.2s ease;
    }
    .stat-value {
        font-size: 24px;
        font-weight: 700;
        margin-top: 8px;
    }
    .text-muted.small {
        font-size: 14px;
        color: var(--muted);
    }

    /* Icon Circle dari HTML asli */
    .icon-circle {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    /* Warna kustom dari HTML asli */
    .bg-accent { background-color: #1a73e8; }
    .bg-danger { background-color: #ea4335; }
    .bg-success { background-color: #34a853; }
    .bg-warning { background-color: #fbbc04; }


    /* 2. FILTER & TABEL */
    .filter-bar {
        background: var(--card);
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 20px;
        display: flex;
        gap: 12px;
        box-shadow: var(--shadow);
        flex-wrap: wrap;
    }
    .filter-bar input, .filter-bar select {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 8px;
        outline: none;
    }
    .export-group {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-left: auto;
    }
    .export-btn {
        background: #1a73e8;
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 8px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 14px;
    }
    
    .list-card {
        background: var(--card);
        padding: 20px;
        border-radius: 12px;
        box-shadow: var(--shadow);
    }
    .table-responsive table th, .table-responsive table td {
        padding: 12px 10px;
        font-size: 14px;
    }

    /* BUTTONS */
    .btn-primary { background: var(--accent); color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; font-weight: 600; display: flex; align-items: center; gap: 8px; }
    .btn-success { background: #34a853; color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; }
    .btn-secondary { background: #eee; color: #333; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; }

    /* Aksi Tombol Kecil dari HTML asli */
    .action-btn {
        padding: 8px 10px;
        border-radius: 8px;
        border: none;
        color: white;
        cursor: pointer;
    }
    .btn-delete { background: #ea4335; } 

    .pagination-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
    }

    /* 3. MODAL CUSTOM */
    .modal-overlay {
        position: fixed; 
        top: 0; 
        left: 0; 
        width: 100%; 
        height: 100%;
        background: rgba(0,0,0,0.6);
        display: none; 
        justify-content: center; 
        align-items: center; 
        z-index: 9999;
        
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
    }
    .modal-overlay.show {
        opacity: 1;
    }

    .modal-content {
        background: var(--card); 
        padding: 30px; 
        border-radius: 15px; 
        width: 100%; 
        max-width: 500px;
        box-shadow: 0 15px 30px rgba(0,0,0,0.3);
        
        max-height: 90vh; 
        overflow-y: auto;
        
        transform: translateY(-50px);
        transition: transform 0.3s ease-in-out;
    }

    .modal-overlay.show .modal-content {
        transform: translateY(0);
    }
    
    .form-group { margin-bottom: 20px; }
    .form-group label { 
        display: block; 
        margin-bottom: 6px; 
        font-weight: 600;
        font-size: 14px; 
        color: #444; 
    }
    .form-group input, .form-group select { 
        width: 100%; 
        padding: 12px;
        border: 1px solid #ddd; 
        border-radius: 8px;
        transition: border-color 0.2s, box-shadow 0.2s;
        box-sizing: border-box;
    }
    .form-group input:focus, .form-group select:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(26, 115, 232, 0.2);
    }

     /* PAGINATION */
    .pagination {
        display: flex;
        justify-content: center;
        gap: 6px;
        margin-top: 25px;
    }
    .pagination button {
        padding: 8px 14px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background: #fff;
        cursor: pointer;
        transition: all 0.2s;
    }
    .pagination button.active {
        background: #1a73e8;
        color: #fff;
        border-color: #1a73e8;
    }
    .pagination button:disabled { opacity: 0.5; cursor: not-allowed; }
</style>
@endpush

@section('content')
<div class="container-fluid">
    
    {{-- BARIS JUDUL HANYA BERISI TEKS "Data Pengguna" --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1" style="font-weight: 700;">Data Pengguna</h2>
            {{-- Elemen jam real-time yang dihapus: <p id="realtimeClock" class="text-muted mb-0"></p> --}}
        </div>
    </div>

    {{-- 1. WIDGET STATISTIK --}}
    <div class="stats-grid">
        <div class="stat-card">
            <div>
                <div class="text-muted small">Total Pengguna</div>
                <div class="stat-value text-dark">{{ $totalUsers ?? 0 }}</div>
            </div>
            <div class="icon-circle bg-accent"><i class="fa-solid fa-users"></i></div>
        </div>

        <div class="stat-card">
            <div>
                <div class="text-muted small">Admin Instansi</div>
                <div class="stat-value text-dark">{{ $totalAdmins ?? 0 }}</div>
            </div>
            <div class="icon-circle bg-danger"><i class="fa-solid fa-user-tie"></i></div>
        </div>

        <div class="stat-card">
            <div>
                <div class="text-muted small">Petugas Aktif</div>
                <div class="stat-value text-dark">{{ $totalStaff ?? 0 }}</div>
            </div>
            <div class="icon-circle bg-success"><i class="fa-solid fa-user-check"></i></div>
        </div>
        
        <div class="stat-card">
            <div>
                <div class="text-muted small">Nonaktif</div>
                <div class="stat-value text-dark">{{ $totalNonAktif ?? 0 }}</div>
            </div>
            <div class="icon-circle bg-warning"><i class="fa-solid fa-user-xmark"></i></div>
        </div>
    </div>

    {{-- 2. FILTER BAR --}}
    <form action="{{ route('data-pengguna') }}" method="GET" class="filter-bar">
        <input type="text" name="search" placeholder="Cari nama atau email..." value="{{ request('search') }}" style="flex: 2;">
        
        <select name="role" style="flex: 1;">
            <option value="">Semua Role</option>
            <option value="Super Admin" {{ request('role') == 'Super Admin' ? 'selected' : '' }}>Super Admin</option>
            <option value="Admin Instansi" {{ request('role') == 'Admin Instansi' ? 'selected' : '' }}>Admin Instansi</option>
            <option value="Petugas Instansi" {{ request('role') == 'Petugas Instansi' ? 'selected' : '' }}>Petugas Instansi</option>
        </select>
        
        <select name="instansi_id" style="flex: 1;">
            <option value="">Semua Instansi</option>
            @foreach($instansiList as $ins)
                <option value="{{ $ins->id }}" {{ (string)request('instansi_id') === (string)$ins->id ? 'selected' : '' }}>{{ $ins->nama_instansi }}</option>
            @endforeach
        </select>

        <button type="submit" class="btn-primary"><i class="fas fa-search"></i> Filter</button>
        
        <div class="export-group">
            <select id="exportType">
                <option value="csv">CSV</option>
                <option value="excel">Excel</option>
                <option value="pdf">PDF</option>
            </select>
            <button type="button" class="export-btn" onclick="alert('Fungsi Export harus diimplementasikan!')"><i class="fa-solid fa-download"></i>Export</button>
        </div>
    </form>

    {{-- 3. DAFTAR PENGGUNA (TABEL) --}}
    <div class="list-card">
        <div class="table-responsive">
            <table class="table" style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 2px solid #eee; text-align: left;">
                        <th class="pb-3">NAMA</th>
                        <th class="pb-3">EMAIL</th>
                        <th class="pb-3">ROLE</th>
                        <th class="pb-3">INSTANSI</th>
                        <th class="pb-3" style="width: 100px; text-align: center;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr style="border-bottom: 1px solid #f9f9f9;">
                        <td class="py-3"><strong>{{ $user->name }}</strong></td>
                        <td class="py-3">{{ $user->email }}</td>
                        <td class="py-3">
                            <span class="badge" style="background: #e8f0fe; color: #1a73e8; padding: 5px 10px; border-radius: 6px; font-size: 12px;">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td class="py-3">{{ $user->instansi->nama_instansi ?? 'Pusat' }}</td>
                        <td class="py-3" style="text-align: center;">
                            <button class="action-btn btn-delete" title="Hapus Pengguna" onclick="confirm('Hapus {{ $user->name }}?')"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">Data pengguna tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-container">
            <div class="pagination" id="userPagination"></div>
            <button class="btn-primary" onclick="toggleModal(true)">
                <i class="fas fa-user-plus"></i> Tambah Pengguna Baru
            </button>
        </div>
    </div>
</div>

{{-- 4. MODAL TAMBAH PENGGUNA BARU --}}
<div class="modal-overlay" id="userModal">
    <div class="modal-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="m-0">Tambah Pengguna Baru</h4>
            <span style="cursor:pointer; font-size: 24px;" onclick="toggleModal(false)">&times;</span>
        </div>
        
        <form action="#" method="POST">
            @csrf
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="name" required placeholder="Contoh: Ahmad Subardjo">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required placeholder="email@instansi.go.id">
            </div>
            <div class="form-group">
                <label>Role</label>
                <select name="role" required>
                    <option value="Admin Instansi">Admin Instansi</option>
                    <option value="Petugas Instansi">Petugas Instansi</option>
                </select>
            </div>
            <div class="form-group">
                <label>Instansi</label>
                <select name="instansi_id">
                    <option value="">-- Pilih Instansi --</option>
                    @foreach($instansiList as $ins)
                        <option value="{{ $ins->id }}">{{ $ins->nama_instansi }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-actions d-flex justify-content-end gap-2 mt-4">
                <button type="button" class="btn-secondary" onclick="toggleModal(false)">Batal</button>
                <button type="submit" class="btn-success">Simpan Pengguna</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Data pengguna dari server (PHP ke JS)
    const userData = @json($users->items());
    const userTotal = {{ $users->total() }};
    const userPerPage = {{ $users->perPage() }};
    let userCurrentPage = {{ $users->currentPage() }};
    const userLastPage = {{ $users->lastPage() }};

    // Render Pagination mirip kelola-instansi
    function renderUserPagination() {
        const container = document.getElementById('userPagination');
        if (!container) return;
        container.innerHTML = "";
        if (userLastPage <= 1) return;

        // Prev
        const prevBtn = document.createElement('button');
        prevBtn.innerHTML = '<i class="fa-solid fa-chevron-left"></i>';
        prevBtn.disabled = userCurrentPage === 1;
        prevBtn.onclick = () => gotoUserPage(userCurrentPage - 1);
        container.appendChild(prevBtn);

        // Nomor Halaman
        for (let i = 1; i <= userLastPage; i++) {
            if (i === 1 || i === userLastPage || (i >= userCurrentPage - 1 && i <= userCurrentPage + 1)) {
                const btn = document.createElement('button');
                btn.innerText = i;
                btn.className = i === userCurrentPage ? 'active' : '';
                btn.onclick = () => gotoUserPage(i);
                container.appendChild(btn);
            }
        }

        // Next
        const nextBtn = document.createElement('button');
        nextBtn.innerHTML = '<i class="fa-solid fa-chevron-right"></i>';
        nextBtn.disabled = userCurrentPage === userLastPage;
        nextBtn.onclick = () => gotoUserPage(userCurrentPage + 1);
        container.appendChild(nextBtn);
    }

    function gotoUserPage(page) {
        // Ambil parameter query string saat ini
        const params = new URLSearchParams(window.location.search);
        params.set('page', page);
        window.location.search = params.toString();
    }

    document.addEventListener("DOMContentLoaded", renderUserPagination);

    // Toggle Modal (Disesuaikan untuk transisi CSS)
    function toggleModal(show) {
        const modal = document.getElementById('userModal');
        if (show) {
            modal.style.display = 'flex';
            setTimeout(() => {
                modal.classList.add('show');
            }, 10);
        } else {
            modal.classList.remove('show');
            setTimeout(() => {
                modal.style.display = 'none';
            }, 300);
            document.getElementById('userModal').querySelector('form').reset();
        }
    }
    window.onclick = function(event) {
        const modal = document.getElementById('userModal');
        if (modal.classList.contains('show') && event.target == modal) {
            toggleModal(false);
        }
    }
</script>
@endpush