@extends('frontend.layouts.app')

@section('title', 'Profil - MPP Kabupaten Sukoharjo')
@section('meta_description', 'Profil Mal Pelayanan Publik Kabupaten Sukoharjo')

@section('content')
    <!-- Profile Header -->
    <section class="py-5 bg-light">
      <div class="container">
        <h1 class="display-4 fw-bold text-center mb-5"><span style="color: #9d2933 ;">Profil MPP</span> Kabupaten Sukoharjo</h1>
      </div>
    </section>

    <!-- Apa itu MPP Section -->
    <section class="py-5" style="background-color: #7A1E1E ;">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="mpp-photo-grid">
              <!-- Top large image -->
              <div class="grid-main-photo">
                <img src="assets/img/HAL UTAMA.jpg" class="img-fluid rounded shadow" alt="Tampak Depan Gedung MPP Sukoharjo">
              </div>
              <!-- Bottom two smaller images -->
              <div class="grid-secondary-photos">
                <div class="grid-photo-item">
                  <img src="assets/img/LAYANAN.jpg" class="img-fluid rounded shadow" alt="Area Pelayanan MPP Sukoharjo">
                </div>
                <div class="grid-photo-item">
                  <img src="assets/img/PRODUK BATIK.jpg" class="img-fluid rounded shadow" alt="Pojok UMKM Produk Batik dan Kerajinan">
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 text-white">
            <h2 class="display-6 fw-bold mb-4">Apa itu <span style="color: #FFFFFF;">MPP?</span></h2>
            <div class="mb-4">
              <p class="mb-3">
                <strong style="color: #FFFFFF;">Mal Pelayanan Publik (MPP)</strong> adalah konsep pelayanan terpadu satu pintu yang mengintegrasikan berbagai layanan publik dari multiple instansi dalam satu lokasi yang nyaman dan mudah diakses.
              </p>
              <p class="mb-3">
                MPP Sukoharjo hadir sebagai solusi inovatif untuk mempermudah masyarakat dalam mengurus berbagai keperluan administratif tanpa harus berkeliling ke berbagai kantor instansi.
              </p>
              
              <p class="mb-3">
                Wi-Fi Gratis, Pojok Bermain Anak Ramah Difabel, Ruang Laktasi, Ruang Ganti Popok Bayi (Nursery Room), Mushola, dan ATM Center. Selain itu, tersedia juga Pojok Baca, Kafetaria, serta Jalur Landai.
              </p>
              
              <div class="mpp-highlight p-3 bg-white rounded">
                <p class="mb-0 fw-medium" style="color: #30466B;">
                  <i class="bi bi-check-circle me-2" style="color: #30466B;"></i>
                  "Satu Lokasi, Semua Layanan - Mudah, Cepat, dan Terpercaya"
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

<!-- Video Section -->
<section style="background-color: #7A1E1E ; padding: 80px 0 120px 0;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <h2 class="display-6 fw-bold text-center mb-5 text-white">Video Profil MPP</h2>

        <!-- Video Kotak Besar -->
        <div class="shadow-lg rounded-4 overflow-hidden" 
             style="background:#000; height:500px;">

          <video autoplay muted controls 
                 style="width:100%; height:100%; object-fit:cover;">
            <source src="assets/vidio/contoh.mp4" type="video/mp4">
          </video>
        </div>

      </div>
    </div>
  </div>
</section>


    <!-- Building Information Section -->
    <section class="py-5" style="background-color: #f8f9fa; border-radius: 80px 80px 0 0; margin-top: -60px; position: relative;">
      <div class="container" style="padding-top: 40px;">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <h2 class="display-6 fw-bold text-center mb-4"><span style="color: #9d2933 ;">Gedung MPP</span> <span style="color: #000000;">Kab. Sukoharjo</span></h2>
            <div class="text-muted">
              <p class="mb-3">
                <strong>a. Lokasi:</strong> Jl. Abu Tholib Sastrotenoyo No. 378, Kelurahan Jombor, Kecamatan Bendosari, Kabupaten Sukoharjo, Jawa Tengah 57521
              </p>
              <p class="mb-3">
                <strong>b. Luas Persil:</strong> ± 3.600 m² Tanah milik Pemerintah Kabupaten Sukoharjo
              </p>
              <p class="mb-3">
                <strong>c. Bangunan:</strong> Terdiri dari 3 lantai:
              </p>
              <ul class="text-muted mb-3">
                <li><strong>Lantai I:</strong> Area pelayanan perizinan dan ruang tunggu masyarakat</li>
                <li><strong>Lantai II:</strong> Kantor dan ruang pertemuan instansi</li>
                <li><strong>Lantai III:</strong> Ruang penyimpanan arsip dokumen perizinan</li>
              </ul>
              <p class="mb-3">
                <strong>d. Konsep Bangunan:</strong> Mengusung konsep modern dan terbuka, dengan tata ruang efisien yang mendukung pelayanan cepat, nyaman, dan terintegrasi.
              </p>
            </div>
          </div>
          <div class="col-lg-6">
            <img src="assets/img/gedung utama.jpg" class="img-fluid rounded shadow" alt="Gedung MPP Kabupaten Sukoharjo">
          </div>
        </div>
      </div>
    </section>

    <!-- Sarana Prasarana Utama Section -->
    <section class="py-5" style="background-color: #ffffff;">
      <div class="container">
        <h2 class="display-6 fw-bold text-center mb-5">Sarana Prasarana Utama</h2>
        <!-- Content will be added here -->
      </div>
    </section>

    <!-- Sarana Prasarana Kaum Renta Section -->
    <section class="py-5" style="background-color: #ffffff;">
      <div class="container">
        <h2 class="display-6 fw-bold text-center mb-5">Sarana Prasarana Kaum Renta</h2>
        <!-- Content will be added here -->
      </div>
    </section>

    <!-- Sarana Prasarana Penunjang Section -->
    <section class="py-5" style="background-color: #ffffff;">
      <div class="container">
        <h2 class="display-6 fw-bold text-center mb-5">Sarana Prasarana Penunjang</h2>
        <!-- Content will be added here -->
      </div>
    </section>

    <!-- Gambar dan Penjelasan -->
    <section class="py-5" style="background-color: #ffffff;">
      <div class="container">
        <h2 class="display-6 fw-bold text-center mb-5">Gambar dan Penjelasan</h2>
        <!-- Content will be added here -->
      </div>
    </section>
@endsection
