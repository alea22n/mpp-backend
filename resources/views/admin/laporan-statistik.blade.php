@extends('layouts.app')

@section('title', 'Laporan Statistik - MPP Sukoharjo')

@push('styles')
<style>
/* =====================================
    GAYA KONSISTEN DASHBOARD (TETAP)
    ===================================== */
:root {
    --accent: #1a73e8;
    --card: #ffffff;
    --shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    --muted: #666;
    --error: #ea4335; /* Merah MPP */
}

/* ... (Gaya CSS untuk Grid, Card, Icon, List-Card, Table-Controls, Data-Table, Buttons Dihilangkan agar fokus pada Pagination) ... */

/* Grid & KPI Cards */
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
    width: 45px; height: 45px; border-radius: 50%; color: #fff;
    display: flex; align-items: center; justify-content: center; font-size: 18px;
}
.list-card {
    background: var(--card);
    padding: 20px 20px 0 20px; 
    border-radius: 10px;
    box-shadow: var(--shadow);
    margin-bottom: 20px;
}
.table-controls {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 15px;
    margin-bottom: 15px;
    border-bottom: 1px solid #f0f0f0;
    flex-wrap: wrap;
    gap: 15px;
}
.filter-group-inline { display: flex; align-items: center; gap: 10px; }
.filter-group-inline label { font-size: 13px; font-weight: 600; color: #444; }
.filter-group-inline input, .filter-group-inline select { 
    padding: 6px 10px; border-radius: 8px; border: 1px solid #ddd; font-size: 13px; 
}
.data-table { width: 100%; border-collapse: collapse; }
.data-table thead th {
    background-color: var(--error);
    color: #fff; padding: 12px; text-align: left; font-size: 13px; font-weight: 600;
}
.data-table td {
    border-bottom: 1px solid #f0f0f0; padding: 12px; font-size: 13px; color: #333;
}
.btn-mpp {
    padding: 8px 14px; border-radius: 8px; border: none; cursor: pointer;
    font-size: 13px; font-weight: 500; display: flex; align-items: center; gap: 6px;
    transition: 0.2s;
}
.btn-blue { background: var(--accent); color: white; }
.btn-green { background: #34a853; color: white; }
.btn-mpp:hover { opacity: 0.9; }

/* =====================================
    GAYA PAGINATION YANG DIPERBAIKI (Gambar 1 + Gambar 2 Layout)
    ===================================== */
.pagination-wrapper-grid {
    display: flex; /* Menggantikan .pagination-footer lama */
    justify-content: space-between; 
    align-items: center;
    padding: 15px 0; 
    font-size: 14px;
    color: var(--muted);
    border-top: 1px solid #eee;
    margin-top: 10px;
    flex-wrap: wrap; 
    gap: 10px;
}

/* Ringkasan Informasi */
.pagination-info { 
    font-size: 13px; 
    color: var(--muted); 
    text-align: left; /* Pastikan di kiri */
}

/* Container Link Navigasi */
.pagination-nav {
    display: flex;
    justify-content: flex-end; /* Dorong tombol ke kanan */
}
.pagination-nav nav {
    /* Container utama yang dihasilkan oleh Laravel links() */
    display: block; 
}

/* Mengatur UL/OL */
.pagination-nav .pagination { 
    display: flex; 
    margin: 0; 
    padding: 0;
    list-style: none;
    align-items: center;
}

/* Target item list (li) */
.pagination-nav .page-item {
    margin: 0 4px; 
}

/* Target tautan/span (a atau span) untuk menciptakan tombol membulat (Gambar 1) */
.pagination-nav .page-link,
.pagination-nav .page-item span { 
    background: #fff;
    border: 1px solid #ddd;
    padding: 8px 14px; 
    border-radius: 12px; /* Sudut sangat membulat, sesuai Gambar 1 */
    cursor: pointer;
    font-size: 14px;
    min-width: 40px; 
    text-align: center;
    transition: all 0.2s;
    color: var(--muted);
    text-decoration: none;
    display: inline-block;
    line-height: 1.2;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05); /* Shadow ringan */
}

/* Gaya Active State (Angka 1 di Gambar 1) */
.pagination-nav .page-item.active .page-link,
.pagination-nav .page-item.active span {
    background: var(--accent); /* #1a73e8 */
    color: #fff;
    border-color: var(--accent);
    font-weight: 600;
    box-shadow: 0 4px 8px rgba(26, 115, 232, 0.3); /* Shadow biru yang lebih menonjol */
}

/* Gaya Hover */
.pagination-nav .page-link:hover:not(.active) {
    background: #f0f4ff; 
    border-color: #c0d8ff;
    color: var(--accent);
}

/* Gaya Disabled State */
.pagination-nav .page-item.disabled .page-link,
.pagination-nav .page-item.disabled span {
    cursor: not-allowed;
    opacity: 0.7;
    background: #f9f9f9;
    color: #b0b0b0;
    box-shadow: none;
}
</style>
@endpush

@section('content')
<div class="container-fluid">
    <h2 style="margin-top:0; font-weight:700;">Laporan Data Layanan</h2>
    <p style="font-size: 14px; color: var(--muted); margin-bottom: 25px; margin-top:-10px;">
        DPMPTSP - Periode Aktif: <strong>{{ \Carbon\Carbon::parse($dateFrom)->format('d M Y') }} - {{ \Carbon\Carbon::parse($dateTo)->format('d M Y') }}</strong>
    </p>

    {{-- 1. WIDGETS STATISTIK --}}
    <div class="grid">
        <div class="card small">
            <div><h3>Total Instansi</h3><div class="num">{{ number_format($stats['total_instansi'], 0, ',', '.') }}</div></div>
            <div class="icon-circle" style="background-color: #ea4335;"><i class="fa-solid fa-building"></i></div>
        </div>
        <div class="card small">
            <div><h3>Jenis Layanan</h3><div class="num">{{ number_format($stats['total_layanan'], 0, ',', '.') }}</div></div>
            <div class="icon-circle" style="background-color: #fbbc04;"><i class="fa-solid fa-list-check"></i></div>
        </div>
        <div class="card small">
            <div><h3>Total Permohonan</h3><div class="num">{{ number_format($stats['total_permohonan'], 0, ',', '.') }}</div></div>
            <div class="icon-circle" style="background-color: #1a73e8;"><i class="fa-solid fa-file-invoice"></i></div>
        </div>
        <div class="card small">
            <div><h3>Pengguna Aktif</h3><div class="num">{{ number_format($stats['pengguna_aktif'], 0, ',', '.') }}</div></div>
            <div class="icon-circle" style="background-color: #34a853;"><i class="fa-solid fa-users"></i></div>
        </div>
    </div>

    {{-- 2. CHART BOX --}}
    <div class="list-card">
        <h3 style="margin-top:0; font-size:16px; margin-bottom:15px;">Grafik Permohonan per Instansi</h3>
        <div style="height: 300px;">
            <canvas id="layananChart"></canvas>
        </div>
    </div>

    {{-- 3. TABEL & FILTER BOX --}}
    <div class="list-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3 style="margin:0; font-size:16px;">Detail Data Rekap Instansi</h3>
        </div>

        {{-- FILTER BAR DI ATAS TABEL --}}
        <form action="{{ route('laporan-statistik') }}" method="GET" class="table-controls">
            <div class="filter-group-inline">
                <label>Dari:</label>
                <input type="date" name="date_from" value="{{ $dateFrom }}">
                <label>Sampai:</label>
                <input type="date" name="date_to" value="{{ $dateTo }}">
                <button type="submit" class="btn-mpp btn-green">
                    <i class="fa-solid fa-filter"></i> Filter
                </button>
            </div>
            
            <div class="filter-group-inline">
                <select id="exportType">
                    <option value="excel">Excel (.xlsx)</option>
                    <option value="pdf">PDF (.pdf)</option>
                </select>
                <button type="button" class="btn-mpp btn-blue" onclick="alert('Exporting...')">
                    <i class="fa-solid fa-download"></i> Export
                </button>
            </div>
        </form>

        {{-- DATA TABLE --}}
        <div style="overflow-x: auto;">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 50px; text-align: center;">No.</th>
                        <th>Nama Instansi</th>
                        <th style="text-align: center;">Jml Layanan</th>
                        <th style="text-align: center;">Total Permohonan</th>
                        <th style="text-align: center;">Pengguna Aktif</th>
                        <th>Update Terakhir</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reports as $index => $item)
                    <tr>
                        <td style="text-align: center;">{{ method_exists($reports, 'firstItem') ? ($reports->firstItem() + $index) : ($index + 1) }}</td>
                        <td><strong>{{ $item->nama_instansi }}</strong></td>
                        <td style="text-align: center;">{{ number_format($item->jumlah_layanan, 0, ',', '.') }}</td>
                        <td style="text-align: center;">{{ number_format($item->total_permohonan, 0, ',', '.') }}</td>
                        <td style="text-align: center;">{{ number_format($item->pengguna_aktif, 0, ',', '.') }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->update_terakhir)->format('d/m/Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 40px; color: #999;">Data tidak ditemukan untuk periode ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION BARU: Menggunakan Layout Gambar 2 dengan Styling Gambar 1 --}}
        <div class="pagination-wrapper-grid">
            
            {{-- Bagian Kiri: Ringkasan Informasi --}}
            <div class="pagination-info">
                @if(method_exists($reports, 'firstItem'))
                    Menampilkan 
                    {{ $reports->firstItem() }} - {{ $reports->lastItem() }} dari {{ $reports->total() }} data
                @else
                    Menampilkan {{ $reports->count() }} data
                @endif
            </div>

            {{-- Bagian Kanan: Link Navigasi Tombol --}}
            <div class="pagination-nav">
                @if(method_exists($reports, 'links'))
                    {{-- Tombol pagination Laravel akan di-render di sini --}}
                    {!! $reports->links() !!}
                @endif
            </div>
            
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('layananChart').getContext('2d');
        
        // Ambil filter tanggal dari variabel PHP
        const dateFrom = '{{ $dateFrom }}';
        const dateTo = '{{ $dateTo }}';

        fetch(`/api/report/chart-data?date_from=${dateFrom}&date_to=${dateTo}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (!data || data.length === 0) {
                     ctx.canvas.parentNode.innerHTML = '<p style="text-align:center; color:#999; padding:50px;">Tidak ada data grafik untuk periode ini.</p>';
                     return;
                }

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.map(item => item.label),
                        datasets: [{
                            label: 'Total Permohonan',
                            data: data.map(item => item.value),
                            backgroundColor: '#1a73e8',
                            borderRadius: 5,
                            barThickness: 20
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        indexAxis: 'y', // Membuat Bar Chart Horizontal
                        plugins: { legend: { display: false } },
                        scales: {
                            x: { 
                                beginAtZero: true, 
                                grid: { display: false },
                                ticks: {
                                    // Pastikan label sumbu X adalah integer
                                    callback: function(value) {
                                        if (value % 1 === 0) {
                                            return value;
                                        }
                                    }
                                }
                            },
                            y: { 
                                grid: { display: false } 
                            }
                        }
                    }
                });
            })
            .catch(error => {
                console.error('Error fetching chart data:', error);
                ctx.canvas.parentNode.innerHTML = '<p style="text-align:center; color:var(--error); padding:50px;">Gagal memuat data grafik.</p>';
            });
    });
</script>
@endpush