{{-- File: resources/views/laporan/statistik/_report_table.blade.php --}}
{{-- Catatan: Pastikan variabel yang dioper dari controller/blade parent adalah $items --}}
<div id="report-table-content">
    {{-- DATA TABLE --}}
    <div style="overflow-x: auto;">
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 50px; text-align: center;">No</th>
                    <th>Nama Instansi</th>
                    <th style="text-align: center;">Jml Layanan</th>
                    <th style="text-align: center;">Total Permohonan</th>
                    <th style="text-align: center;">Pengguna Aktif</th>
                    <th>Update Terakhir</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $index => $item)
                <tr>
                    <td style="text-align: center;">{{ $items->firstItem() + $index }}</td>
                    <td><strong>{{ $item->nama_instansi }}</strong></td>
                    <td style="text-align: center;">{{ $item->jumlah_layanan }}</td>
                    <td style="text-align: center;">{{ number_format($item->total_permohonan, 0, ',', '.') }}</td>
                    <td style="text-align: center;">{{ number_format($item->pengguna_aktif, 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->update_terakhir)->format('d/m/Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 50px; color: #999;">Tidak ada data pada periode ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- PAGINATION TENGAH BAWAH --}}
    <div class="pagination-container">
        <div class="pagination-nav">
            @if(method_exists($items, 'links'))
                {{-- PENTING: Menggunakan custom view pagination yang baru dibuat --}}
                {{ $items->appends(request()->except('page'))->links('pagination::ajax-custom') }}
            @endif
        </div>

        <div class="pagination-text">
            Menampilkan <strong>{{ $items->firstItem() }}</strong> - <strong>{{ $items->lastItem() }}</strong> dari <strong>{{ $items->total() }}</strong> data
        </div>
    </div>
</div>