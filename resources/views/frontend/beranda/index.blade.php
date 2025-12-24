@extends('frontend.layouts.app')

@section('title', 'MPP Kabupaten Sukoharjo')
@section('meta_description', 'Mal Pelayanan Publik Kabupaten Sukoharjo')

@section('content')
    <!-- Hero Carousel Dinamis -->
    <section id="beranda" class="position-relative">
      <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
        <div class="carousel-indicators">
          @foreach($hero_slides as $key => $slide)
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $key }}" class="@if($key == 0) active @endif" @if($key == 0) aria-current="true" @endif aria-label="Slide {{ $key+1 }}"></button>
          @endforeach
        </div>
        <div class="carousel-inner">
          @foreach($hero_slides as $key => $slide)
            <div class="carousel-item @if($key == 0) active @endif">
              <img src="{{ asset($slide->image ?? 'assets/img/default.jpg') }}" class="d-block w-100 carousel-image" alt="{{ $slide->title ?? 'Hero Slide' }}">
              <div class="carousel-caption-overlay">
                <div class="container">
                  <div class="row justify-content-center text-center">
                    <div class="col-lg-10">
                      <h1 class="display-4 fw-bold mb-3">{{ $slide->title ?? '' }}</h1>
                      <p class="hero-tagline h4 fw-normal mb-4 text-white" style="font-style: italic;">{{ $slide->subtitle ?? '' }}</p>
                      <div class="hero-cta-buttons">
                        <a href="#profil" class="btn btn-light btn-lg me-3 mb-2">Selengkapnya</a>
                        <a href="#instansi" class="btn btn-outline-light btn-lg mb-2">Cek Layanan</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </section>

    <!-- Quick Action Buttons -->
    <section class="py-5 bg-light quick-action-buttons">
      <div class="container">
        <div class="row g-4">
          <div class="col-12 col-md-4">
            <div class="action-button-card text-center p-4 h-100 fade-slide-left">
              <div class="action-icon mb-3">
                <i class="bi bi-calendar-check display-4 text-primary"></i>
              </div>
              <h3 class="h5 fw-bold mb-2">Antrian Online</h3>
              <p class="text-muted mb-3">Ambil nomor antrian dari rumah tanpa perlu datang dulu</p>
              <a href="#" class="btn btn-primary btn-lg w-100">Ambil Nomor</a>
            </div>
          </div>
          <div class="col-12 col-md-4">
            <div class="action-button-card text-center p-4 h-100 fade-slide">
              <div class="action-icon mb-3">
                <i class="bi bi-file-text display-4 text-success"></i>
              </div>
              <h3 class="h5 fw-bold mb-2">Panduan Layanan</h3>
              <p class="text-muted mb-3">Lihat panduan dan prosedur layanan MPP</p>
              <a href="{{ url('panduan') }}" class="btn btn-success btn-lg w-100">Lihat Panduan</a>
            </div>
          </div>
          <div class="col-12 col-md-4">
            <div class="action-button-card text-center p-4 h-100 fade-slide">
              <div class="action-icon mb-3">
                <i class="bi bi-star display-4 text-warning"></i>
              </div>
              <h3 class="h5 fw-bold mb-2">Survei Kepuasan</h3>
              <p class="text-muted mb-3">Berikan penilaian untuk meningkatkan layanan kami</p>
              <a href="#" class="btn btn-warning btn-lg w-100">Isi Survei</a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Profil -->
    <section id="profil" class="py-5">
      <div class="container">
        <!-- Penjelasan Singkat MPP -->
        <div class="row align-items-center mb-5">
          <div class="col-lg-6 fade-slide-left">
            <h2 class="display-6 fw-bold mb-4">
              @if($webProfile && $webProfile->title)
                {!! str_replace('MPP?', '<span style="color: #C41212;">MPP?</span>', e($webProfile->title)) !!}
              @else
                Apa itu <span style="color: #C41212;">MPP?</span>
              @endif
            </h2>
            <div class="mb-4">
              @if($webProfile && $webProfile->description)
                <p class="text-muted mb-3">
                  {!!
                    preg_replace(
                      '/Mal Pelayanan Publik \(MPP\)/',
                      '<strong style="color: #C41212;">Mal Pelayanan Publik (MPP)</strong>',
                      nl2br(e($webProfile->description))
                    )
                  !!}
                </p>
              @else
                <p class="text-muted mb-3">
                  <strong style="color: #C41212;">Mal Pelayanan Publik (MPP)</strong> adalah konsep pelayanan terpadu satu pintu yang mengintegrasikan berbagai layanan publik dari multiple instansi dalam satu lokasi yang nyaman dan mudah diakses.
                </p>
                <p class="text-muted mb-3">
                  MPP Sukoharjo hadir sebagai solusi inovatif untuk mempermudah masyarakat dalam mengurus berbagai keperluan administratif tanpa harus berkeliling ke berbagai kantor instansi.
                </p>
                <p class="text-muted mb-3">
                  Wi-Fi Gratis, Pojok Bermain Anak Ramah Difabel, Ruang Laktasi, Ruang Ganti Popok Bayi (Nursery Room), Mushola, dan ATM Center. Selain itu, tersedia juga Pojok Baca, Kafetaria, serta Jalur Landai.
                </p>
              @endif
              <div class="mpp-highlight p-3 bg-light rounded">
                <p class="mb-0 fw-medium" style="color: #30466B;">
                  <i class="bi bi-check-circle me-2" style="color: #30466B;"></i>
                  "Satu Lokasi, Semua Layanan - Mudah, Cepat, dan Terpercaya"
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-6 fade-slide">
            <div class="mpp-photo-grid">
              <!-- Top large image -->
              <div class="grid-main-photo">
                <img src="{{ $webProfile && $webProfile->image_path_1 ? asset('storage/' . $webProfile->image_path_1) : asset('assets/img/HAL UTAMA.jpg') }}" class="img-fluid rounded shadow" alt="Tampak Depan Gedung MPP Sukoharjo">
              </div>
              <!-- Bottom two smaller images -->
              <div class="grid-secondary-photos">
                <div class="grid-photo-item">
                  <img src="{{ $webProfile && $webProfile->image_path_2 ? asset('storage/' . $webProfile->image_path_2) : asset('assets/img/LAYANAN.jpg') }}" class="img-fluid rounded shadow" alt="Area Pelayanan MPP Sukoharjo">
                </div>
                <div class="grid-photo-item">
                  <img src="{{ $webProfile && $webProfile->image_path_3 ? asset('storage/' . $webProfile->image_path_3) : asset('assets/img/PRODUK BATIK.jpg') }}" class="img-fluid rounded shadow" alt="Pojok UMKM Produk Batik dan Kerajinan">
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Visi Misi -->
        <div class="row mb-5">
          <div class="col-lg-6 mb-4 fade-slide-left">
            <div class="vision-mission-card h-100 p-4 text-white rounded" style="background-color: #30466B;">
              <div class="d-flex align-items-center mb-3">
                <i class="bi bi-eye display-6 me-3"></i>
                <h3 class="h4 fw-bold mb-0">Visi</h3>
              </div>
              <p class="mb-0">
                @if($webProfile && $webProfile->vision)
                  {!! nl2br(e($webProfile->vision)) !!}
                @else
                  Mewujudkan pelayanan publik yang prima, transparan, dan terintegrasi untuk meningkatkan kepuasan masyarakat Kabupaten Sukoharjo.
                @endif
              </p>
            </div>
          </div>
          <div class="col-lg-6 mb-4 fade-slide">
            <div class="vision-mission-card h-100 p-4 text-white rounded" style="background-color: #E32238;">
              <div class="d-flex align-items-center mb-3">
                <i class="bi bi-target display-6 me-3"></i>
                <h3 class="h4 fw-bold mb-0">Misi</h3>
              </div>
              @if($webProfile && $webProfile->mission)
                <ul class="mb-0 ps-3">
                  @foreach(preg_split('/\r?\n/', $webProfile->mission) as $misi)
                    @if(trim($misi) !== '')
                      <li>{!! e($misi) !!}</li>
                    @endif
                  @endforeach
                </ul>
              @else
                <ul class="mb-0 ps-3">
                  <li>Memberikan pelayanan satu pintu yang efisien dan berkualitas</li>
                  <li>Meningkatkan koordinasi antar instansi pemerintah</li>
                  <li>Mengoptimalkan pemanfaatan teknologi informasi</li>
                  <li>Menciptakan lingkungan pelayanan yang nyaman dan aman</li>
                </ul>
              @endif
            </div>
          </div>
        </div>
        
        <!-- Manfaat MPP -->
        <div class="row">
          <div class="col-12">
            <h3 class="h4 fw-bold mb-4 text-center fade-up-title">
              Manfaat MPP bagi Masyarakat</h3>
            <div class="row g-4">
              <div class="col-md-6 col-lg-3">
                <div class="benefit-card text-center p-3 fade-up-item">
                  <i class="bi bi-clock-history display-6 text-primary mb-2"></i>
                  <h4 class="h6 fw-bold">Hemat Waktu</h4>
                  <p class="small text-muted mb-0">Satu lokasi untuk berbagai layanan</p>
                </div>
              </div>
              <div class="col-md-6 col-lg-3">
                <div class="benefit-card text-center p-3 fade-up-item">
                  <i class="bi bi-shield-check display-6 text-success mb-2"></i>
                  <h4 class="h6 fw-bold">Transparan</h4>
                  <p class="small text-muted mb-0">Proses yang jelas dan mudah dipantau</p>
                </div>
              </div>
              <div class="col-md-6 col-lg-3">
                <div class="benefit-card text-center p-3 fade-up-item">
                  <i class="bi bi-people display-6 text-info mb-2"></i>
                  <h4 class="h6 fw-bold">Pelayanan Prima</h4>
                  <p class="small text-muted mb-0">Petugas profesional dan ramah</p>
                </div>
              </div>
              <div class="col-md-6 col-lg-3">
                <div class="benefit-card text-center p-3 fade-up-item">
                  <i class="bi bi-laptop display-6 text-warning mb-2"></i>
                  <h4 class="h6 fw-bold">Teknologi Modern</h4>
                  <p class="small text-muted mb-0">Sistem digital terintegrasi</p>
                </div>
              </div>
            </div>
            <div class="text-center mt-4 fade-up-more">
              <a href="profile.html" class="d-inline-flex align-items-center text-decoration-none" style="color: #C41212;">
                <i class="bi bi-arrow-right me-2" style="font-size: 1.5rem;"></i>
                <span class="fw-semibold" style="font-size: 1.1rem;">Selengkapnya</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Instansi Tergabung -->
    <section id="instansi" class="py-5 bg-light">
      <div class="container">
        <!-- Header -->
        <div class="text-center mb-5">
          <h2 class="display-6 fw-bold fade-up-instansi-title"><span style="color: #C41212;">Instansi</span> Tergabung</h2>
        </div>
        
        <!-- Instansi Tergabung Dinamis -->
        <div id="initialAgencies" class="mb-5">
          <div class="row g-4">
            @foreach($institutes as $institute)
              <div class="col-sm-6 col-lg-3">
                <div class="card agency-card h-100 shadow-sm border-0 fade-instansi-item">
                  <div class="card-body text-center p-4">
                    <img src="{{ asset('storage/' . $institute->logo_url) }}" class="agency-logo-new mb-3" alt="{{ $institute->nama_instansi ?? 'Instansi' }}" style="height: 100px; width: auto; object-fit: cover;">
                    <h5 class="card-title fw-bold mb-2">{{ $institute->nama_instansi ?? '-' }}</h5>
                    <p class="text-muted small mb-3">{{ $institute->layanan->count() ?? 0 }} Layanan</p>
                    <a href="{{ route('instansi.show', $institute->slug) }}" class="btn btn-outline-primary btn-sm">Selengkapnya</a>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
        
        <!-- View All Button -->
        <div class="text-center mb-4">
          <a href="{{ route('instansi.index') }}" class="btn btn-primary btn-lg px-5 py-3 fade-instansi-more">
            <i class="bi bi-grid me-2"></i>
            Lihat Semua Instansi
          </a>
        </div>
      </div>
    </section>
@endsection

@push('scripts')
    <script src="assets/js/main.js"></script>
@endpush
