@extends('layouts.app')

@section('title', 'Kelola Konten Website - MPP')

@push('styles')
<style>
    :root {
        --bg: #f6f8fb; --card: #ffffff; --muted: #7b7b7b; --accent: #1a73e8;
        --shadow: 0 6px 18px rgba(20, 20, 50, 0.06);
        --radius: 10px;
        --danger: #dc3545;
    }

    .main-content { padding: 22px; }
    .page-title { font-size: 24px; margin-top: 0; margin-bottom: 20px; color: #444; }
    .card { background: var(--card); border-radius: var(--radius); box-shadow: var(--shadow); padding: 18px; }

    /* TABS */
    .tabs { display: flex; gap: 12px; border-bottom: 2px solid #ececec; margin-bottom: 14px; }
    .tab-btn {
        background: transparent; border: none; padding: 10px 14px; cursor: pointer;
        color: #555; font-weight: 600; font-size: 14px; border-bottom: 3px solid transparent;
        transition: 0.3s;
    }
    .tab-btn.active { color: var(--accent); border-bottom-color: var(--accent); }

    /* FORMS */
    .form-row { display: flex; gap: 14px; margin-bottom: 12px; flex-wrap: wrap; }
    .form-col { flex: 1; min-width: 0; }
    label.form-label { display: block; margin-bottom: 6px; font-weight: 600; color: #444; font-size: 14px; }
    
    input[type="text"], textarea, input[type="email"], select, input[type="url"] {
        width: 100%; padding: 10px 12px; border-radius: 8px; border: 1px solid #e6e6e6; font-size: 14px;
    }
    textarea { min-height: 90px; resize: vertical; }

    /* GRID SYSTEM */
    .hero-grid, .profile-media-grid { 
        display: grid; 
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); 
        gap: 16px; 
    }

    .slide-card, .media-upload-card {
        position: relative; background: #fafafa; border-radius: 10px; padding: 15px; border: 1px solid #eee;
    }

    .btn-delete {
        position: absolute; top: 10px; right: 10px; background: var(--danger);
        color: white; border: none; border-radius: 5px; padding: 5px 8px; cursor: pointer; font-size: 12px;
    }

    .image-preview, .video-preview {
        margin-top: 10px; border-radius: 8px; border: 1px solid #e6e6e6; background: #fff;
        height: 150px; display: flex; align-items: center; justify-content: center; overflow: hidden;
    }
    .image-preview img, .video-preview video { max-width: 100%; max-height: 100%; object-fit: contain; }

    .btn-primary {
        display: inline-flex; align-items: center; gap: 8px; background: var(--accent);
        color: #fff; border: none; padding: 10px 16px; border-radius: 8px; cursor: pointer; font-weight: 600;
    }
    
    .social-input-group { margin-bottom: 15px; }
    .social-input-group i { width: 20px; color: var(--accent); margin-right: 5px; }

    .alert { padding: 15px; margin-bottom: 20px; border-radius: 8px; }
    .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
</style>
@endpush

@section('content')
<div class="main-content">
    <h1 class="page-title">Kelola Konten Website</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <section class="card">
        <div class="tabs">
            <button class="tab-btn active" data-target="tab-hero">Hero Carousel</button>
            <button class="tab-btn" data-target="tab-profil">Profil MPP</button>
            <button class="tab-btn" data-target="tab-footer">Footer & Lokasi</button>
        </div>

        {{-- TAB HERO --}}
        <div class="tab-panel" id="tab-hero" data-panel>
            <form action="{{ route('admin.hero.save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                    <h4 style="margin:0;">Banner Unggulan</h4>
                    <button type="button" class="btn-primary" onclick="addSlide()">
                        <i class="fa-solid fa-plus"></i> Tambah Slide
                    </button>
                </div>
                <div class="hero-grid" id="heroGrid"></div>
                <div style="margin-top:20px">
                    <button type="submit" class="btn-primary"><i class="fa-solid fa-save"></i> Simpan Semua Slide</button>
                </div>
            </form>
        </div>

        {{-- TAB PROFIL --}}
        <div class="tab-panel" id="tab-profil" data-panel hidden>
            <form action="{{ route('admin.profil.save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h4 style="margin-bottom: 15px;">Edit Profil & Media MPP</h4>
                
                <label class="form-label">Judul Profil</label>
                <input name="title" type="text" value="{{ old('title', $profil->title) }}">
                
                <label class="form-label" style="margin-top:15px">Deskripsi MPP</label>
                <textarea name="description">{{ old('description', $profil->description) }}</textarea>

                <div class="form-row" style="margin-top:15px">
                    <div class="form-col">
                        <label class="form-label">Visi</label>
                        <textarea name="vision">{{ old('vision', $profil->vision) }}</textarea>
                    </div>
                    <div class="form-col">
                        <label class="form-label">Misi</label>
                        <textarea name="mission">{{ old('mission', $profil->mission) }}</textarea>
                    </div>
                </div>

                <h5 style="margin: 25px 0 15px 0;">Media Profil (3 Gambar & 1 Video)</h5>
                <div class="profile-media-grid">
                    @for ($i = 1; $i <= 3; $i++)
                    <div class="media-upload-card">
                        <label class="form-label">Gambar Profil {{ $i }}</label>
                        <input type="file" name="image_{{ $i }}" accept="image/*" onchange="previewImage(event, 'preview-img-{{ $i }}')">
                        <div class="image-preview" id="preview-img-{{ $i }}">
                            @php $field = "image_path_$i"; @endphp
                            @if($profil->$field)
                                <img src="{{ asset('storage/' . $profil->$field) }}">
                            @else
                                <span style="color:#ccc">Gambar {{ $i }} kosong</span>
                            @endif
                        </div>
                    </div>
                    @endfor

                    <div class="media-upload-card">
                        <label class="form-label">Video Profil (MP4)</label>
                        <input type="file" name="video" accept="video/mp4" onchange="previewVideo(event, 'preview-video')">
                        <div class="video-preview" id="preview-video">
                            @if($profil->video_path)
                                <video controls><source src="{{ asset('storage/' . $profil->video_path) }}" type="video/mp4"></video>
                            @else
                                <span style="color:#ccc">Belum ada video</span>
                            @endif
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-primary" style="margin-top:20px">
                    <i class="fa-solid fa-save"></i> Simpan Profil & Media
                </button>
            </form>
        </div>

        {{-- TAB FOOTER --}}
        <div class="tab-panel" id="tab-footer" data-panel hidden>
            <form action="{{ route('admin.footer.save') }}" method="POST">
                @csrf
                <div class="form-row">
                    {{-- Alamat & Kontak --}}
                    <div class="form-col">
                        <h4 style="margin-bottom: 15px;">Informasi Kontak</h4>
                        <label class="form-label">Alamat Lengkap</label>
                        <textarea name="address">{{ old('address', $footer->address) }}</textarea>
                        
                        <label class="form-label" style="margin-top:10px">Lokasi Kami (Link Google Maps)</label>
                        <input type="url" name="location_url" value="{{ old('location_url', $footer->location_url) }}" placeholder="https://goo.gl/maps/...">

                        <div class="form-row" style="margin-top:10px">
                            <div class="form-col">
                                <label class="form-label">Telepon</label>
                                <input type="text" name="phone" value="{{ old('phone', $footer->phone) }}">
                            </div>
                            <div class="form-col">
                                <label class="form-label">WhatsApp</label>
                                <input type="text" name="whatsapp" value="{{ old('whatsapp', $footer->whatsapp) }}" placeholder="62812345678">
                            </div>
                        </div>

                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email', $footer->email) }}">
                    </div>

                    {{-- Sosial Media --}}
                    <div class="form-col">
                        <h4 style="margin-bottom: 15px;">Media Sosial</h4>
                        <div class="social-input-group">
                            <label class="form-label"><i class="fa-brands fa-facebook"></i> Facebook</label>
                            <input type="url" name="facebook" value="{{ old('facebook', $footer->facebook) }}" placeholder="https://facebook.com/...">
                        </div>
                        <div class="social-input-group">
                            <label class="form-label"><i class="fa-brands fa-instagram"></i> Instagram</label>
                            <input type="url" name="instagram" value="{{ old('instagram', $footer->instagram) }}" placeholder="https://instagram.com/...">
                        </div>
                        <div class="social-input-group">
                            <label class="form-label"><i class="fa-brands fa-youtube"></i> YouTube</label>
                            <input type="url" name="youtube" value="{{ old('youtube', $footer->youtube) }}" placeholder="https://youtube.com/...">
                        </div>
                        <div class="social-input-group">
                            <label class="form-label"><i class="fa-brands fa-twitter"></i> Twitter/X</label>
                            <input type="url" name="twitter" value="{{ old('twitter', $footer->twitter) }}" placeholder="https://twitter.com/...">
                        </div>
                    </div>
                </div>

                <div class="form-row" style="background: #f9f9f9; padding: 15px; border-radius: 8px;">
                    <div class="form-col">
                        <label class="form-label">Jam Operasional (Senin - Kamis)</label>
                        <div style="display: flex; gap: 8px;">
                            <select id="openTimeWeekdays" name="open_weekdays"></select>
                            <select id="closeTimeWeekdays" name="close_weekdays"></select>
                        </div>
                    </div>
                    <div class="form-col">
                        <label class="form-label">Jam Operasional (Jumat)</label>
                        <div style="display: flex; gap: 8px;">
                            <select id="openTimeFriday" name="open_friday"></select>
                            <select id="closeTimeFriday" name="close_friday"></select>
                        </div>
                    </div>
                    <div class="form-col">
                        <label class="form-label">Keterangan Akhir Pekan</label>
                        <input type="text" name="weekend_notes" value="{{ old('weekend_notes', $footer->weekend_notes ?? 'Sabtu - Minggu: Tutup') }}">
                    </div>
                </div>

                <button type="submit" class="btn-primary" style="margin-top:20px">
                    <i class="fa-solid fa-save"></i> Simpan Semua Pengaturan Footer
                </button>
            </form>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    let heroSlides = @json($heroSlides ?? []);
    
    // TABS LOGIC
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.tab-panel').forEach(p => p.hidden = true);
            btn.classList.add('active');
            document.getElementById(btn.dataset.target).hidden = false;
        });
    });

    // HERO RENDER
    function renderSlides() {
        const grid = document.getElementById('heroGrid');
        if (!grid) return;
        grid.innerHTML = '';
        heroSlides.forEach((slide, index) => {
            grid.insertAdjacentHTML('beforeend', `
                <div class="slide-card">
                    <button type="button" class="btn-delete" onclick="deleteSlide(${index})"><i class="fa-solid fa-trash-can"></i></button>
                    <h6 style="margin-bottom:10px;">Slide ${index + 1}</h6>
                    <input type="hidden" name="slides[${index}][id]" value="${slide.id || ''}">
                    <label class="form-label">Judul Utama</label>
                    <input type="text" name="slides[${index}][title]" value="${slide.title || ''}" required>
                    <label class="form-label" style="margin-top:10px">Sub Judul</label>
                    <input type="text" name="slides[${index}][subtitle]" value="${slide.subtitle || ''}">
                    <label class="form-label" style="margin-top:10px">File Gambar</label>
                    <input type="file" name="slides[${index}][image]" accept="image/*" onchange="previewImage(event, 'p-${index}')">
                    <div class="image-preview" id="p-${index}">
                        ${slide.image_url ? `<img src="${slide.image_url}">` : '<span style="color:#ccc">Kosong</span>'}
                    </div>
                </div>
            `);
        });
    }

    function addSlide() { heroSlides.push({ id: null, title: '', subtitle: '', image_url: '' }); renderSlides(); }

    function deleteSlide(index) {
        if (heroSlides.length <= 1) return alert('Minimal harus ada 1 slide.');
        if (confirm('Hapus slide ini?')) { heroSlides.splice(index, 1); renderSlides(); }
    }

    // PREVIEWS
    function previewImage(event, previewId) {
        const file = event.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = e => document.getElementById(previewId).innerHTML = `<img src="${e.target.result}">`;
        reader.readAsDataURL(file);
    }

    function previewVideo(event, previewId) {
        const file = event.target.files[0];
        if (!file) return;
        const url = URL.createObjectURL(file);
        document.getElementById(previewId).innerHTML = `<video controls><source src="${url}" type="video/mp4"></video>`;
    }

    // TIME OPTIONS
    function generateOptions(targetId, start, end, selectedTime) {
        let html = '';
        for (let h = start; h <= end; h++) {
            for (let m of ['00', '30']) {
                let time = `${String(h).padStart(2, '0')}:${m}`;
                let isSelected = (time === selectedTime) ? 'selected' : '';
                html += `<option value="${time}" ${isSelected}>${time} WIB</option>`;
            }
        }
        const el = document.getElementById(targetId);
        if(el) el.innerHTML = html;
    }

    document.addEventListener('DOMContentLoaded', () => {
        renderSlides();
        generateOptions('openTimeWeekdays', 7, 10, "{{ substr($footer->open_weekdays, 0, 5) }}");
        generateOptions('closeTimeWeekdays', 14, 18, "{{ substr($footer->close_weekdays, 0, 5) }}");
        generateOptions('openTimeFriday', 7, 10, "{{ substr($footer->open_friday, 0, 5) }}");
        generateOptions('closeTimeFriday', 10, 15, "{{ substr($footer->close_friday, 0, 5) }}");
    });
</script>
@endpush