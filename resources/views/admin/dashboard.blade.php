@extends('layouts.app')

{{-- Menetapkan judul halaman untuk @yield('title') di layout induk --}}
@section('title', 'Dashboard - MPP Sukoharjo')

{{-- CSS SPESIFIK DASHBOARD (Widget, Grid, Tabel, Chart, dan Aside) --}}
@push('styles')
<style>
/* =====================================
   GAYA UMUM & LAYOUT GRID
   ===================================== */
:root {
    /* Menggunakan variabel dari layouts/app.blade.php, tapi didefinisikan ulang untuk lokalitas */
    --accent: #1a73e8; /* Biru Primer */
    --card: #ffffff;
    --shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    --muted: #666;
    --error: #ea4335;
}

.grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 18px;
    margin-bottom: 25px;
}
.card.small {
    background: var(--card);
    padding: 20px;
    border-radius: 10px;
    box-shadow: var(--shadow);
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.card.small h3 { margin: 0 0 5px 0; font-size: 14px; color: var(--muted); }
.card.small .num { font-size: 24px; font-weight: 700; color: #222; }
.icon-circle {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
}
.chart-container {
    height: 300px; 
    padding-top: 15px;
}
.layout {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 20px;
    margin-top: 20px;
}
.list-card { /* Kartu utama untuk tabel dan aktivitas */
    background: var(--card);
    padding: 20px;
    border-radius: 10px;
    box-shadow: var(--shadow);
    overflow: hidden; 
    flex-grow: 1; 
}
.fixed-height-card {
    /* Tinggi tetap agar konten aside dan main seimbang */
    height: 480px; 
    display: flex;
    flex-direction: column;
}

/* =====================================
   GAYA TABEL INSTANSI & KONTROL EXPORT
   ===================================== */
.export-group { display: flex; align-items: center; gap: 10px; }
.export-btn-style { 
    background: var(--accent); 
    color: white; border: none; padding: 6px 12px; border-radius: 8px; cursor: pointer;
    display: flex; align-items: center; gap: 5px; font-size: 13px; font-weight: 500;
    transition: background-color 0.2s;
}
.export-btn-style:hover { background: #155fc1; }
#tableInstansiDashboard { width: 100%; border-collapse: collapse; table-layout: fixed; margin-top: 5px; }
#tableInstansiDashboard thead th {
    padding: 10px 8px; text-align: left; background-color: var(--error); color: #fff;
    font-weight: 600; font-size: 13px; border-bottom: none; 
}
#tableInstansiDashboard td {
    padding: 10px 8px; font-size: 13px; vertical-align: middle; border-bottom: 1px solid #f0f0f0; 
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis; height: 48px; 
}
/* Lebar Kolom */
#tableInstansiDashboard th:nth-child(1), #tableInstansiDashboard td:nth-child(1) { width: 55%; white-space: normal; } 
#tableInstansiDashboard th:nth-child(2), #tableInstansiDashboard td:nth-child(2) { width: 15%; text-align: center; } 
#tableInstansiDashboard th:nth-child(3), #tableInstansiDashboard td:nth-child(3) { width: 15%; text-align: center; } 
#tableInstansiDashboard th:nth-child(4), #tableInstansiDashboard td:nth-child(4) { width: 15%; text-align: center; } 
.status-badge {
    display: inline-block; padding: 4px 10px; border-radius: 8px; font-size: 11px;
    font-weight: 600; text-transform: uppercase; text-align: center;
}
.status-active { background-color: #e6f6ed; color: #38a169; }
.status-inactive { background-color: #fef3c7; color: #d97706; }
.action-btn-group { display: flex; justify-content: center; gap: 5px; }
.action-btn {
    width: 30px; height: 30px; padding: 0; border: none; border-radius: 5px;
    font-size: 12px; cursor: pointer; transition: background-color 0.2s;
    display: flex; align-items: center; justify-content: center;
}
.action-edit { background-color: #fbbc04; color: #fff; }
.action-delete { background-color: #ea4335; color: #fff; }

/* =====================================
   GAYA FOOTER UMUM, PAGINATION & LINK TENGAH
   ===================================== */
.table-footer { 
    border-top: 1px solid #eee;
    padding-top: 15px;
    margin-top: 5px; 
    text-align: center; /* Rata tengah */
}
.table-footer a {
    font-size: 13px;
    color: var(--accent);
    text-decoration: none;
    font-weight: 500;
}
.table-footer a:hover {
    text-decoration: underline;
}

.pagination {
    display: flex; 
    justify-content: center; /* Rata tengah */
    padding: 0; 
    margin: 0;
    gap: 4px;
    flex-wrap: wrap; 
}
.pagination button {
    padding: 5px 10px;
    border: 1px solid #ddd;
    border-radius: 6px;
    background: #fff;
    cursor: pointer;
    font-size: 13px;
    color: #555;
    min-width: 30px;
    text-align: center;
}
.pagination button.active {
    background-color: var(--accent); 
    color: #fff;
    border-color: var(--accent);
}

.list-card.fixed-height-card > .pagination {
    /* PENTING: Mendorong pagination ke bawah di dalam kartu flex (Tabel Instansi) */
    margin-top: auto; 
    padding: 10px 0;
}
/* =====================================
   GAYA ASIDE (Aktivitas, Jadwal, Akses Cepat)
   ===================================== */

/* 1. List Notifikasi (Aktivitas Terbaru) */
.notification-list {
    list-style: none;
    padding: 0;
    margin: 0;
}
.notification-item {
    display: flex;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid #eee;
    cursor: pointer;
    transition: background-color 0.1s;
}
.notification-item:last-child {
    border-bottom: none;
}
.notification-item:hover {
    background-color: #f9f9f9;
}
.notification-avatar {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 14px;
    flex-shrink: 0; 
    margin-right: 12px;
}
.notif-avatar-1 { background-color: #4285f4; } 
.notif-avatar-2 { background-color: #34a853; } 
.notif-avatar-3 { background-color: #fbbc04; } 
.notif-text {
    font-size: 13px;
    color: #333;
    flex-grow: 1; 
    line-height: 1.4;
}
.notif-time {
    font-size: 11px;
    color: var(--muted);
    flex-shrink: 0;
    text-align: right;
    margin-left: 10px;
}

/* 2. Jadwal Pelayanan */
#scheduleTable {
    width: 100%;
    border-collapse: collapse;
}
#scheduleTable td {
    padding: 8px 0; 
    font-size: 13px;
    border-top: 1px solid #eee;
    height: 30px; 
}
#scheduleTable tr:first-child td { border-top: none; }
#scheduleTable td:first-child { 
    font-weight: 500; 
    color: #444; 
    width: 120px; 
}
#scheduleTable td:last-child { 
    text-align: right; 
    font-weight: 600; 
    color: #222; 
}

/* 3. Quick Access */
.quick-access-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
    margin-top: 10px;
}
.quick-access-btn {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 15px 10px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background: #fcfcfc;
    cursor: pointer;
    transition: all 0.2s;
    font-size: 13px;
    color: #444;
}
.quick-access-btn i {
    font-size: 20px;
    margin-bottom: 5px;
    color: var(--accent);
}
.quick-access-btn:hover {
    background: #f0f4ff;
    border-color: #d0e0ff;
    color: var(--accent);
}

/* =====================================
   GAYA MODAL (POPUP)
   ===================================== */
.modal-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: none; 
    justify-content: center;
    align-items: center;
    z-index: 1000;
    opacity: 0;
    transition: opacity 0.3s;
}
.modal-backdrop.open {
    display: flex;
    opacity: 1;
}
.modal {
    background: #fff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    width: 90%;
    max-width: 450px;
    transform: translateY(-50px);
    transition: transform 0.3s, opacity 0.3s;
}
.modal-backdrop.open .modal {
    transform: translateY(0);
}

.modal input, .modal select {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ddd;
    border-radius: 6px;
    box-sizing: border-box;
    font-size: 14px;
}
.modal input:focus, .modal select:focus {
    border-color: var(--accent);
    outline: none;
}
.form-row {
    margin-bottom: 12px;
}

@media (max-width: 1200px) {
    .layout { grid-template-columns: 1fr; }
}

</style>
@endpush


@section('content')
    
    {{-- WIDGETS STATISTIK (GRID) --}}
    <h2 style="margin-top:0;">Dashboard</h2>

    <div class="grid">
        <div class="card small">
            <div><h3>Total Instansi</h3><div class="num" id="totalInstansi">33</div></div>
            <div class="icon-circle" style="background-color: #ea4335;"><i class="fa-solid fa-building"></i></div>
        </div>
        <div class="card small">
            <div><h3>Total Layanan</h3><div class="num">120</div></div>
            <div class="icon-circle" style="background-color: #fbbc04;"><i class="fa-solid fa-list-check"></i></div>
        </div>
        <div class="card small">
            <div><h3>Total Pengguna</h3><div class="num">200</div></div>
            <div class="icon-circle" style="background-color: #34a853;"><i class="fa-solid fa-users"></i></div>
        </div>
        <div class="card small">
            <div><h3>Total Pengaduan</h3><div class="num">200</div></div>
            <div class="icon-circle" style="background-color: #1a73e8;"><i class="fa-solid fa-comment-dots"></i></div>
        </div>
    </div>

    {{-- GRAFIK / CHART --}}
    <div class="list-card" style="margin-bottom:18px">
        <div style="display:flex;justify-content:space-between;align-items:center;">
            <h3 style="margin:0">Data Layanan per Instansi (Tahun 2025)</h3>
            <select id="chartYear" style="padding:6px 10px;border-radius:8px;border:1px solid #ddd">
                <option>Tahun 2025</option>
                <option>Tahun 2024</option>
            </select>
        </div>
        <div class="chart-container">
            <canvas id="chartLayanan"></canvas>
        </div>
    </div>

    {{-- TATA LETAK UTAMA (Tabel dan Aside) --}}
    <div class="layout">
        <div>
            {{-- START: Header Tabel dan Kontrol Export --}}
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                <h3 style="margin:0">Daftar Instansi Aktif</h3>
                <div class="export-group">
                    <div class="table-header-controls">
                        <select id="exportType">
                            <option value="pdf">PDF</option>
                            <option value="csv">CSV</option>
                            <option value="xlsx">XLSX</option>
                            <option value="word">Word</option>
                        </select>
                    </div>
                    <button class="export-btn-style" onclick="exportInstansiData()">
                        <i class="fa-solid fa-download"></i> Export
                    </button>
                </div>
            </div>
            {{-- END: Header Tabel dan Kontrol Export --}}

            {{-- TABEL DATA INSTANSI --}}
            <div class="list-card fixed-height-card">
                <table id="tableInstansiDashboard">
                    <thead>
                        <tr>
                            <th>Nama Instansi</th>
                            <th style="text-align: center;">Layanan</th>
                            <th style="text-align: center;">Status</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Data akan diisi oleh JavaScript renderDashboardList() --}}
                    </tbody>
                </table>

                {{-- PAGINATION --}}
                <div class="pagination" id="pagination"></div>

                {{-- LINK LIHAT SEMUA INSTANSI --}}
                <div class="table-footer">
                    {{-- PERBAIKAN: Menggunakan route('kelola-instansi') --}}
                    <a href="{{ route('kelola-instansi') }}">Lihat Semua Instansi</a>
                </div>
            </div>
        </div>

        {{-- ASIDE (Aktivitas, Jadwal, Akses Cepat) --}}
        <aside>
            {{-- 1. AKTIVITAS TERBARU (Notifikasi) --}}
            <div class="list-card" style="margin-bottom:16px;">
                <h3 style="margin-top:0">Aktivitas Terbaru</h3>
                <ul id="notificationList" class="notification-list"></ul>
                
                {{-- FOOTER NOTIFIKASI --}}
                <div class="table-footer">
                    {{-- PERBAIKAN: Menggunakan route('notifikasi') --}}
                    <a href="{{ route('notifikasi') }}">Lihat Semua Notifikasi</a>
                </div>
            </div>

            {{-- 2. JADWAL PELAYANAN --}}
            <div class="list-card" style="margin-bottom:16px;">
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <h3 style="margin-top:0">Jadwal Pelayanan</h3>
                    <button class="btn" style="background:#f0f4ff; color:var(--accent); padding:4px 8px; font-size:12px;" onclick="openEditScheduleModal()">
                        <i class="fa-solid fa-pen"></i> Edit
                    </button>
                </div>
                <table id="scheduleTable">
                    <tbody>
                        <tr><td>Senin</td><td id="schedule-senin">08.00 - 15.00</td></tr>
                        <tr><td>Selasa</td><td id="schedule-selasa">08.00 - 15.00</td></tr>
                        <tr><td>Rabu</td><td id="schedule-rabu">08.00 - 15.00</td></tr>
                        <tr><td>Kamis</td><td id="schedule-kamis">08.00 - 15.00</td></tr>
                        <tr><td>Jumat</td><td id="schedule-jumat">08.00 - 14.00</td></tr>
                        <tr><td>Sabtu, Minggu</td><td id="schedule-weekend">Tutup</td></tr>
                    </tbody>
                </table>
            </div>

            {{-- 3. QUICK ACCESS --}}
            <div class="list-card">
                <h3 style="margin-top:0">Quick Access Menu</h3>
                <div class="quick-access-grid">
                    <button class="quick-access-btn" onclick="openAddModal()">
                        <i class="fa-solid fa-circle-plus"></i><span>Tambah Instansi</span>
                    </button>
                    <button class="quick-access-btn" onclick="alert('Kelola Antrian (demo)')">
                        <i class="fa-solid fa-user-clock"></i><span>Kelola Antrian</span>
                    </button>
                </div>
            </div>
        </aside>
    </div>

    {{-- MODAL Tambah/Edit Instansi --}}
    <div id="modal" class="modal-backdrop" onclick="closeModal(event)">
        <div class="modal" role="dialog" aria-modal="true" onclick="event.stopPropagation()">
            <h3 id="modalTitle">Tambah Instansi</h3>
            <div style="margin-top:12px">
                <div class="form-row"><input id="instName" placeholder="Nama Instansi" /></div>
                <div class="form-row"><input id="instServices" placeholder="Jumlah Layanan (angka)" /></div>
                <div class="form-row">
                    <select id="instStatus">
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                    </select>
                </div>
                <div style="display:flex;justify-content:flex-end;gap:8px;margin-top:12px">
                    <button class="btn ghost" onclick="closeModal()">Batal</button>
                    <button class="btn primary" onclick="saveInstansi()">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL Edit Jadwal Pelayanan --}}
    <div id="editScheduleModal" class="modal-backdrop" onclick="closeScheduleModal(event)">
        <div class="modal" role="dialog" aria-modal="true" onclick="event.stopPropagation()">
            <h3 id="scheduleModalTitle">Edit Jadwal Pelayanan</h3>
            <div style="margin-top:12px" id="scheduleFormContent">
                {{-- Konten input jadwal akan diisi oleh JavaScript --}}
            </div>
            <div style="display:flex;justify-content:flex-end;gap:8px;margin-top:20px">
                <button class="btn ghost" onclick="closeScheduleModal()">Batal</button>
                <button class="btn primary" onclick="saveSchedule()">Simpan Perubahan</button>
            </div>
        </div>
    </div>
