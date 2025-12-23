@extends('layouts.app')

@section('title', 'Pengaduan & Masukan - MPP')

@push('styles')
<style>
    /* Menggunakan variabel warna agar konsisten dengan desain Anda */
    :root {
      --bg: #f6f8fb; --card: #ffffff; --muted: #7b7b7b; --accent: #1a73e8;
      --shadow: 0 6px 18px rgba(20, 20, 50, 0.06);
    }

    .content-box {
      background: var(--card); padding: 20px; border-radius: 10px; box-shadow: var(--shadow);
    }

    .filter-pengaduan {
      display: flex; gap: 10px; align-items: center; margin-bottom: 20px;
      justify-content: space-between; flex-wrap: wrap;
    }

    .filter-pengaduan input[type="text"], .filter-pengaduan select {
      padding: 10px 15px; border-radius: 8px; border: 1px solid #ddd; font-size: 14px; background: white;
    }

    .search-input-text { width: 250px; }

    /* TABLE STYLING */
    .data-table-container { width: 100%; overflow-x: auto; }
    .data-table-container table { width: 100%; border-collapse: collapse; min-width: 900px; margin-top: 10px; }
    .data-table-container thead { background-color: #ea4335; color: #fff; }
    .data-table-container th, .data-table-container td { padding: 12px 10px; text-align: left; border-bottom: 1px solid #f0f0f0; font-size: 14px; }
    
    /* STATUS COLORS */
    .status-text { font-weight: 600; }
    .status-pending { color: #e6a200; }
    .status-diproses { color: #1a73e8; }
    .status-selesai { color: #34a853; }

    /* ACTION BUTTONS */
    .action-btn-group { display: flex; gap: 5px; justify-content: center; }
    .action-btn { border: none; padding: 6px 8px; border-radius: 4px; color: white; cursor: pointer; font-size: 14px; }
    .view-btn { background-color: #1a73e8; }
    .delete-btn { background-color: #ea4335; }

    /* EXPORT STYLING */
    .export-group { display: flex; align-items: center; gap: 10px; }
    .export-btn { background: #1a73e8; color: white; border: none; padding: 8px 12px; border-radius: 8px; cursor: pointer; display: flex; align-items: center; gap: 6px; }

    /* MODAL STYLING */
    .modal {
      display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%;
      background-color: rgba(0,0,0,0.6); justify-content: center; align-items: center;
    }
    .modal-content {
      background-color: #fefefe; padding: 30px; border-radius: 10px; width: 80%; max-width: 600px;
      position: relative; animation: fadeIn 0.3s ease-out;
    }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
    .close-button { position: absolute; top: 15px; right: 25px; font-size: 28px; font-weight: bold; cursor: pointer; }
</style>
@endpush

@section('content')
<div class="content-wrapper">
    <h1 style="font-size:24px; margin-bottom:20px; color:#444;">Pengaduan & Masukan</h1>

    <div class="content-box">
        {{-- FILTER BAR --}}
        <div class="filter-pengaduan">
            <div class="filter-input-group">
                <input type="text" id="filterCari" class="search-input-text" placeholder="Cari nama atau isi...">
                <select id="filterStatus">
                    <option>Semua Status</option>
                    <option>Pending</option>
                    <option>Diproses</option>
                    <option>Selesai</option>
                </select>
            </div>
            <div class="export-group">
                <select id="exportType">
                    <option value="csv">CSV</option>
                    <option value="excel">Excel</option>
                    <option value="pdf">PDF</option>
                </select>
                <button class="export-btn" onclick="exportData()"><i class="fa-solid fa-download"></i> Export</button>
            </div>
        </div>

        {{-- DATA TABLE --}}
        <div class="data-table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pengirim</th>
                        <th>Instansi Tujuan</th>
                        <th>Isi Pengaduan</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="pengaduanTableBody">
                    {{-- Data akan diisi via JavaScript/Foreach Laravel --}}
                    @foreach($pengaduanList as $index => $item)
                    <tr class="complaint-row" data-id="{{ $item['id'] }}">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item['nama'] }}</td>
                        <td>{{ $item['instansi'] }}</td>
                        <td>{{ Str::limit($item['isi'], 30) }}</td>
                        <td>
                            <span class="status-text status-{{ strtolower($item['status']) }}">
                                {{ $item['status'] }}
                            </span>
                        </td>
                        <td>{{ $item['tanggal'] }}</td>
                        <td>
                            <div class="action-btn-group">
                                <button class="action-btn view-btn" onclick="viewDetail({{ json_encode($item) }})">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                                <button class="action-btn delete-btn" onclick="deleteData({{ $item['id'] }}, this)">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL DETAIL --}}
<div id="detailModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal()">&times;</span>
        <h2>Detail Pengaduan</h2>
        <div id="modalBodyContent">
            <p><strong>Nama:</strong> <span id="modalNama"></span></p>
            <p><strong>Instansi:</strong> <span id="modalInstansi"></span></p>
            <p><strong>Status:</strong> <span id="modalStatus"></span></p>
            <p><strong>Tanggal:</strong> <span id="modalTanggal"></span></p>
            <p><strong>Isi:</strong></p>
            <div id="modalIsi" style="background: #f9f9f9; padding: 15px; border-radius: 8px; border: 1px solid #ddd;"></div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
    // FUNGSI SEARCH & FILTER (Client Side)
    document.getElementById('filterCari').addEventListener('input', filterTable);
    document.getElementById('filterStatus').addEventListener('change', filterTable);

    function filterTable() {
        const keyword = document.getElementById('filterCari').value.toLowerCase();
        const status = document.getElementById('filterStatus').value;
        const rows = document.querySelectorAll('.complaint-row');

        rows.forEach(row => {
            const text = row.innerText.toLowerCase();
            const rowStatus = row.querySelector('.status-text').innerText;
            
            const matchSearch = text.includes(keyword);
            const matchStatus = (status === 'Semua Status' || rowStatus === status);

            row.style.display = (matchSearch && matchStatus) ? '' : 'none';
        });
    }

    // VIEW DETAIL MODAL
    function viewDetail(data) {
        document.getElementById('modalNama').innerText = data.nama;
        document.getElementById('modalInstansi').innerText = data.instansi;
        document.getElementById('modalStatus').innerText = data.status;
        document.getElementById('modalTanggal').innerText = data.tanggal;
        document.getElementById('modalIsi').innerText = data.isi;
        
        document.getElementById('detailModal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('detailModal').style.display = 'none';
    }

    // DELETE DATA
    function deleteData(id, btn) {
        if(confirm('Hapus pengaduan ini?')) {
            // Jika menggunakan database, panggil route delete di sini (AJAX)
            btn.closest('tr').remove();
            alert('Data berhasil dihapus dari tampilan.');
        }
    }

    // CLOSE MODAL ON CLICK OUTSIDE
    window.onclick = function(event) {
        const modal = document.getElementById('detailModal');
        if (event.target == modal) closeModal();
    }
</script>
@endpush