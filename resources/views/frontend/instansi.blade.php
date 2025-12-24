@extends('frontend.layouts.app')

@section('title', 'Semua Instansi - MPP Kabupaten Sukoharjo')
@section('meta_description', 'Daftar lengkap semua instansi di Mal Pelayanan Publik Kabupaten Sukoharjo')

@section('content')
    <!-- All Instansi Section -->
    <section class="py-5 bg-light">
      <div class="container">
        <!-- Header with Search -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-5">
          <div>
            <h1 class="display-6 fw-bold mb-2">Semua Instansi Tergabung</h1>
            <p class="text-muted">Daftar lengkap 32 instansi yang tergabung di MPP Sukoharjo</p>
          </div>
          <div class="agency-search mt-3 mt-md-0">
            <input type="text" id="agencySearch" class="form-control" placeholder="Cari instansi atau layanan..." style="min-width: 300px;">
          </div>
        </div>
        
        <!-- All Agencies Grid -->
        <div id="allAgencies">
          <!-- Row 1 -->
          <div class="row g-4 mb-4">
            <div class="col-sm-6 col-lg-3">
              <div class="card agency-card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                  <img src="assets/img/DPMPTSP JATENG.png" class="agency-logo-new mb-3" alt="DPMPTSP JAWA TENGAH" style="height: 100px; width: auto; object-fit: contain;">
                  <h5 class="card-title fw-bold mb-2">DPMPTSP JAWA TENGAH</h5>
                  <p class="text-muted small mb-3">15 Layanan</p>
                  <a href="dpmptsp-jateng.html" class="btn btn-outline-primary btn-sm">Selengkapnya</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="card agency-card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                  <img src="assets/img/BP2MI.png" class="agency-logo-new mb-3" alt="UPT B2MI KOTA SEMARANG" style="height: 100px; width: auto; object-fit: contain;">
                  <h5 class="card-title fw-bold mb-2">UPT B2MI KOTA SEMARANG</h5>
                  <p class="text-muted small mb-3">8 Layanan</p>
                  <a href="upt bp2mi.html" class="btn btn-outline-primary btn-sm">Selengkapnya</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="card agency-card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                  <img src="assets/img/UPPD.png" class="agency-logo-new mb-3" alt="UPPD SUKOHARJO" style="height: 100px; width: auto; object-fit: contain;">
                  <h5 class="card-title fw-bold mb-2">UPPD SUKOHARJO</h5>
                  <p class="text-muted small mb-3">12 Layanan</p>
                  <a href="uppd sukoharjo.html" class="btn btn-outline-primary btn-sm">Selengkapnya</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="card agency-card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                  <img src="assets/img/polres.jpg" class="agency-logo-new mb-3" alt="POLRES SUKOHARJO" style="height: 100px; width: auto; object-fit: contain;">
                  <h5 class="card-title fw-bold mb-2">POLRES SUKOHARJO</h5>
                  <p class="text-muted small mb-3">10 Layanan</p>
                  <a href="polres sukoharjo.html" class="btn btn-outline-primary btn-sm">Selengkapnya</a>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Row 2 -->
          <div class="row g-4 mb-4">
            <div class="col-sm-6 col-lg-3">
              <div class="card agency-card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                  <img src="assets/img/KEJAKSAAN.png" class="agency-logo-new mb-3" alt="KEJAKSAAN SUKOHARJO" style="height: 100px; width: auto; object-fit: contain;">
                  <h5 class="card-title fw-bold mb-2">KEJAKSAAN SUKOHARJO</h5>
                  <p class="text-muted small mb-3">6 Layanan</p>
                  <a href="kejaksaan sukoharjo.html" class="btn btn-outline-primary btn-sm">Selengkapnya</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="card agency-card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                  <img src="assets/img/KEMENTERIAN AGAMA.png" class="agency-logo-new mb-3" alt="KEMENTERIAN AGAMA SUKOHARJO" style="height: 100px; width: auto; object-fit: contain;">
                  <h5 class="card-title fw-bold mb-2">KEMENTERIAN AGAMA SUKOHARJO</h5>
                  <p class="text-muted small mb-3">9 Layanan</p>
                  <a href="kementerian agama.html" class="btn btn-outline-primary btn-sm">Selengkapnya</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="card agency-card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                  <img src="assets/img/PENGADILAN NEGERI.png" class="agency-logo-new mb-3" alt="PENGADILAN NEGERI SUKOHARJO KELAS IA" style="height: 100px; width: auto; object-fit: contain;">
                  <h5 class="card-title fw-bold mb-2">PENGADILAN NEGERI SUKOHARJO KELAS IA</h5>
                  <p class="text-muted small mb-3">7 Layanan</p>
                  <a href="pengadilan negeri kelas IA.html" class="btn btn-outline-primary btn-sm">Selengkapnya</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="card agency-card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                  <img src="assets/img/PENGADILAN AGAMA.png" class="agency-logo-new mb-3" alt="PENGADILAN AGAMA SUKOHARJO" style="height: 100px; width: auto; object-fit: contain;">
                  <h5 class="card-title fw-bold mb-2">PENGADILAN AGAMA SUKOHARJO</h5>
                  <p class="text-muted small mb-3">5 Layanan</p>
                  <a href="pengadilan agama.html" class="btn btn-outline-primary btn-sm">Selengkapnya</a>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Row 3 -->
          <div class="row g-4 mb-4">
            <div class="col-sm-6 col-lg-3">
              <div class="card agency-card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                  <img src="assets/img/KPP.png" class="agency-logo-new mb-3" alt="KPP SUKOHARJO" style="height: 100px; width: auto; object-fit: contain;">
                  <h5 class="card-title fw-bold mb-2">KPP SUKOHARJO</h5>
                  <p class="text-muted small mb-3">8 Layanan</p>
                  <a href="kpp sukoharjo.html" class="btn btn-outline-primary btn-sm">Selengkapnya</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="card agency-card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                  <img src="assets/img/LOKA POM.png" class="agency-logo-new mb-3" alt="LOKA POM SURAKARTA" style="height: 100px; width: auto; object-fit: contain;">
                  <h5 class="card-title fw-bold mb-2">LOKA POM SURAKARTA</h5>
                  <p class="text-muted small mb-3">6 Layanan</p>
                  <a href="loka pom surakarta.html" class="btn btn-outline-primary btn-sm">Selengkapnya</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="card agency-card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                  <img src="assets/img/TASPEN.png" class="agency-logo-new mb-3" alt="PT. TASPEN" style="height: 100px; width: auto; object-fit: contain;">
                  <h5 class="card-title fw-bold mb-2">PT. TASPEN</h5>
                  <p class="text-muted small mb-3">4 Layanan</p>
                  <a href="taspen.html" class="btn btn-outline-primary btn-sm">Selengkapnya</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="card agency-card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                  <img src="assets/img/BPJS KESEHATAN.png" class="agency-logo-new mb-3" alt="BPJS KESEHATAN" style="height: 100px; width: auto; object-fit: contain;">
                  <h5 class="card-title fw-bold mb-2">BPJS KESEHATAN</h5>
                  <p class="text-muted small mb-3">12 Layanan</p>
                  <a href="bpjs kesehatan.html" class="btn btn-outline-primary btn-sm">Selengkapnya</a>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Row 4 -->
          <div class="row g-4 mb-4">
            <div class="col-sm-6 col-lg-3">
              <div class="card agency-card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                  <img src="assets/img/BPJS KETENAGAKERJAAN.png" class="agency-logo-new mb-3" alt="BPJS KETENAGAKERJAAN" style="height: 100px; width: auto; object-fit: contain;">
                  <h5 class="card-title fw-bold mb-2">BPJS KETENAGAKERJAAN</h5>
                  <p class="text-muted small mb-3">9 Layanan</p>
                  <a href="bpjs ketenagakerjaan.html" class="btn btn-outline-primary btn-sm">Selengkapnya</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="card agency-card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                  <img src="assets/img/KANTOR PERTAHANAN.png" class="agency-logo-new mb-3" alt="KANTOR PERTAHANAN SUKOHARJO" style="height: 100px; width: auto; object-fit: contain;">
                  <h5 class="card-title fw-bold mb-2">KANTOR PERTAHANAN SUKOHARJO</h5>
                  <p class="text-muted small mb-3">3 Layanan</p>
                  <a href="kantor pertahanan.html" class="btn btn-outline-primary btn-sm">Selengkapnya</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="card agency-card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                  <img src="assets/img/DINAS KESEHATAN.png" class="agency-logo-new mb-3" alt="DINKES SUKOHARJO" style="height: 100px; width: auto; object-fit: contain;">
                  <h5 class="card-title fw-bold mb-2">DINKES SUKOHARJO</h5>
                  <p class="text-muted small mb-3">15 Layanan</p>
                  <a href="dinkes sukoharjo.html" class="btn btn-outline-primary btn-sm">Selengkapnya</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="card agency-card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                  <img src="assets/img/DINAS PERDAGANGAN.png" class="agency-logo-new mb-3" alt="DISKOPUMDAG SUKOHARJO" style="height: 100px; width: auto; object-fit: contain;">
                  <h5 class="card-title fw-bold mb-2">DISKOPUMDAG SUKOHARJO</h5>
                  <p class="text-muted small mb-3">11 Layanan</p>
                  <a href="diskopumdag.html" class="btn btn-outline-primary btn-sm">Selengkapnya</a>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Row 5 -->
          <div class="row g-4 mb-4">
            <div class="col-sm-6 col-lg-3">
              <div class="card agency-card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                  <img src="assets/img/DINAS PEKERJAAN UMUM.png" class="agency-logo-new mb-3" alt="DPUPR SUKOHARJO" style="height: 100px; width: auto; object-fit: contain;">
                  <h5 class="card-title fw-bold mb-2">DPUPR SUKOHARJO</h5>
                  <p class="text-muted small mb-3">8 Layanan</p>
                  <a href="dpupr.html" class="btn btn-outline-primary btn-sm">Selengkapnya</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="card agency-card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                  <img src="assets/img/DINAS LINGKUNGAN HIDUP.png" class="agency-logo-new mb-3" alt="DLH SUKOHARJO" style="height: 100px; width: auto; object-fit: contain;">
                  <h5 class="card-title fw-bold mb-2">DLH SUKOHARJO</h5>
                  <p class="text-muted small mb-3">7 Layanan</p>
                  <a href="dlh.html" class="btn btn-outline-primary btn-sm">Selengkapnya</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="card agency-card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                  <img src="assets/img/DUKCAPIL.png" class="agency-logo-new mb-3" alt="DISDUKCAPIL SUKOHARJO" style="height: 100px; width: auto; object-fit: contain;">
                  <h5 class="card-title fw-bold mb-2">DISDUKCAPIL SUKOHARJO</h5>
                  <p class="text-muted small mb-3">18 Layanan</p>
                  <a href="disdukcapil.html" class="btn btn-outline-primary btn-sm">Selengkapnya</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="card agency-card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                  <img src="assets/img/BKD.png" class="agency-logo-new mb-3" alt="BKD SUKOHARJO" style="height: 100px; width: auto; object-fit: contain;">
                  <h5 class="card-title fw-bold mb-2">BKD SUKOHARJO</h5>
                  <p class="text-muted small mb-3">5 Layanan</p>
                  <a href="bkd sukoharjo.html" class="btn btn-outline-primary btn-sm">Selengkapnya</a>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Row 6 -->
          <div class="row g-4 mb-4">
            <div class="col-sm-6 col-lg-3">
              <div class="card agency-card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                  <img src="assets/img/DINSOS.png" class="agency-logo-new mb-3" alt="DINSOS SUKOHARJO" style="height: 100px; width: auto; object-fit: contain;">
                  <h5 class="card-title fw-bold mb-2">DINSOS SUKOHARJO</h5>
                  <p class="text-muted small mb-3">6 Layanan</p>
                  <a href="dinsos.html" class="btn btn-outline-primary btn-sm">Selengkapnya</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="card agency-card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                  <img src="assets/img/DINAS PENDIDIKAN.png" class="agency-logo-new mb-3" alt="DISDIK SUKOHARJO" style="height: 100px; width: auto; object-fit: contain;">
                  <h5 class="card-title fw-bold mb-2">DISDIK SUKOHARJO</h5>
                  <p class="text-muted small mb-3">10 Layanan</p>
                  <a href="dinas pendidikan.html" class="btn btn-outline-primary btn-sm">Selengkapnya</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="card agency-card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                  <img src="assets/img/BADAN KESATUAN BANGSA DAN POLITIK.png" class="agency-logo-new mb-3" alt="KESBANGPOL" style="height: 100px; width: auto; object-fit: contain;">
                  <h5 class="card-title fw-bold mb-2">KESBANGPOL</h5>
                  <p class="text-muted small mb-3">4 Layanan</p>
                  <a href="kesbangpol.html" class="btn btn-outline-primary btn-sm">Selengkapnya</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="card agency-card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                  <img src="assets/img/DISPUSIP.png" class="agency-logo-new mb-3" alt="DISPUSIP SUKOHARJO" style="height: 100px; width: auto; object-fit: contain;">
                  <h5 class="card-title fw-bold mb-2">DISPUSIP SUKOHARJO</h5>
                  <p class="text-muted small mb-3">7 Layanan</p>
                  <a href="dispusip.html" class="btn btn-outline-primary btn-sm">Selengkapnya</a>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Row 7 -->
          <div class="row g-4 mb-4">
            <div class="col-sm-6 col-lg-3">
              <div class="card agency-card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                  <img src="assets/img/DISHUB.png" class="agency-logo-new mb-3" alt="DISHUB SUKOHARJO" style="height: 100px; width: auto; object-fit: contain;">
                  <h5 class="card-title fw-bold mb-2">DISHUB SUKOHARJO</h5>
                  <p class="text-muted small mb-3">9 Layanan</p>
                  <a href="dishub.html" class="btn btn-outline-primary btn-sm">Selengkapnya</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="card agency-card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                  <img src="assets/img/DISPERMAKER.png" class="agency-logo-new mb-3" alt="DISPERNAKER SUKOHARJO" style="height: 100px; width: auto; object-fit: contain;">
                  <h5 class="card-title fw-bold mb-2">DISPERNAKER SUKOHARJO</h5>
                  <p class="text-muted small mb-3">8 Layanan</p>
                  <a href="dispernaker.html" class="btn btn-outline-primary btn-sm">Selengkapnya</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="card agency-card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                  <img src="assets/img/DPPKBP3A.png" class="agency-logo-new mb-3" alt="DPPKBP3A SUKOHARJO" style="height: 100px; width: auto; object-fit: contain;">
                  <h5 class="card-title fw-bold mb-2">DPPKBP3A SUKOHARJO</h5>
                  <p class="text-muted small mb-3">5 Layanan</p>
                  <a href="dppkbp3a.html" class="btn btn-outline-primary btn-sm">Selengkapnya</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="card agency-card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                  <img src="assets/img/DPMPTSP SUKOHARJO.png" class="agency-logo-new mb-3" alt="DPMPTSP SUKOHARJO" style="height: 100px; width: auto; object-fit: contain;">
                  <h5 class="card-title fw-bold mb-2">DPMPTSP SUKOHARJO</h5>
                  <p class="text-muted small mb-3">20 Layanan</p>
                  <a href="dpmptsp sukoharjo.html" class="btn btn-outline-primary btn-sm">Selengkapnya</a>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Row 8 -->
          <div class="row g-4">
            <div class="col-sm-6 col-lg-3">
              <div class="card agency-card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                  <img src="assets/img/BANK JATENG.png" class="agency-logo-new mb-3" alt="BANK JATENG" style="height: 100px; width: auto; object-fit: contain;">
                  <h5 class="card-title fw-bold mb-2">BANK JATENG</h5>
                  <p class="text-muted small mb-3">12 Layanan</p>
                  <a href="bank jateng.html" class="btn btn-outline-primary btn-sm">Selengkapnya</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="card agency-card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                  <img src="assets/img/BRI.png" class="agency-logo-new mb-3" alt="BANK BRI" style="height: 100px; width: auto; object-fit: contain;">
                  <h5 class="card-title fw-bold mb-2">BANK BRI</h5>
                  <p class="text-muted small mb-3">8 Layanan</p>
                  <a href="bank bri.html" class="btn btn-outline-primary btn-sm">Selengkapnya</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="card agency-card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                  <img src="assets/img/TIRTA.png" class="agency-logo-new mb-3" alt="PDAM TIRTA MAKMUR" style="height: 100px; width: auto; object-fit: contain;">
                  <h5 class="card-title fw-bold mb-2">PDAM TIRTA MAKMUR</h5>
                  <p class="text-muted small mb-3">6 Layanan</p>
                  <a href="pdam tirta.html" class="btn btn-outline-primary btn-sm">Selengkapnya</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="card agency-card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                  <img src="assets/img/PEGADAIAN.png" class="agency-logo-new mb-3" alt="PT. PEGADAIAN" style="height: 100px; width: auto; object-fit: contain;">
                  <h5 class="card-title fw-bold mb-2">PT. PEGADAIAN</h5>
                  <p class="text-muted small mb-3">4 Layanan</p>
                  <a href="pt penggadaian.html" class="btn btn-outline-primary btn-sm">Selengkapnya</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection

@push('scripts')
    <script src="assets/js/all-instansi.js"></script>
@endpush
