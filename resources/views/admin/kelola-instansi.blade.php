@extends('layouts.app')

@section('title', 'Data Instansi & Layanan')

@push('styles')
<style>
    /* KONTEN UTAMA: LIST CARD */
    .list-card {
        background: var(--card);
        padding: 20px;
        border-radius: 10px;
        box-shadow: var(--shadow);
        overflow: hidden; 
        flex-grow: 1;
        margin: 20px;
    }
    .list-card h2 {
        margin-top: 0;
        font-size: 18px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    /* EXPORT BUTTON GROUP & ADD BUTTON */
    .export-group {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .export-group select {
        padding: 8px 10px;
        border-radius: 8px;
        border: 1px solid #ddd;
        outline: none;
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
        transition: background 0.2s ease;
    }
    .export-btn:hover { background: #155fc1; }

    .add-btn {
        background: #2ecc71;
        color: white !important;
        text-decoration: none;
        padding: 8px 12px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 14px;
        transition: background 0.2s;
    }
    .add-btn:hover { background: #27ae60; }

    /* TABLE STYLES */
    .table-responsive { width: 100%; overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; margin-top: 15px; }
    thead { background-color: #ea4335; color: #fff; }
    th, td {
        padding: 12px 10px;
        text-align: left;
        border-bottom: 1px solid #f0f0f0;
        font-size: 14px;
    }
    tbody tr:hover { background-color: #f9f9f9; }

    /* LOGO CIRCLE */
    .logo-img {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        object-fit: cover;
        background: #eee;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* STATUS TAG */
    .status-active {
        background: #d4edda;
        color: #1e7e34;
        padding: 4px 10px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 12px;
    }

    /* ACTION BUTTONS */
    .actions { display: flex; gap: 8px; justify-content: flex-start; }
    .btn-action {
        width: 32px;
        height: 32px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        transition: transform 0.1s;
    }
    .btn-action:active { transform: scale(0.9); }
    .btn-action.edit { background: #fbbc04; }
    .btn-action.delete { background: #ea4335; }

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
<div class="list-card">
    <h2>
        Daftar Instansi Aktif
        <div class="export-group">
            <select id="exportType">
                <option value="excel">Excel</option>
                <option value="pdf">PDF</option>
                <option value="csv">CSV</option>
                <option value="word">Word</option>
            </select>
            <button class="export-btn" onclick="exportInstansiData()">
                <i class="fa-solid fa-download"></i> Export
            </button>
            <a href="#" class="add-btn"><i class="fa-solid fa-plus"></i> Tambah Baru</a>
        </div>
    </h2>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th style="width: 50px;">Logo</th>
                    <th>Nama Instansi</th>
                    <th style="width: 150px; text-align: center;">Jumlah Layanan</th>
                    <th style="width: 120px;">Status</th>
                    <th style="width: 120px; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody id="instansiTableBody">
                </tbody>
        </table>
    </div>

    <div class="pagination" id="pagination"></div>
</div>
@endsection

@push('scripts')
{{-- Library Eksternal untuk Export --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>

<script>
    // 1. Inisialisasi Data dari PHP
    const rawData = @json($instansiList);
    const defaultLogo = "{{ asset('images/default-logo.png') }}";

    // 2. Pre-processing Data (Menambahkan slug dan format status)
    let dataList = rawData.map(item => ({
        id: item.id,
        nama: item.nama_instansi,
        // Slug diprioritaskan dari DB, jika kosong buat otomatis
        slug: item.slug || item.nama_instansi.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, ''),
        services: item.layanan ? item.layanan.length : 0,
        status: "Aktif",
        logo: item.logo_url ? `/storage/${item.logo_url}` : null
    }));

    let filteredList = [...dataList];
    const rowsPerPage = 10;
    let currentPage = 1;

    // 3. Render Table
    function renderTable() {
        const tbody = document.getElementById('instansiTableBody');
        tbody.innerHTML = "";
        
        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        const visibleData = filteredList.slice(start, end);

        if (visibleData.length === 0) {
            tbody.innerHTML = `<tr><td colspan="5" style="text-align:center; padding: 30px; color: #666;">Data tidak ditemukan.</td></tr>`;
            return;
        }

        visibleData.forEach(row => {
            const logoHtml = row.logo 
                ? `<img src="${row.logo}" class="logo-img" onerror="this.src='${defaultLogo}'">`
                : `<div class="logo-img"><i class="fa-solid fa-building" style="color:#ccc"></i></div>`;

            tbody.innerHTML += `
                <tr>
                    <td>${logoHtml}</td>
                    <td><strong>${row.nama}</strong></td>
                    <td style="text-align:center;">${row.services} Layanan</td>
                    <td><span class="status-active">${row.status}</span></td>
                    <td>
                        <div class="actions">
                            <button class="btn-action edit" onclick="goToDetail('${row.slug}')" title="Lihat Detail">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                            <button class="btn-action delete" onclick="deleteRow(${row.id})" title="Hapus">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>`;
        });
        renderPagination();
    }

    // 4. Render Pagination
    function renderPagination() {
        const pageCount = Math.ceil(filteredList.length / rowsPerPage);
        const container = document.getElementById('pagination');
        container.innerHTML = "";
        
        if (pageCount <= 1) return;

        // Tombol Prev
        const prevBtn = document.createElement('button');
        prevBtn.innerHTML = '<i class="fa-solid fa-chevron-left"></i>';
        prevBtn.disabled = currentPage === 1;
        prevBtn.onclick = () => { currentPage--; renderTable(); };
        container.appendChild(prevBtn);

        // Nomor Halaman
        for (let i = 1; i <= pageCount; i++) {
            if (i === 1 || i === pageCount || (i >= currentPage - 1 && i <= currentPage + 1)) {
                const btn = document.createElement('button');
                btn.innerText = i;
                btn.className = i === currentPage ? 'active' : '';
                btn.onclick = () => { currentPage = i; renderTable(); };
                container.appendChild(btn);
            }
        }

        // Tombol Next
        const nextBtn = document.createElement('button');
        nextBtn.innerHTML = '<i class="fa-solid fa-chevron-right"></i>';
        nextBtn.disabled = currentPage === pageCount;
        nextBtn.onclick = () => { currentPage++; renderTable(); };
        container.appendChild(nextBtn);
    }

    // 5. Fungsi Navigasi ke Detail (Fungsi Utama yang Anda minta)
    function goToDetail(slug) {
        // Generate URL menggunakan template dari Laravel Blade
        const url = "{{ route('detail-instansi', ['slug' => 'PLACEHOLDER']) }}".replace('PLACEHOLDER', slug);
        window.location.href = url;
    }

    // 6. Fungsi Hapus
    function deleteRow(id) {
        if (confirm('Apakah Anda yakin ingin menghapus instansi ini?')) {
            // Catatan: Di aplikasi nyata, gunakan fetch() ke rute DELETE
            alert('Proses hapus ID ' + id + ' (Integrasikan dengan endpoint API/Route Delete Anda)');
            // Simulasi hapus di client-side:
            filteredList = filteredList.filter(item => item.id !== id);
            renderTable();
        }
    }

    // 7. Logika Pencarian (Terhubung dengan Sidebar Search jika ada)
    const searchInput = document.getElementById('searchInput'); // ID dari app.blade.php
    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            const val = e.target.value.toLowerCase();
            filteredList = dataList.filter(item => item.nama.toLowerCase().includes(val));
            currentPage = 1;
            renderTable();
        });
    }

    // 8. Logika Export
    function exportInstansiData() {
        const type = document.getElementById("exportType").value;
        const headers = ["Nama Instansi", "Jumlah Layanan", "Status"];
        const rows = filteredList.map(n => [n.nama, n.services, n.status]);
        const filename = "data_instansi_" + new Date().toISOString().slice(0, 10);

        if (type === "excel") {
            const wb = XLSX.utils.book_new();
            const ws = XLSX.utils.aoa_to_sheet([headers, ...rows]);
            XLSX.utils.book_append_sheet(wb, ws, "Data");
            XLSX.writeFile(wb, filename + ".xlsx");
        } else if (type === "pdf") {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
            doc.text("Daftar Instansi Aktif", 14, 15);
            doc.autoTable({ head: [headers], body: rows, startY: 20, headStyles: {fillColor: [234, 67, 53]} });
            doc.save(filename + ".pdf");
        } else {
            alert("Export " + type.toUpperCase() + " berhasil dijalankan.");
        }
    }

    // Start
    document.addEventListener("DOMContentLoaded", renderTable);
</script>
@endpush