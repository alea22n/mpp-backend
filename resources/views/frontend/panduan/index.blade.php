@extends('frontend.layouts.app')

@section('title', 'Panduan Layanan - MPP Kabupaten Sukoharjo')
@section('meta_description', 'Panduan Layanan di Mal Pelayanan Publik Kabupaten Sukoharjo')

@section('content')
    <!-- Banner -->
    <section class="position-relative">
      <img src="assets/img/gedung utama.jpg"
           class="d-block w-100"
           style="height: 280px; object-fit: cover; object-position: center;"
           alt="Gedung Utama MPP Sukoharjo">
      <div class="position-absolute top-0 start-0 w-100 h-100"
           style="background: linear-gradient(rgba(0,0,0,0.55), rgba(0,0,0,0.55));"></div>
      <div class="position-absolute top-50 start-50 translate-middle text-center text-white">
        <h1 class="display-4 fw-bold mb-0">Panduan Layanan</h1>
      </div>
    </section>

<!-- Panduan Alur Pelayanan -->
<div class="timeline-wrapper">
  <!-- BAGIAN PUTIH (Langkah 1–2) -->
  <section class="py-5 bg-white position-relative">
    <div class="container mt-5">
      <h2 class="fw-bold mb-5 text-start" style="color:#C41212;">Panduan Alur Pelayanan</h2>
    </div>
  </section>

  <!-- Satu garis timeline untuk semua langkah -->
  <div class="container position-relative">
    <div class="timeline">

      <!-- Langkah 1 -->
      <div class="timeline-step">
        <div class="timeline-number">1</div>
        <div class="timeline-content" style="background-color:#f9f9f9;">
          <h5 class="fw-bold" style="color:#C41212;">
            <i class="bi bi-file-earmark-text me-2"></i>Persiapan Sebelum Datang
          </h5>
          <p>Sebelum ke MPP, masyarakat disarankan mengecek syarat dokumen dan biaya layanan di menu Instansi / Kategori Layanan, mengambil nomor antrian online agar lebih efisien, dan menyiapkan dokumen asli dan fotokopi yang lengkap. Langkah ini membantu agar proses berjalan lancar tanpa kekurangan berkas.</p>
        </div>
      </div>

      <!-- Langkah 2 -->
      <div class="timeline-step">
        <div class="timeline-number">2</div>
        <div class="timeline-content" style="background-color:#f9f9f9;">
          <h5 class="fw-bold" style="color:#C41212;">
            <i class="bi bi-qr-code me-2"></i>Pengambilan Nomor Antrian
          </h5>
          <p>Setibanya di MPP, ambil nomor antrian di mesin digital jika belum mendaftar online. Pilih instansi dan jenis layanan di layar sentuh. Sistem akan mencetak nomor antrian fisik dan menampilkan loket tujuan. Tersedia petugas front office untuk membantu pengguna baru.</p>
        </div>
      </div>

      <!-- Langkah 3 -->
      <div class="timeline-step bg-light-section">
        <div class="timeline-number">3</div>
        <div class="timeline-content" style="background-color:#f9f9f9;">
          <h5 class="fw-bold" style="color:#C41212;">
            <i class="bi bi-journal-check me-2"></i>Verifikasi Dokumen
          </h5>
          <p>Ketika nomor antrian dipanggil, serahkan berkas ke loket instansi terkait. Petugas akan memeriksa kelengkapan dan keabsahan dokumen. Jika ada kekurangan, pemohon diberi penjelasan dan solusi yang jelas. Prinsip pelayanan di MPP adalah ramah, cepat, dan transparan.</p>
        </div>
      </div>

      <!-- Langkah 4 -->
      <div class="timeline-step bg-light-section">
        <div class="timeline-number">4</div>
        <div class="timeline-content" style="background-color:#f9f9f9;">
          <h5 class="fw-bold" style="color:#C41212;">
            <i class="bi bi-gear me-2"></i>Proses Pelayanan
          </h5>
          <p>Setelah verifikasi, permohonan akan diproses. Beberapa layanan selesai langsung di tempat (one day service) seperti cetak KTP-el. Layanan lain bisa dipantau melalui fitur Cek Status Layanan di website. Sambil menunggu, pengunjung dapat memanfaatkan fasilitas Wi-Fi gratis, ruang tunggu ber-AC, mushola, ruang laktasi, dan area bermain anak.</p>
        </div>
      </div>

      <!-- Langkah 5 -->
      <div class="timeline-step bg-white-section">
        <div class="timeline-number">5</div>
        <div class="timeline-content" style="background-color:#f9f9f9;">
          <h5 class="fw-bold" style="color:#C41212;">
            <i class="bi bi-file-earmark-check me-2"></i>Pengambilan Hasil Dokumen
          </h5>
          <p>Setelah layanan selesai, pengunjung dapat mengambil hasil di loket yang sama atau area pengambilan hasil. Petugas akan memverifikasi identitas penerima dokumen. Untuk layanan online, tersedia notifikasi otomatis status layanan.</p>
        </div>
      </div>

      <!-- Langkah 6 -->
      <div class="timeline-step bg-white-section">
        <div class="timeline-number">6</div>
        <div class="timeline-content" style="background-color:#f9f9f9;">
          <h5 class="fw-bold" style="color:#C41212;">
            <i class="bi bi-star me-2"></i>Pengisian Survei Kepuasan
          </h5>
          <p>Sebagai tahap akhir, isi Survei Kepuasan Masyarakat (SKM) melalui tablet di lokasi atau fitur online. Data survei digunakan untuk meningkatkan mutu pelayanan publik di MPP Sukoharjo.</p>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- ===================== MEKANISME & VIDEO ALUR PELAYANAN ===================== -->
