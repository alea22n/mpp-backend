@extends('layouts.app')

@section('title', 'Pengaturan Sistem - MPP Sukoharjo')

@push('styles')
<style>
    :root {
        --bg: #f6f8fb;
        --card: #ffffff;
        --muted: #7b7b7b;
        --accent: #1a73e8;
        --primary-hover: #155fc1;
        --shadow: 0 6px 18px rgba(20,20,50,0.06);
        --radius: 10px;
    }

    /* PAGE TITLE */
    .page-title {
        font-size: 24px;
        margin-top: 0;
        margin-bottom: 20px;
        color: #444;
        font-weight: 700;
    }

    /* CARD STYLE */
    .card-settings {
        background: var(--card);
        padding: 20px;
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        margin-bottom: 20px;
        border: none;
    }
    .card-settings h3 {
        margin-top: 0;
        border-bottom: 1px solid #eee;
        padding-bottom: 10px;
        margin-bottom: 15px;
        font-size: 17px;
        color: #333;
        font-weight: 600;
    }

    /* FORM STYLING */
    .form-group {
        margin-bottom: 15px;
        display: flex;
        flex-direction: column;
    }
    .form-group label {
        font-size: 13px;
        color: #444;
        margin-bottom: 5px;
        font-weight: 600;
    }
    .form-control-custom {
        padding: 10px 12px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 14px;
        width: 100%;
        max-width: 450px;
        background: white;
        transition: border-color 0.2s;
    }
    .form-control-custom:focus {
        border-color: var(--accent);
        outline: none;
    }
    .form-textarea {
        min-height: 80px;
        max-width: 600px;
    }

    /* TOGGLE SWITCH */
    .toggle-switch {
        position: relative;
        display: inline-block;
        width: 45px;
        height: 25px;
    }
    .toggle-switch input { opacity: 0; width: 0; height: 0; }
    .slider {
        position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0;
        background-color: #ccc; transition: .4s; border-radius: 25px;
    }
    .slider:before {
        position: absolute; content: ""; height: 17px; width: 17px; left: 4px; bottom: 4px;
        background-color: white; transition: .4s; border-radius: 50%;
    }
    input:checked + .slider { background-color: var(--accent); }
    input:checked + .slider:before { transform: translateX(20px); }

    /* PREVIEW IMAGE */
    .preview-img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        margin-top: 10px;
        border: 3px solid #eee;
    }

    /* BUTTONS */
    .btn-custom {
        padding: 10px 16px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        transition: all 0.2s;
        border: none;
    }
    .btn-primary-custom { background: var(--accent); color: white; }
    .btn-primary-custom:hover { background: var(--primary-hover); }
    
    .btn-secondary-custom { background: #e0e0e0; color: #333; }
    .btn-secondary-custom:hover { background: #d5d5d5; }

    .btn-danger { background: #ea4335; color: white; }
    .btn-success { background: #34a853; color: white; }

    @media (max-width: 768px) {
        .form-control-custom { max-width: 100%; }
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <h1 class="page-title">Pengaturan Sistem</h1>

    <form id="settingsForm" action="#" method="POST" enctype="multipart/form-data">
        @csrf
        {{-- 1. Pengaturan Umum --}}
        <div class="card-settings">
            <h3><i class="fa-solid fa-gear me-2"></i> Pengaturan Umum</h3>
            <div class="form-group">
                <label for="systemName">Nama Sistem</label>
                <input type="text" id="systemName" name="system_name" class="form-control-custom" value="MPP Sukoharjo Management" />
                <small style="font-size:11px;color:var(--muted);margin-top:5px;">Nama ini akan muncul di judul halaman dan footer.</small>
            </div>
            <div class="form-group">
                <label for="timezone">Zona Waktu Default</label>
                <select id="timezone" name="timezone" class="form-control-custom">
                    <option value="WIB" selected>WIB (Jakarta)</option>
                    <option value="WITA">WITA (Makassar)</option>
                    <option value="WIT">WIT (Jayapura)</option>
                </select>
            </div>
            <div class="form-group" style="flex-direction:row; align-items:center; justify-content:space-between; max-width:450px;">
                <div style="display:flex; flex-direction:column;">
                    <label style="margin-bottom:0;">Mode Pemeliharaan</label>
                    <small style="font-size:11px; color:#ea4335;">Nonaktifkan akses publik sementara.</small>
                </div>
                <label class="toggle-switch">
                    <input type="checkbox" id="maintenanceMode" name="maintenance_mode">
                    <span class="slider"></span>
                </label>
            </div>
        </div>

        {{-- 2. Keamanan --}}
        <div class="card-settings">
            <h3><i class="fa-solid fa-shield-halved me-2"></i> Keamanan</h3>
            <div class="form-group">
                <label for="loginAttempts">Batas Percobaan Login Gagal (Kali)</label>
                <input type="number" id="loginAttempts" name="login_attempts" class="form-control-custom" value="5" min="1" max="10" style="max-width:120px;"/>
            </div>
        </div>

        {{-- 3. Notifikasi Email --}}
        <div class="card-settings">
            <h3><i class="fa-solid fa-envelope me-2"></i> Notifikasi Email</h3>
            <div class="form-group">
                <label for="senderEmail">Email Pengirim Default</label>
                <input type="email" id="senderEmail" name="sender_email" class="form-control-custom" value="no-reply@mpp-sukoharjo.go.id" />
            </div>
            <div class="form-group">
                <label for="smtpServer">SMTP Server</label>
                <input type="text" id="smtpServer" name="smtp_server" class="form-control-custom" value="smtp.hostinger.com" />
            </div>
            <div class="form-group">
                <label for="emailFooter">Footer Email (Teks singkat)</label>
                <textarea id="emailFooter" name="email_footer" class="form-control-custom form-textarea">Pesan ini dikirim otomatis oleh Sistem MPP Sukoharjo.</textarea>
            </div>
        </div>

        {{-- 4. Manajemen Akun Admin --}}
        <div class="card-settings">
            <h3><i class="fa-solid fa-user-gear me-2"></i> Manajemen Akun Admin</h3>
            <div class="form-group">
                <label for="adminName">Nama Admin</label>
                <input type="text" id="adminName" name="admin_name" class="form-control-custom" value="Admin Utama">
            </div>
            <div class="form-group">
                <label for="adminEmail">Email</label>
                <input type="email" id="adminEmail" name="admin_email" class="form-control-custom" value="admin@mpp-sukoharjo.go.id">
            </div>
            <div class="form-group">
                <label for="adminNewPass">Kata Sandi Baru</label>
                <input type="password" id="adminNewPass" name="password" class="form-control-custom" placeholder="Kosongkan jika tidak ingin mengubah">
            </div>
            <div class="form-group">
                <label for="profileImageInput">Foto Profil</label>
                <input type="file" id="profileImageInput" name="profile_image" class="form-control-custom" accept="image/*">
                <img id="profilePreview" class="preview-img" src="{{ asset('assets/img/default-avatar.png') }}" alt="Preview Foto">
            </div>
        </div>

        {{-- 5. Backup & Reset --}}
        <div class="card-settings">
            <h3><i class="fa-solid fa-database me-2"></i> Backup & Reset Sistem</h3>
            <p style="font-size:14px;color:var(--muted);">Lakukan pencadangan data secara berkala untuk keamanan. Gunakan reset sistem dengan hati-hati.</p>
            <div style="display:flex; gap: 10px;">
                <button type="button" class="btn-custom btn-success" id="backupBtn">
                    <i class="fa-solid fa-download"></i> Backup Data
                </button>
                <button type="button" class="btn-custom btn-danger" id="resetBtn">
                    <i class="fa-solid fa-rotate-left"></i> Reset Sistem
                </button>
            </div>
        </div>

        {{-- Footer Action Buttons --}}
        <div style="display:flex; justify-content:flex-end; gap:10px; margin-top:20px; margin-bottom: 40px;">
            <button type="button" class="btn-custom btn-secondary-custom" onclick="resetSettings()">
                <i class="fa-solid fa-xmark"></i> Batal
            </button>
            <button type="submit" class="btn-custom btn-primary-custom">
                <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const profileImageInput = document.getElementById('profileImageInput');
        const profilePreview = document.getElementById('profilePreview');

        // Preview Foto Profil
        if (profileImageInput) {
            profileImageInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = e => {
                        profilePreview.src = e.target.result;
                        // Opsional: Jika ingin langsung update topbar via JS
                        const topbarImg = document.getElementById('topbarProfileImage');
                        if (topbarImg) topbarImg.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // Backup Button
        document.getElementById('backupBtn').addEventListener('click', () => {
            alert('Proses pencadangan data dimulai... (Simulasi)');
        });

        // Reset Button
        document.getElementById('resetBtn').addEventListener('click', () => {
            if (confirm('PERINGATAN: Apakah Anda yakin ingin mereset sistem? Semua data akan dikembalikan ke pengaturan awal!')) {
                alert('Sistem telah direset. (Simulasi)');
            }
        });

        // Search functionality (Jika sidebar/header menyediakan searchInput)
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('input', e => {
                const q = e.target.value.toLowerCase();
                document.querySelectorAll('.card-settings').forEach(c => {
                    c.style.display = c.textContent.toLowerCase().includes(q) ? 'block' : 'none';
                });
            });
        }
    });

    function resetSettings() {
        if (confirm('Batalkan perubahan dan kembalikan form ke nilai awal?')) {
            document.getElementById('settingsForm').reset();
        }
    }

    // Submit alert simulasi
    document.getElementById('settingsForm').addEventListener('submit', function(e) {
        // e.preventDefault(); // Hapus ini jika sudah siap kirim ke server
        // alert('Perubahan berhasil disimpan!');
    });
</script>
@endpush