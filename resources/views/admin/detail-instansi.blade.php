@extends('layouts.app')

{{-- 1. Judul Halaman --}}
@section('title', 'Detail Instansi – ' . $instansi->nama_instansi)

{{-- 2. Gaya Khusus --}}
@push('styles')
<style>
/* Gaya yang spesifik untuk halaman ini, pastikan tidak ada duplikasi dengan app.blade.php */

/* INSTANSI TITLE */
.instansi-title {
  font-size:22px;
  font-weight:700;
  color:#2b66d9;
  margin-bottom:6px;
}
.instansi-subtitle {
  font-size:15px;
  color:#444;
  margin-top:-2px;
  margin-bottom:20px;
}
/* EDIT TITLE */
.edit-title {
  font-size:16px;
  color:#333;
  font-weight:500;
  margin-top:-8px;
  margin-bottom:20px;
}
/* CARD */
.card {
  background:var(--card);
  padding:20px;
  border-radius:10px;
  box-shadow:var(--shadow);
  margin-bottom:20px;
}
.card h5 {margin-top:0;color:#444;}
.form-section {margin-bottom:25px;}
input[type="text"], input[type="email"], input[type="tel"], input[type="url"], select, textarea { 
  width:100%;padding:9px;border-radius:8px;border:1px solid #ddd;margin-bottom:10px;
}
.custom-file {display:flex;align-items:center;gap:8px;}
.custom-file input[type="file"] {flex:1;}
small.form-text {color:var(--muted);font-size:12px;}

/* LOGO PREVIEW */
.logo-preview-container {
  margin-bottom: 15px;
  border: 1px dashed #ddd;
  padding: 10px;
  border-radius: 8px;
  max-width: 250px;
  min-height: 100px;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
}
#logoPreview, #geraiPhotoPreview {
  max-width: 100%;
  max-height: 150px;
  display: {{ $instansi->logo_url ? 'block' : 'none' }}; 
}