@endsection

{{-- JAVASCRIPT SPESIFIK DASHBOARD --}}
@push('scripts')
    {{-- Memastikan library yang dibutuhkan untuk Chart dan Export dimuat --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>

    <script>
    // =====================================
    // LOGIKA DATA SIMULASI
    // =====================================
    const instansiNames = [
        "Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu (DPMPTSP) Prov. Jawa Tengah",
        "Unit Pelaksana Teknis Badan Pelindungan Pekerja Migran Indonesia (UPT BP2MI) Kota Semarang",
        "Unit Pengelolaan Pendapatan Daerah (UPPD) Kab. Sukoharjo",
        "Polres Sukoharjo","Kejaksaan Negeri Sukoharjo","Kementerian Agama Kab. Sukoharjo",
        "Pengadilan Negeri Sukoharjo Kelas IA","Pengadilan Agama Kab. Sukoharjo",
        "Kantor Pajak Pratama (KPP) Kab. Sukoharjo","Loka POM Surakarta","PT Taspen","BPJS Kesehatan",
        "BPJS Ketenagakerjaan","Kantor Pertanahan Kab. Sukoharjo","Dinas Kesehatan Kab. Sukoharjo",
        "Dinas Perdagangan, Koperasi Usaha Kecil dan Menengah Kab. Sukoharjo",
        "Dinas Pekerjaan Umum dan Penataan Ruang Kab. Sukoharjo","Dinas Lingkungan Hidup Kab. Sukoharjo",
        "Dinas Kependudukan dan Pencatatan Sipil Kab. Sukoharjo","Badan Keuangan Daerah (BKD) Kab. Sukoharjo",
        "Dinas Sosial Kab. Sukoharjo","Dinas Pendidikan dan Kebudayaan Kab. Sukoharjo",
        "Badan Kesatuan Bangsa dan Politik","Dinas Kearsipan dan Perpustakaan Kab. Sukoharjo",
        "Dinas Perhubungan Kab. Sukoharjo","Dinas Perindustrian dan Tenaga Kerja Kab. Sukoharjo",
        "Dinas Pengendalian Penduduk Keluarga Berencana dan Pemberdayaan Perempuan dan Perlindungan Anak (DPPKBP3A) Kab. Sukoharjo",
        "Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu (DPMPTSP) Kab. Sukoharjo",
        "Bank Jateng Cabang Sukoharjo","BRI","Bank Sukoharjo","PDAM Tirta Makmur","PT. Pegadaian"
    ];

    const createInstansiList = (names) => names.map((name, index) => ({
        id: index + 1, 
        nama: name,
        layanan: Math.floor(Math.random() * 14) + 2,
        status: index % 5 === 0 ? 'Tidak Aktif' : 'Aktif' 
    }));

    const baseInstansiList = createInstansiList(instansiNames);
    let instansiList = [...baseInstansiList];
    const rowsPerPage = 5;
    let currentPage = 1;

    // Data Notifikasi Simulasi (Untuk list di aside)
    const notificationDataAside = [
        { id: 1, avatarClass: "notif-avatar-1", icon: "fa-user", text: "Admin Utama memperbarui Instansi", time: "2 jam lalu", read: false }, 
        { id: 2, avatarClass: "notif-avatar-2", icon: "fa-bell", text: "Pengaduan dari masyarakat telah ditindak lanjuti", time: "2 jam lalu", read: true },
        { id: 3, avatarClass: "notif-avatar-3", icon: "fa-user", text: "Admin DPMPTSP login", time: "3 jam lalu", read: false }, 
        { id: 4, avatarClass: "notif-avatar-1", icon: "fa-building", text: "Instansi baru (BPJS) telah ditambahkan", time: "1 hari lalu", read: true },
        { id: 5, avatarClass: "notif-avatar-2", icon: "fa-comments", text: "Ada 3 masukan baru dari masyarakat", time: "1 hari lalu", read: false }, 
    ];

    // Data Jadwal Pelayanan
    let serviceSchedule = {
        "senin": "08.00 - 15.00",
        "selasa": "08.00 - 15.00",
        "rabu": "08.00 - 15.00",
        "kamis": "08.00 - 15.00",
        "jumat": "08.00 - 14.00",
        "weekend": "Tutup"
    };
    
    // =====================================
    // UTILITIES
    // =====================================
    function escapeHtml(unsafe) {
        return String(unsafe)
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }

    // =====================================
    // LOGIKA TABEL & PAGINATION
    // =====================================
    function renderDashboardList(){
        const tbody=document.getElementById('tableInstansiDashboard').getElementsByTagName('tbody')[0];
        if(!tbody) return;
        tbody.innerHTML='';
        const start=(currentPage-1)*rowsPerPage;
        const end=currentPage*rowsPerPage;
        const pagedList=instansiList.slice(start, end);

        if(pagedList.length===0){
            const tr=document.createElement('tr');
            tr.innerHTML='<td colspan="4" style="text-align:center;padding:20px;">Tidak ada data instansi yang cocok.</td>';
            tbody.appendChild(tr);
        } else {
            pagedList.forEach(item=>{
                const tr=document.createElement('tr');
                const statusClass = item.status === 'Aktif' ? 'status-active' : 'status-inactive'; 
                
                const instansiSlug = item.nama.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-*|-*$/g, '');
                
                // PERBAIKAN: Menggunakan route('detail-instansi') dan string replacement untuk slug
                // resources\views\admin\dashboard.blade.php:600

                // Periksa dan ubah juga di sini jika masih menggunakan 'instansi'
                const editUrl = '{{ route('detail-instansi', ['slug' => '__SLUG__']) }}'.replace('__SLUG__', instansiSlug);
                const deleteAction = `deleteInstansi(${item.id}, '${escapeHtml(item.nama)}')`; 
                
                tr.innerHTML=`
                    <td>${escapeHtml(item.nama)}</td>
                    <td style="text-align: center;">${item.layanan}</td>
                    <td style="text-align: center;">
                        <span class="status-badge ${statusClass}">${escapeHtml(item.status)}</span>
                    </td>
                    <td style="text-align: center;">
                        <div class="action-btn-group">
                            <button class="action-btn action-edit" title="Edit Instansi" onclick="window.location.href='${editUrl}'">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                            <button class="action-btn action-delete" title="Hapus Instansi" onclick="${deleteAction}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </td>
                `;
                tbody.appendChild(tr);
            });
        }
        
        const emptyRowsNeeded = rowsPerPage - pagedList.length;
        for(let i=0; i<emptyRowsNeeded; i++){
            const tr=document.createElement('tr');
            tr.style.height = '48px'; 
            tr.innerHTML = '<td>&nbsp;</td><td style="text-align: center;">&nbsp;</td><td style="text-align: center;">&nbsp;</td><td style="text-align: center;">&nbsp;</td>'; 
            tbody.appendChild(tr);
        }
        const totalInstEl = document.getElementById('totalInstansi');
        if (totalInstEl) totalInstEl.textContent = instansiList.length;
        renderPagination();
    }
    
    function deleteInstansi(id, name) {
        if (confirm(`Apakah Anda yakin ingin menghapus Instansi: "${name}"? Ini adalah simulasi.`)) {
            const index = baseInstansiList.findIndex(i => i.id === id);
            if (index > -1) {
                baseInstansiList.splice(index, 1);
                instansiList = [...baseInstansiList];
                currentPage = 1;
                renderDashboardList();
                alert(`Instansi ${name} (ID: ${id}) telah dihapus (simulasi).`);
            }
        }
    }
    
    function renderPagination(){
        const totalPages=Math.ceil(instansiList.length/rowsPerPage) || 1;
        const p=document.getElementById('pagination');
        if (!p) return;
        p.innerHTML='';

        const prev=document.createElement('button');
        prev.textContent='«';
        prev.disabled=currentPage===1;
        prev.onclick=()=>{
            if(currentPage>1){
                currentPage--;
                renderDashboardList();
            }
        };
        p.appendChild(prev);

        const maxPagesToShow = 5;
        let startPage = Math.max(1, currentPage - Math.floor(maxPagesToShow / 2));
        let endPage = Math.min(totalPages, startPage + maxPagesToShow - 1);

        if (endPage - startPage + 1 < maxPagesToShow) {
            startPage = Math.max(1, endPage - maxPagesToShow + 1);
        }

        for(let i=startPage; i<=endPage; i++){
            const b=document.createElement('button');
            b.textContent=i;
            if(i===currentPage) b.classList.add('active');
            b.onclick=()=>{
                currentPage=i;
                renderDashboardList();
            };
            p.appendChild(b);
        }

        const next=document.createElement('button');
        next.textContent='»';
        next.disabled=currentPage===totalPages;
        next.onclick=()=>{
            if(currentPage<totalPages){
                currentPage++;
                renderDashboardList();
            }
        };
        p.appendChild(next);
    }
    
    // =====================================
    // LOGIKA ASIDE
    // =====================================
    
    // Notifikasi di Sidebar Kanan
    function renderNotifications(){
        const ul=document.getElementById('notificationList');
        if (!ul) return;
        ul.innerHTML='';
        const latestNotifications = notificationDataAside.slice(0, 5);
        latestNotifications.forEach(n=>{
            const li=document.createElement('li');
            li.classList.add('notification-item');
            li.innerHTML=`
                <div class="notification-avatar ${n.avatarClass}">
                    <i class="fa-solid ${n.icon} notif-icon"></i>
                </div>
                <div class="notif-text">${escapeHtml(n.text)}</div>
                <div class="notif-time">${escapeHtml(n.time)}</div>`;
            ul.appendChild(li);
        });
    }
    
    // Jadwal Pelayanan
    function renderScheduleTable() {
        const scheduleKeys = Object.keys(serviceSchedule);
        scheduleKeys.forEach(day => {
            const el = document.getElementById(`schedule-${day}`);
            if (el) {
                el.textContent = serviceSchedule[day];
            }
        });
    }

    // =====================================
    // LOGIKA MODAL
    // =====================================
    let currentInstansiId = null; 

    function openAddModal(){
        currentInstansiId = null; 
        const modal = document.getElementById('modal');
        if(!modal) return;
        document.getElementById('modalTitle').textContent='Tambah Instansi';
        document.getElementById('instName').value='';
        document.getElementById('instServices').value='';
        document.getElementById('instStatus').value='Aktif';
        modal.classList.add('open');
    }

    function closeModal(event){
        const modal = document.getElementById('modal');
        if (!modal) return;
        if (event && event.target.classList.contains('modal-backdrop')) {
            modal.classList.remove('open');
        } else if (!event) { 
            modal.classList.remove('open');
        }
    }
    
    function saveInstansi(){
        const name = document.getElementById('instName').value.trim();
        const services = parseInt(document.getElementById('instServices').value.trim());
        const status = document.getElementById('instStatus').value;

        if (!name || isNaN(services) || services <= 0) {
            alert("Nama Instansi dan Jumlah Layanan harus diisi dengan benar.");
            return;
        }

        if (currentInstansiId === null) {
            const newId = baseInstansiList.length > 0 ? Math.max(...baseInstansiList.map(i => i.id)) + 1 : 1;
            const newInstansi = { id: newId, nama: name, layanan: services, status: status };
            baseInstansiList.push(newInstansi);
            alert(`Instansi "${name}" berhasil ditambahkan.`);
        } 
        
        instansiList = [...baseInstansiList]; 
        renderDashboardList();
        closeModal();
    }
    
    // MODAL JADWAL
    function openEditScheduleModal(){
        const modal = document.getElementById('editScheduleModal');
        const formContent = document.getElementById('scheduleFormContent');
        if(!modal || !formContent) return;

        let htmlContent = '';
        const orderedDays = ["senin", "selasa", "rabu", "kamis", "jumat", "weekend"];
        orderedDays.forEach(day => {
            const dayDisplay = day.charAt(0).toUpperCase() + day.slice(1);
            const labelText = day === 'weekend' ? 'Sabtu, Minggu' : dayDisplay;
            htmlContent += `
                <div class="schedule-form-row" style="display:flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                    <label for="schedule-input-${day}" style="font-weight: 500; width: 120px; flex-shrink: 0;">${labelText}</label>
                    <input type="text" id="schedule-input-${day}" value="${escapeHtml(serviceSchedule[day])}" placeholder="Contoh: 08.00 - 15.00 atau Tutup" style="flex-grow: 1; padding: 8px; border-radius: 6px; border: 1px solid #ddd;" />
                </div>`;
        });
        formContent.innerHTML = htmlContent;
        modal.classList.add('open');
    }

    function closeScheduleModal(event){
        const modal = document.getElementById('editScheduleModal');
        if (!modal) return;
        if (event && event.target.classList.contains('modal-backdrop')) {
            modal.classList.remove('open');
        } else if (!event) { 
            modal.classList.remove('open');
        }
    }

    function saveSchedule() {
        const orderedDays = ["senin", "selasa", "rabu", "kamis", "jumat", "weekend"];
        let newSchedule = {};

        orderedDays.forEach(day => {
            const input = document.getElementById(`schedule-input-${day}`);
            if (input) {
                newSchedule[day] = input.value.trim();
            }
        });
        
        serviceSchedule = newSchedule;
        renderScheduleTable(); 
        closeScheduleModal();
        alert("Jadwal pelayanan berhasil diperbarui.");
    }

    // =====================================
    // LOGIKA CHART
    // =====================================
    let chartInstance = null;
    
    function renderChart() {
        const ctx = document.getElementById('chartLayanan');
        if (!ctx || typeof Chart === 'undefined') return;

        if (chartInstance) {
            chartInstance.destroy();
        }

        chartInstance = new Chart(ctx, {
            type:'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul'],
                datasets: [
                    {
                        label: 'Permintaan Layanan',
                        data: [5, 10, 15, 8, 12, 18, 10],
                        backgroundColor: '#1a73e8',
                        borderRadius: 6,
                        barPercentage: 0.8,
                        categoryPercentage: 0.8
                    },
                    {
                        label: 'Layanan Selesai',
                        data: [4, 9, 14, 7, 11, 17, 9],
                        backgroundColor: '#6b9cf1',
                        borderRadius: 6,
                        barPercentage: 0.8,
                        categoryPercentage: 0.8
                    }
                ]
            },
            options:{
                responsive: true,
                maintainAspectRatio: false,
                plugins:{
                    legend:{position: 'top', display: true},
                    title:{display: false}
                },
                scales:{
                    x: {stacked: false},
                    y: {beginAtZero:true, max: 20, ticks: {stepSize: 5}}
                }
            }
        });
    }

    // =====================================
    // LOGIKA EXPORT
    // =====================================
    function exportInstansiData() {
        if (typeof XLSX === 'undefined' || typeof jspdf.jsPDF === 'undefined' || typeof saveAs === 'undefined') {
            alert('Library yang dibutuhkan untuk Export (SheetsJS/jsPDF/FileSaver) tidak dimuat.');
            return;
        }

        const type = document.getElementById('exportType').value;
        const headers = ["Nama Instansi", "Jumlah Layanan", "Status"];
        const data = [
            headers,
            ...baseInstansiList.map(i => [i.nama, i.layanan.toString(), i.status])
        ];
        const filename = "Data_Instansi_Aktif_Dashboard_" + new Date().toISOString().slice(0, 10);

        if (type === "csv") {
            const csv = data.map(r => r.map(c => `"${c.replace(/"/g, '""')}"`).join(";")).join("\n"); 
            const blob = new Blob([csv], { type: "text/csv;charset=utf-8;" });
            saveAs(blob, filename + ".csv");
        } else if (type === "xlsx") {
            const wb = XLSX.utils.book_new();
            const ws = XLSX.utils.aoa_to_sheet(data);
            XLSX.utils.book_append_sheet(wb, ws, "Instansi");
            XLSX.writeFile(wb, filename + ".xlsx");
        } else if (type === "pdf") {
            const { jsPDF } = jspdf;
            const doc = new jsPDF();
            doc.autoTable({
                head: [headers],
                body: data.slice(1).map(r => [r[0], r[1], r[2]]),
                startY: 10,
                theme: 'striped',
                headStyles: { fillColor: [52, 73, 94] }
            });
            doc.save(filename + ".pdf");
        } else if (type === "word") {
            let tableHtml = `<html><head><meta charset="utf-8"></head><body>
                <h1 style="font-size: 16pt; margin-bottom: 20pt;">${filename.replace(/_/g, ' ')}</h1>
                <table border="1" style="width: 100%; border-collapse: collapse; font-size: 10pt;">`;

            tableHtml += '<thead><tr style="background-color: #f0f0f0;">';
            headers.forEach(h => tableHtml += `<th style="padding: 8px;">${h}</th>`);
            tableHtml += '</tr></thead>';

            tableHtml += '<tbody>';
            data.slice(1).forEach(row => {
                tableHtml += '<tr>';
                row.forEach(cell => tableHtml += `<td style="padding: 8px;">${cell}</td>`);
                tableHtml += '</tr>';
            });
            tableHtml += '</tbody></table></body></html>';

            const blob = new Blob(['\ufeff', tableHtml], { 
                type: 'application/msword' 
            });

            saveAs(blob, filename + ".doc"); 
            
        } else {
            alert(`Export ke format ${type.toUpperCase()} belum didukung.`);
        }
    }

    // =====================================
    // INISIALISASI
    // =====================================
    document.addEventListener("DOMContentLoaded", function() {
        renderChart(); 
        renderDashboardList(); 
        renderNotifications(); 
        renderScheduleTable(); 
    });
    </script>
@endpush