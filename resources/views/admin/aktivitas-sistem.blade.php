@extends('layouts.app')

@section('title', 'Riwayat Aktivitas - MPP')

@push('styles')
<style>
    :root {
        --bg: #f6f8fb; 
        --card: #ffffff; 
        --muted: #7b7b7b; 
        --accent: #1a73e8;
        --shadow: 0 6px 18px rgba(20, 20, 50, 0.06);
        --radius: 12px;
    }

    .container-fluid {
        padding: 25px;
        background: var(--bg);
        min-height: 100vh;
    }
    
    .page-title {
        font-size: 24px; 
        font-weight: 700;
        margin-bottom: 25px; 
        color: #333;
    }

    .card-custom {
        background: var(--card); 
        border-radius: var(--radius);
        box-shadow: var(--shadow); 
        padding: 20px;
        margin-bottom: 25px;
        border: none;
    }

    .stats-grid { 
        display: grid; 
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); 
        gap: 20px; 
        margin-bottom: 25px; 
    }

    .stat-card { 
        background: var(--card);
        padding: 20px;
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
        transition: transform 0.2s ease;
    }
    
    .stat-card:hover { transform: translateY(-2px); }
    .stat-label { font-size: 14px; color: var(--muted); }
    .stat-value { font-weight: 700; font-size: 24px; margin-top: 5px; color: #333; }
    .stat-desc { font-size: 12px; color: var(--muted); margin-top: 5px; }
    
    .icon-circle { 
        width: 45px; height: 45px; border-radius: 50%; 
        display: flex; align-items: center; justify-content: center; 
        color: #fff; font-size: 20px; flex-shrink: 0;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .filter-row { 
        display: grid; 
        grid-template-columns: repeat(3, 1fr); 
        gap: 20px; 
    }
    .form-group label {
        display: block; margin-bottom: 8px; font-weight: 600; color: #444; font-size: 14px;
    }
    .filter-input { 
        width: 100%; padding: 10px; border-radius: 8px; 
        border: 1px solid #ddd; font-size: 14px; outline: none;
    }

    .table-responsive { width: 100%; overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; }
    thead { background-color: #ea4335; color: white; }
    th, td { 
        padding: 15px; 
        text-align: left; 
        border-bottom: 1px solid #f0f0f0; 
        font-size: 14px; 
    }
    
    .status-success { color: #34a853; font-weight: 600; }
    .status-failed { color: #ea4335; font-weight: 600; }

    .badge-peran {
        padding: 5px 12px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .log-header {
        display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;
    }
    .btn-primary { 
        background: var(--accent); color: white; border: none; padding: 10px 20px; 
        border-radius: 8px; cursor: pointer; font-weight: 600; 
        display: flex; align-items: center; gap: 8px; 
    }
    .btn-secondary {
        background: #f1f3f4; color: #3c4043; border: none; 
        padding: 10px 20px; border-radius: 8px; cursor: pointer; font-weight: 600;
    }

    .pagination-container {
        display: flex;
        justify-content: center;
        margin-top: 25px;
    }
    .pagination { 
        display: flex; 
        gap: 8px; 
        align-items: center;
    }
    .pagination button { 
        min-width: 35px;
        height: 35px;
        padding: 0 10px;
        border: 1px solid #ddd; 
        background: #fff; 
        border-radius: 6px; 
        cursor: pointer;
        font-weight: 600;
    }
    .pagination button.active { 
        background: var(--accent); 
        color: white; 
        border-color: var(--accent); 
    }

    @media (max-width: 768px) {
        .filter-row { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <h2 class="page-title">Aktivitas Sistem</h2>

    {{-- 1. WIDGET STATISTIK --}}
    <div class="stats-grid">
        <div class="stat-card">
            <div>
                <div class="stat-label">Aktivitas Hari Ini</div>
                <div class="stat-value" style="color: #1a73e8;">128</div>
                <div class="stat-desc">Login, edit data, dsb</div>
            </div>
            <div class="icon-circle" style="background: #1a73e8;"><i class="fa-solid fa-bolt"></i></div>
        </div>

        <div class="stat-card">
            <div>
                <div class="stat-label">Aktivitas 7 Hari Terakhir</div>
                <div class="stat-value" style="color: #34a853;">865</div>
                <div class="stat-desc">Kenaikan: <span style="color: #34a853; font-weight:600;">+12%</span></div>
            </div>
            <div class="icon-circle" style="background: #34a853;"><i class="fa-solid fa-chart-line"></i></div>
        </div>

        <div class="stat-card">
            <div>
                <div class="stat-label">Pengguna Aktif</div>
                <div class="stat-value" style="color: #fbbc04;">46</div>
                <div class="stat-desc">Admin & instansi aktif</div>
            </div>
            <div class="icon-circle" style="background: #fbbc04;"><i class="fa-solid fa-user-check"></i></div>
        </div>

        <div class="stat-card">
            <div>
                <div class="stat-label">Total Aktivitas</div>
                <div class="stat-value" style="color: #ea4335;">15.4K</div>
                <div class="stat-desc">Log sejak 2025</div>
            </div>
            <div class="icon-circle" style="background: #ea4335;"><i class="fa-solid fa-box"></i></div>
        </div>
    </div>

    {{-- 2. CHART SECTION --}}
    <div class="card-custom">
        <h4 style="font-weight: 700; margin-bottom: 20px; font-size: 17px;">Grafik Aktivitas Mingguan</h4>
        <div style="height: 300px;">
            <canvas id="activityChart"></canvas>
        </div>
    </div>

    {{-- 3. FILTER SECTION --}}
    <div class="card-custom">
        <h4 style="margin:0 0 20px 0; font-size: 17px; font-weight: 700;">Filter Aktivitas</h4>
        <div class="filter-row">
            <div class="form-group">
                <label>Tanggal Mulai</label>
                <input type="date" id="startDate" class="filter-input">
            </div>
            <div class="form-group">
                <label>Tanggal Akhir</label>
                <input type="date" id="endDate" class="filter-input">
            </div>
            <div class="form-group">
                <label>Jenis Aktivitas</label>
                <select id="activityType" class="filter-input">
                    <option value="semua">Semua Aktivitas</option>
                    <option value="Tindak Lanjut">Tindak Lanjut</option>
                    <option value="Pembaruan">Pembaruan</option>
                    <option value="Login">Login</option>
                    <option value="Hapus">Hapus</option>
                    <option value="Tambah">Tambah</option>
                </select>
            </div>
        </div>
        <div style="margin-top:20px; display: flex; gap: 12px;">
            <button class="btn-primary" onclick="filterData()"><i class="fa-solid fa-filter"></i> Terapkan Filter</button>
            <button class="btn-secondary" onclick="resetFilter()"><i class="fa-solid fa-rotate"></i> Reset</button>
        </div>
    </div>

    {{-- 4. LOG TABLE SECTION --}}
    <div class="card-custom">
        <div class="log-header">
            <h4 style="margin:0; font-size: 17px; font-weight: 700;">Log Aktivitas Terbaru</h4>
            <div style="display: flex; gap: 12px; align-items: center;">
                <select id="exportType" class="filter-input" style="width: auto;">
                    <option value="excel">Excel</option>
                    <option value="pdf">PDF</option>
                </select>
                <button class="btn-primary" onclick="alert('Exporting...')">
                    <i class="fa-solid fa-download"></i> Export
                </button>
            </div>
        </div>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>WAKTU</th>
                        <th>NAMA PENGGUNA</th>
                        <th>PERAN</th>
                        <th>AKTIVITAS</th>
                        <th>KETERANGAN</th> 
                        <th>STATUS</th>
                    </tr>
                </thead>
                <tbody id="activityBody">
                    {{-- Diisi via JS --}}
                </tbody>
            </table>
        </div>
        
        <div class="pagination-container">
            <div id="paginationControls" class="pagination"></div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data dummy (Pastikan format tanggal ISO YYYY-MM-DD agar mudah difilter)
    const activityData = [
        { date: "2025-12-17", time: "12:45", user: "Admin Utama", role: "Super Admin", activity: "Tindak Lanjut", description: "Pengaduan ID: PDN2025001 ditutup", status: "Berhasil" },
        { date: "2025-12-17", time: "11:15", user: "Sistem", role: "Sistem", activity: "Pembaruan", description: "Sistem diperbarui ke versi 3.1.0", status: "Berhasil" },
        { date: "2025-12-17", time: "09:40", user: "Admin Utama", role: "Super Admin", activity: "Login", description: "Login dari PC Admin", status: "Berhasil" },
        { date: "2025-12-15", time: "09:25", user: "Budi Santoso", role: "Admin Instansi", activity: "Hapus", description: "Gagal hapus data", status: "Dibatalkan" },
        { date: "2025-12-14", time: "09:10", user: "Siti Aminah", role: "Petugas", activity: "Tambah", description: "Menambahkan layanan baru", status: "Berhasil" }
    ];

    let filteredData = [...activityData];
    let currentPage = 1;
    const rowsPerPage = 5;

    function getRoleBadge(role) {
        let style = "";
        switch(role.toLowerCase()) {
            case 'super admin': style = "background: #e8f0fe; color: #1a73e8; border: 1px solid #1a73e8;"; break;
            case 'admin instansi': style = "background: #e6f4ea; color: #1e8e3e; border: 1px solid #1e8e3e;"; break;
            case 'petugas': style = "background: #fef7e0; color: #f9ab00; border: 1px solid #f9ab00;"; break;
            case 'sistem': style = "background: #f1f3f4; color: #5f6368; border: 1px solid #5f6368;"; break;
            default: style = "background: #fce8e6; color: #d93025; border: 1px solid #d93025;";
        }
        return `<span class="badge-peran" style="${style}">${role}</span>`;
    }

    function renderTable() {
        const tbody = document.getElementById('activityBody');
        tbody.innerHTML = '';
        
        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        const pageData = filteredData.slice(start, end);

        if(pageData.length === 0) {
            tbody.innerHTML = '<tr><td colspan="6" style="text-align:center;">Data tidak ditemukan</td></tr>';
        }

        pageData.forEach(item => {
            const statusClass = item.status === "Berhasil" ? "status-success" : "status-failed";
            tbody.innerHTML += `
                <tr>
                    <td>${item.date}, ${item.time}</td>
                    <td><strong>${item.user}</strong></td>
                    <td>${getRoleBadge(item.role)}</td>
                    <td><span style="background:#f0f2f5; padding:4px 10px; border-radius:12px; font-size:12px;">${item.activity}</span></td>
                    <td style="color: #666;">${item.description}</td>
                    <td class="${statusClass}">${item.status}</td>
                </tr>
            `;
        });
        renderPagination();
    }

    function renderPagination() {
        const pageCount = Math.ceil(filteredData.length / rowsPerPage);
        const container = document.getElementById('paginationControls');
        container.innerHTML = '';

        if (pageCount <= 1) return;

        const firstBtn = document.createElement('button');
        firstBtn.innerHTML = '<i class="fa-solid fa-angles-left"></i>';
        firstBtn.onclick = () => { currentPage = 1; renderTable(); };
        container.appendChild(firstBtn);

        for (let i = 1; i <= pageCount; i++) {
            const btn = document.createElement('button');
            btn.innerText = i;
            btn.className = i === currentPage ? 'active' : '';
            btn.onclick = () => { currentPage = i; renderTable(); };
            container.appendChild(btn);
        }

        const lastBtn = document.createElement('button');
        lastBtn.innerHTML = '<i class="fa-solid fa-angles-right"></i>';
        lastBtn.onclick = () => { currentPage = pageCount; renderTable(); };
        container.appendChild(lastBtn);
    }

    // LOGIKA FILTER
    function filterData() {
        const start = document.getElementById('startDate').value;
        const end = document.getElementById('endDate').value;
        const type = document.getElementById('activityType').value;

        filteredData = activityData.filter(item => {
            const matchDate = (!start || item.date >= start) && (!end || item.date <= end);
            const matchType = (type === 'semua' || item.activity === type);
            return matchDate && matchType;
        });

        currentPage = 1;
        renderTable();
    }

    function resetFilter() {
        document.getElementById('startDate').value = '';
        document.getElementById('endDate').value = '';
        document.getElementById('activityType').value = 'semua';
        filteredData = [...activityData];
        currentPage = 1;
        renderTable();
    }

    // Chart.js
    const ctx = document.getElementById('activityChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
            datasets: [{
                label: 'Jumlah Aktivitas',
                data: [65, 80, 120, 100, 150, 90, 70],
                borderColor: '#1a73e8',
                backgroundColor: 'rgba(26, 115, 232, 0.1)',
                fill: true, tension: 0.4
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });

    document.addEventListener('DOMContentLoaded', renderTable);
</script>
@endsection