/* BUTTONS */
.btn {
  border:none;border-radius:8px;padding:8px 14px;
  font-size:13px;cursor:pointer;transition:0.2s;
}
.btn.primary {background:var(--accent);color:#fff;}
.btn.success {background:#34a853;color:#fff;}
.btn.danger {background:#ea4335;color:#fff;}
.btn:hover {opacity:0.9;}
.btn.btn-small {
  padding: 5px 8px;
  font-size: 11px;
  white-space: nowrap;
}

/* LAYANAN TABLE */
.service-table {
  width:100%;border-collapse:collapse;margin-bottom:12px;
  table-layout: fixed;
}
.service-table th, .service-table td {
  border:1px solid #ddd;padding:8px;text-align:left;font-size:14px;
  vertical-align: middle;
}
.service-table th {background:#f3f6ff;color:#333;}
.service-table tr.selected {background-color:#e1ebff !important;}
.service-actions {
  display:flex;gap:8px;justify-content:flex-end;margin-top:10px;
}
.pdf-upload-container {
  display: flex;
  align-items: center;
  gap: 8px;
  transition: opacity 0.2s ease;
  font-size: 12px;
}
.pdf-upload-container .pdf-filename {
  color: var(--muted);
  flex-grow: 1;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}
</style>
@endpush

{{-- 3. Konten Utama --}}
@section('content')
<div class="instansi-title">{{ $instansi->nama_instansi ?? 'Nama Instansi Tidak Ditemukan' }}</div>
<div class="instansi-subtitle">{{ $instansi->subtitle ?? 'Detail Instansi' }}</div>
<div class="edit-title">Edit Data Instansi</div>

<form action="{{ route('instansi.update', $instansi->slug) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')

    {{-- CARD 1: Logo Instansi --}}
    <div class="card">
        <h5>Unggah Logo Instansi</h5>
        <div class="form-section">
            <div class="logo-preview-container">
                @if ($instansi->logo_url)
                    <img id="logoPreview" src="{{ asset('storage/' . $instansi->logo_url) }}" alt="Pratinjau Logo Instansi" style="display: block;">
                    <span id="previewPlaceholder" style="display: none;">Pilih file untuk pratinjau</span>
                @else
                    <img id="logoPreview" src="#" alt="Pratinjau Logo Instansi" style="display: none;">
                    <span id="previewPlaceholder" style="color:var(--muted); font-size: 14px;">Pilih file untuk pratinjau</span>
                @endif
            </div>

            <div class="custom-file">
                <input type="file" id="logoFile" name="logo_file" accept="image/*" onchange="previewLogo(event)">
            </div>
            <small class="form-text">Maksimum ukuran file 2MB. Logo saat ini: 
                @if($instansi->logo_url)
                    <a href="{{ asset('storage/' . $instansi->logo_url) }}" target="_blank">Lihat</a>
                @else
                    Belum ada
                @endif
            </small>
        </div>
    </div>

    {{-- CARD 2: Informasi Lainnya (Perubahan di sini) --}}
    <div class="card">
        <h5>Informasi Lainnya</h5>
        <div class="form-section">
            <label for="nama_instansi">Nama Instansi</label>
            <input type="text" id="nama_instansi" name="nama_instansi" value="{{ old('nama_instansi', $instansi->nama_instansi ?? '') }}" required>
            
            <label for="subtitle">Subtitle/Kepanjangan</label>
            <input type="text" id="subtitle" name="subtitle" value="{{ old('subtitle', $instansi->subtitle ?? '') }}">

            <label for="alamat">Alamat Instansi</label>
            <textarea id="alamat" name="alamat" rows="3">{{ old('alamat', $instansi->alamat ?? '') }}</textarea>

            <label for="email">Email Instansi</label>
            <input type="email" id="email" name="email" value="{{ old('email', $instansi->email ?? '') }}">

            <label for="kontak">Nomor Telepon Instansi</label>
            <input type="tel" id="kontak" name="kontak" value="{{ old('kontak', $instansi->kontak ?? '') }}">

            <label for="website">Web Instansi (Link)</label>
            <input type="url" id="website" name="website" value="{{ old('website', $instansi->website ?? '') }}" placeholder="Contoh: https://dpmptsp.jatengprov.go.id">
        </div>
    </div>

    {{-- CARD Baru: Sosial Media Instansi --}}
    <div class="card">
        <h5>Sosial Media Instansi</h5>
        <div class="form-section">
            <label for="facebook">Facebook</label>
            <input type="url" id="facebook" name="facebook" value="{{ old('facebook', $instansi->facebook ?? '') }}" placeholder="Link Facebook">

            <label for="instagram">Instagram</label>
            <input type="url" id="instagram" name="instagram" value="{{ old('instagram', $instansi->instagram ?? '') }}" placeholder="Link Instagram">

            <label for="twitter">Twitter</label>
            <input type="url" id="twitter" name="twitter" value="{{ old('twitter', $instansi->twitter ?? '') }}" placeholder="Link Twitter">
        </div>
    </div>

    {{-- CARD 3: Foto Gerai --}}
    <div class="card">
        <h5>Unggah Foto Gerai/Meja Pelayanan</h5>
        <div class="form-section">
            <div class="logo-preview-container">
                @if ($instansi->foto_gerai)
                    <img id="geraiPhotoPreview" src="{{ asset('storage/' . $instansi->foto_gerai) }}" alt="Pratinjau Foto Gerai" style="display: block;">
                    <span id="geraiPlaceholder" style="display: none;">Pilih file untuk pratinjau</span>
                @else
                    <img id="geraiPhotoPreview" src="#" alt="Pratinjau Foto Gerai" style="display: none;">
                    <span id="geraiPlaceholder" style="color:var(--muted); font-size: 14px;">Pilih file untuk pratinjau</span>
                @endif
            </div>

            <div class="custom-file">
                <input type="file" id="geraiPhotoFile" name="foto_gerai_file" accept="image/*" onchange="previewGeraiPhoto(event)">
            </div>
            <small class="form-text">Maksimum ukuran file 5MB. Foto saat ini:
                @if($instansi->foto_gerai)
                    <a href="{{ asset('storage/' . $instansi->foto_gerai) }}" target="_blank">Lihat</a>
                @else
                    Belum ada
                @endif
            </small>
        </div>
    </div>

    <div class="service-actions" style="justify-content: flex-start; margin-bottom: 20px;">
        <button type="submit" class="btn success"><i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan Data Instansi</button>
        <a href="{{ route('kelola-instansi') }}" class="btn primary"><i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Instansi</a>
    </div>

</form>

{{-- CARD 4: Daftar Layanan Instansi --}}
<div class="card">
    <h5>Daftar Layanan Instansi</h5>
    
    <div class="form-section">
        <p style="font-size:13px; color:var(--muted); margin-top:-10px; margin-bottom:15px;">
            Atur dan kelola semua layanan yang disediakan oleh instansi ini di MPP.
            <span style="font-weight:600;">Klik pada baris layanan untuk menghapus atau menambahkan.</span>
        </p>

        <div class="service-actions" style="justify-content: flex-start; margin-top:0; margin-bottom:15px;">
            <button id="addRowBtn" class="btn primary btn-small"><i class="fa-solid fa-plus"></i> Tambah Layanan</button>
            <button id="deleteRowBtn" class="btn danger btn-small" style="display:none;"><i class="fa-solid fa-trash"></i> Hapus Layanan Terpilih</button>
        </div>

        <table class="service-table">
            <thead>
                <tr>
                    <th style="width:5%;">No</th>
                    <th style="width:30%;">Nama Layanan</th>
                    <th style="width:15%;">Biaya</th>
                    <th style="width:15%;">Persyaratan</th>
                    <th style="width:35%;">Dokumen Panduan (PDF)</th>
                </tr>
            </thead>
            <tbody id="serviceTableBody">
                @forelse ($layananList as $index => $layanan)
                    <tr data-index="{{ $index }}" onclick="selectRow(this, {{ $index }})">
                        <td>{{ $index + 1 }}</td>
                        <td><input type="text" name="layanan[{{ $index }}][nama]" value="{{ old('layanan.' . $index . '.nama', $layanan->nama) }}" required></td>
                        <td>
                            <select name="layanan[{{ $index }}][biaya]">
                                <option value="Berbiaya" {{ $layanan->biaya == 'Berbiaya' ? 'selected' : '' }}>Berbiaya</option>
                                <option value="Gratis" {{ $layanan->biaya == 'Gratis' ? 'selected' : '' }}>Gratis</option>
                            </select>
                        </td>
                        <td>
                            <select name="layanan[{{ $index }}][syarat]" onchange="togglePdfUploadVisibility({{ $index }}, this.value)">
                                <option value="Ada Persyaratan" {{ $layanan->syarat == 'Ada Persyaratan' ? 'selected' : '' }}>Ada Persyaratan</option>
                                <option value="Tidak Ada Persyaratan" {{ $layanan->syarat == 'Tidak Ada Persyaratan' ? 'selected' : '' }}>Tidak Ada Persyaratan</option>
                            </select>
                        </td>
                        <td>
                            <div class="pdf-upload-container" id="pdfContainer-{{ $index }}">
                                <input type="file" name="layanan[{{ $index }}][pdf_file]" id="pdfInput-{{ $index }}" accept="application/pdf" style="display:none;" onchange="handlePdfUpload(event, {{ $index }})">
                                <label for="pdfInput-{{ $index }}" class="btn primary btn-small pdf-upload-label" id="pdfLabel-{{ $index }}" title="{{ $layanan->syarat == 'Ada Persyaratan' ? 'Pilih file PDF untuk diunggah' : 'Upload dinonaktifkan karena persyaratan tidak wajib.' }}">
                                    <i class="fa-solid fa-upload"></i> Unggah PDF
                                </label>
                                <span id="pdfFileName-{{ $index }}" class="pdf-filename">
                                    {{ $layanan->layanan_Pdf ? $layanan->layanan_Pdf : 'Belum ada file' }}
                                </span>
                                <input type="hidden" name="layanan[{{ $index }}][layanan_Pdf_existing]" value="{{ $layanan->layanan_Pdf }}">
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; color: var(--muted);">Belum ada layanan yang ditambahkan untuk instansi ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
        <div class="service-actions">
            <button id="saveLayananBtn" type="button" class="btn success"><i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan Layanan</button>
        </div>
    </div>
</div>
@endsection

{{-- 4. Skrip Khusus --}}
@push('scripts')
<script>
    // Inisialisasi daftar layanan dari Blade (Data dari Server)
    let layanan = @json($layananList ?? []);
    let instansiId = {{ $instansi->id }}; 

    // Inisialisasi variabel untuk seleksi baris
    let selectedRow = null;
    let selectedIndex = -1;

    // ===========================================
    // FUNGSI UMUM & PRATINJAU FILE
    // ===========================================
    
    function previewLogo(event) {
        const file = event.target.files[0];
        const logoPreview = document.getElementById('logoPreview');
        const previewPlaceholder = document.getElementById('previewPlaceholder');

        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                logoPreview.src = e.target.result;
                logoPreview.style.display = 'block';
                if (previewPlaceholder) previewPlaceholder.style.display = 'none';
            }
            reader.readAsDataURL(file);
        } else {
            logoPreview.src = '#';
            logoPreview.style.display = 'none';
            if (previewPlaceholder) previewPlaceholder.style.display = 'block';
        }
    }

    function previewGeraiPhoto(event) {
        const file = event.target.files[0];
        const geraiPhotoPreview = document.getElementById('geraiPhotoPreview');
        const geraiPlaceholder = document.getElementById('geraiPlaceholder');

        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                geraiPhotoPreview.src = e.target.result;
                geraiPhotoPreview.style.display = 'block';
                if (geraiPlaceholder) geraiPlaceholder.style.display = 'none';
            }
            reader.readAsDataURL(file);
        } else {
            geraiPhotoPreview.src = '#';
            geraiPhotoPreview.style.display = 'none';
            if (geraiPlaceholder) geraiPlaceholder.style.display = 'block';
        }
    }

    window.togglePdfUploadVisibility = function(index, syaratValue) {
        const container = document.getElementById(`pdfContainer-${index}`);
        const label = document.getElementById(`pdfLabel-${index}`);
        if (!container || !label) return;

        const pdfInput = document.getElementById(`pdfInput-${index}`);

        if (syaratValue === 'Ada Persyaratan') {
            container.style.opacity = '1';
            label.style.pointerEvents = 'auto';
            label.title = 'Pilih file PDF untuk diunggah';
            if (pdfInput && pdfInput.disabled) pdfInput.disabled = false;
        } else {
            container.style.opacity = '0.5';
            label.style.pointerEvents = 'none';
            label.title = 'Upload dinonaktifkan karena persyaratan tidak wajib.';
            if (pdfInput && !pdfInput.disabled) pdfInput.disabled = true;
        }
    }

    window.handlePdfUpload = function(event, index) {
        const file = event.target.files[0];
        const fileNameSpan = document.getElementById(`pdfFileName-${index}`);
        
        if (file) {
            fileNameSpan.textContent = file.name;
        } else {
            const existingName = layanan[index] && layanan[index].layanan_Pdf ? layanan[index].layanan_Pdf : 'Belum ada file';
            fileNameSpan.textContent = existingName;
        }
    }

    // ===========================================
    // FUNGSI PENGELOLAAN LAYANAN (Dinamis)
    // ===========================================

    window.selectRow = function(row, index) {
        const deleteBtn = document.getElementById('deleteRowBtn');
        const isSelected = row.classList.contains('selected');

        document.querySelectorAll('#serviceTableBody tr').forEach(r => r.classList.remove('selected'));
        selectedRow = null;
        selectedIndex = -1;
        deleteBtn.style.display = 'none';

        if (!isSelected) {
            row.classList.add('selected');
            selectedRow = row;
            selectedIndex = index;
            deleteBtn.style.display = 'inline-block';
        }
    }

    document.getElementById('addRowBtn').addEventListener('click', function(e) {
        e.preventDefault();
        const newIndex = document.querySelectorAll('#serviceTableBody tr').length;
        
        const tableBody = document.getElementById('serviceTableBody');
        const row = tableBody.insertRow();
        row.setAttribute('data-index', newIndex);
        
        row.innerHTML = `
            <td>${newIndex + 1}</td>
            <td><input type="text" name="layanan[${newIndex}][nama]" value="" required></td>
            <td>
                <select name="layanan[${newIndex}][biaya]">
                    <option value="Berbiaya">Berbiaya</option>
                    <option value="Gratis" selected>Gratis</option>
                </select>
            </td>
            <td>
                <select name="layanan[${newIndex}][syarat]" onchange="togglePdfUploadVisibility(${newIndex}, this.value)">
                    <option value="Ada Persyaratan">Ada Persyaratan</option>
                    <option value="Tidak Ada Persyaratan" selected>Tidak Ada Persyaratan</option>
                </select>
            </td>
            <td>
                <div class="pdf-upload-container" id="pdfContainer-${newIndex}" style="opacity: 0.5;">
                    <input type="file" name="layanan[${newIndex}][pdf_file]" id="pdfInput-${newIndex}" accept="application/pdf" style="display:none;" onchange="handlePdfUpload(event, ${newIndex})" disabled>
                    <label for="pdfInput-${newIndex}" class="btn primary btn-small pdf-upload-label" id="pdfLabel-${newIndex}" style="pointer-events: none;">
                        <i class="fa-solid fa-upload"></i> Unggah PDF
                    </label>
                    <span id="pdfFileName-${newIndex}" class="pdf-filename">Belum ada file</span>
                    <input type="hidden" name="layanan[${newIndex}][layanan_Pdf_existing]" value="">
                </div>
            </td>
        `;
        row.addEventListener('click', () => selectRow(row, newIndex));
    });

    document.getElementById('deleteRowBtn').addEventListener('click', function(e) {
        e.preventDefault();
        if (selectedRow && confirm(`Yakin ingin menghapus layanan ini?`)) {
            const deleteInput = document.createElement('input');
            deleteInput.type = 'hidden';
            deleteInput.name = `layanan_to_delete[]`;
            const idToDelete = layanan[selectedIndex] ? layanan[selectedIndex].id : 'new';
            deleteInput.value = idToDelete;

            selectedRow.parentElement.appendChild(deleteInput);
            selectedRow.style.display = 'none';
            selectedRow.classList.remove('selected');
            selectedRow = null;
            document.getElementById('deleteRowBtn').style.display = 'none';
        }
    });

    document.getElementById('saveLayananBtn').addEventListener('click', function(e) {
        e.preventDefault();
        if(confirm('Yakin ingin menyimpan semua perubahan layanan?')){
            const form = document.createElement('form');
            form.action = "{{ route('layanan.sync', $instansi->id) }}";
            form.method = 'POST';
            form.enctype = 'multipart/form-data';
            
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            form.appendChild(csrfToken);

            const rows = document.querySelectorAll('#serviceTableBody tr:not([style*="display: none"])');
            rows.forEach((row) => {
                row.querySelectorAll('input, select').forEach(input => {
                    const clonedInput = input.cloneNode(true);
                    clonedInput.value = input.value; 
                    form.appendChild(clonedInput);
                });
            });
            
            document.querySelectorAll('input[name="layanan_to_delete[]"]').forEach(input => {
                form.appendChild(input.cloneNode(true));
            });

            document.body.appendChild(form);
            form.submit();
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        layanan.forEach((item, index) => {
            togglePdfUploadVisibility(index, item.syarat);
        });
    });
</script>
@endpush