<section class="mekanisme-section py-5" style="background-color:#f8f9fa;">
  <div class="container text-center">
    <h2 class="fw-bold mb-4" style="color:#C41212;">Mekanisme Pelayanan Instansi</h2>

    <!-- Search bar & button -->
    <div class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-3 mb-5">
      <div class="position-relative w-100" style="max-width: 450px;">
        <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
        <input type="text" id="agencySearch" class="form-control ps-5 py-3 shadow-sm"
               placeholder="Cari instansi atau layanan...">
      </div>
      <button class="btn btn-danger rounded-pill px-4 py-2 fw-semibold"
              style="background-color:#C41212; border:none;"
              onclick="window.location.href='instansi.html'">
        Lihat Semua Instansi
      </button>
    </div>
<!-- Hasil instansi -->
<div id="agencyResults" class="row g-4 mt-4 justify-content-center"></div>

<script>
  // Data instansi yang diambil dari instansi.html (ringkas dari 32 data)
  const agencies = [
    { name: "DPMPTSP JAWA TENGAH", logo: "assets/img/DPMPTSP JATENG.png" },
    { name: "UPT B2MI KOTA SEMARANG", logo: "assets/img/BP2MI.png" },
    { name: "UPPD SUKOHARJO", logo: "assets/img/UPPD.png" },
    { name: "POLRES SUKOHARJO", logo: "assets/img/polres.jpg" },
    { name: "KEJAKSAAN SUKOHARJO", logo: "assets/img/KEJAKSAAN.png" },
    { name: "KEMENTERIAN AGAMA SUKOHARJO", logo: "assets/img/KEMENTERIAN AGAMA.png" },
    { name: "PENGADILAN NEGERI SUKOHARJO KELAS IA", logo: "assets/img/PENGADILAN NEGERI.png" },
    { name: "PENGADILAN AGAMA SUKOHARJO", logo: "assets/img/PENGADILAN AGAMA.png" },
    { name: "KPP SUKOHARJO", logo: "assets/img/KPP.png" },
    { name: "LOKA POM SURAKARTA", logo: "assets/img/LOKA POM.png" },
    { name: "PT. TASPEN", logo: "assets/img/TASPEN.png" },
    { name: "BPJS KESEHATAN", logo: "assets/img/BPJS KESEHATAN.png" },
    { name: "BPJS KETENAGAKERJAAN", logo: "assets/img/BPJS KETENAGAKERJAAN.png" },
    { name: "KANTOR PERTANAHAN SUKOHARJO", logo: "assets/img/KANTOR PERTAHANAN.png" },
    { name: "DINKES SUKOHARJO", logo: "assets/img/DINAS KESEHATAN.png" },
    { name: "DISKOPUMDAG SUKOHARJO", logo: "assets/img/DINAS PERDAGANGAN.png" },
    { name: "DPUPR SUKOHARJO", logo: "assets/img/DINAS PEKERJAAN UMUM.png" },
    { name: "DLH SUKOHARJO", logo: "assets/img/DINAS LINGKUNGAN HIDUP.png" },
    { name: "DISDUKCAPIL SUKOHARJO", logo: "assets/img/DUKCAPIL.png" },
    { name: "BKD SUKOHARJO", logo: "assets/img/BKD.png" },
    { name: "DINSOS SUKOHARJO", logo: "assets/img/DINSOS.png" },
    { name: "DISDIK SUKOHARJO", logo: "assets/img/DINAS PENDIDIKAN.png" },
    { name: "KESBANGPOL", logo: "assets/img/BADAN KESATUAN BANGSA DAN POLITIK.png" },
    { name: "DISPUSIP SUKOHARJO", logo: "assets/img/DISPUSIP.png" },
    { name: "DISHUB SUKOHARJO", logo: "assets/img/DISHUB.png" },
    { name: "DISPERNAKER SUKOHARJO", logo: "assets/img/DISPERMAKER.png" },
    { name: "DPPKBP3A SUKOHARJO", logo: "assets/img/DPPKBP3A.png" },
    { name: "DPMPTSP SUKOHARJO", logo: "assets/img/DPMPTSP SUKOHARJO.png" },
    { name: "BANK JATENG", logo: "assets/img/BANK JATENG.png" },
    { name: "BANK BRI", logo: "assets/img/BRI.png" },
    { name: "PDAM TIRTA MAKMUR", logo: "assets/img/TIRTA.png" },
    { name: "PT. PEGADAIAN", logo: "assets/img/PEGADAIAN.png" }
  ];

  const searchInput = document.getElementById("agencySearch");
  const resultsContainer = document.getElementById("agencyResults");

  // Fungsi pencarian
  searchInput.addEventListener("input", function() {
    const query = this.value.toLowerCase();
    resultsContainer.innerHTML = "";

    if (query.length === 0) return;

    const filtered = agencies.filter(agency =>
      agency.name.toLowerCase().includes(query)
    );

    if (filtered.length === 0) {
      resultsContainer.innerHTML = "<p class='text-muted text-center'>Tidak ditemukan instansi yang sesuai.</p>";
      return;
    }

    filtered.forEach(a => {
      const card = `
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="card agency-card h-100 shadow-sm border-0">
            <div class="card-body text-center p-4">
              <img src="${a.logo}" alt="${a.name}" class="agency-logo-new mb-3" style="height:100px; width:auto; object-fit:contain;">
              <h6 class="fw-bold">${a.name}</h6>
              <a href="instansi.html" class="btn btn-outline-danger btn-sm mt-2">Selengkapnya</a>
            </div>
          </div>
        </div>
      `;
      resultsContainer.insertAdjacentHTML("beforeend", card);
    });
  });
</script>

    <!-- Bagian video langsung di bawahnya -->
    <div class="text-start">
      <h2 class="fw-bold mb-4" style="color:#C41212;">Video Alur Pelayanan MPP</h2>
      <div class="ratio ratio-16x9 shadow-sm rounded-3 mx-auto" style="background-color:#333; max-width: 900px;">
          <video autoplay muted controls 
                 style="width:100%; height:100%; object-fit:cover;">
            <source src="assets/vidio/contoh.mp4" type="video/mp4">
          </video>
      </div>
    </div>
  </div>
</section>
@endsection
