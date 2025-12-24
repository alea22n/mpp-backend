@extends('frontend.layouts.app')

@section('title', $institutes->nama_instansi . ' - MPP Sukoharjo')
@section('meta_description', 'Halaman ' . $institutes->nama_instansi . ' di MPP Kabupaten Sukoharjo')

@section('content')
    <!-- Bagian Atas Abu -->
    <main>
        <section class="min-vh-100 d-flex align-items-center" style="background-color:#f4f5f7;">
            <div class="container py-5">

                <div class="text-center mb-4">
                    <img src="{{ asset('storage/' . $institutes->logo_url) }}" class="agency-logo-new mb-3" alt="{{ $institutes->nama_instansi }}" style="max-width:200px;width:100%;height:auto;">
                </div>

                <!-- 4 kotak info -->
                <div class="row g-3 g-md-4 justify-content-center mb-4">
                    <div class="col-6 col-md-3">
                        <div class="bg-white rounded-3 shadow-sm p-4 text-center h-100">
                            <i class="bi bi-journal-check display-6 text-danger d-block mb-2"></i>
                            <div class="fw-semibold">Jumlah Layanan</div>
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="bg-white rounded-3 shadow-sm p-4 text-center h-100">
                            <i class="bi bi-window-stack display-6 text-danger d-block mb-2"></i>
                            <div class="fw-semibold">Jumlah Loket</div>
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="bg-white rounded-3 shadow-sm p-4 text-center h-100">
                            <i class="bi bi-people-fill display-6 text-danger d-block mb-2"></i>
                            <div class="fw-semibold">Jumlah Petugas</div>
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="bg-white rounded-3 shadow-sm p-4 text-center h-100">
                            <i class="bi bi-person-badge-fill display-6 text-danger d-block mb-2"></i>
                            <div class="fw-semibold">Jumlah Pemohon</div>
                        </div>
                    </div>
                </div>

                <!-- Daftar layanan -->
                <div class="row mt-4">
                    <div class="col-12 col-xl-10 mx-auto d-flex flex-column gap-3">
                        @foreach($institutes->layanan as $index => $layanan)
                        <div class="d-flex align-items-center justify-content-between bg-body-secondary rounded-3 p-4">
                            <div class="d-flex align-items-start gap-3">
                                <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center"
                                     style="width:60px;height:60px;font-size:20px;">{{ $index+1 }}</div>
                                <div>
                                    <div class="fw-bold fs-5">{{ $layanan->nama }}</div>
                                    <div class="text-muted small">{{ $layanan->jadwal ?? '-' }}</div>
                                    <div class="fw-semibold text-success mt-2">{{ $layanan->biaya ?? 'Gratis' }} {!! $layanan->syarat ? '– '.$layanan->syarat : '– Tidak ada persyaratan' !!}</div>
                                </div>
                            </div>
                            @if($layanan->layananPdf)
                            <button class="btn btn-info text-white px-4"
                                    onclick="window.open('{{ asset('storage/'.$layanan->layananPdf) }}', '_blank')">
                                Persyaratan
                            </button>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- Bagian Putih FULL mulai dari Mekanisme -->
        <div class="mekanisme-wrapper">

            <!-- Mekanisme Pelayanan -->
            <section class="mekanisme-box py-5">
                <div class="container">

                    <div class="mb-4">
                        <a href="{{ asset('storage/' . $institutes->file_mekanisme) }}" target="_blank"
                           class="section-badge text-decoration-none">
                            Mekanisme Pelayanan
                        </a>
                    </div>

                    <div class="row g-4 mt-3">

                        <div class="col-lg-6">
                            <div class="card-red h-100">
                                <div class="card-header">Foto Gerai</div>
                                <div class="p-4 foto-gerai">
                                    <img src="{{ asset('storage/' . $institutes->foto_gerai_url) }}" class="foto-gerai-full" alt="Foto Gerai">
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-6">
                            <div class="card-red h-100">
                                <div class="card-header">Informasi Lain</div>
                                <div class="info-row"><i class="bi bi-buildings fs-5"></i>{{ $institutes->nama_instansi ?? '-' }}<span></span></div>
                                <div class="info-row"><i class="bi bi-envelope fs-5"></i>{{ $institutes->email ?? '-' }}<span></span></div>
                                <div class="info-row"><i class="bi bi-telephone fs-5"></i>{{ $institutes->kontak ?? '-' }}<span></span></div>
                                <a href="{{ $institutes->website }}" target="_blank"
                                   class="info-row info-row-click text-decoration-none">
                                    <i class="bi bi-globe fs-5"></i>
                                    <span>Kunjungi Website</span>
                                </a>

                            </div>
                        </div>
            </section>

            <!-- Sosial Media -->
            <section class="mekanisme-box py-4">
                <div class="container">
                    <div class="row g-4">

                        <div class="col-lg-6">
                            <div class="card-red">
                                <div class="card-header">Sosial Media</div>
                                <a href="{{ $institutes->facebook ?? '#' }}" target="_blank"
                                   class="info-row text-decoration-none text-dark">
                                    <i class="bi bi-facebook fs-5"></i><span>Facebook</span>
                                </a>

                                <a href="{{ $institutes->instagram ?? '#' }}" target="_blank"
                                   class="info-row text-decoration-none text-dark">
                                    <i class="bi bi-instagram fs-5"></i><span>Instagram</span>
                                </a>

                                <a href="{{ $institutes->twitter ?? '#' }}" target="_blank"
                                   class="info-row text-decoration-none text-dark">
                                    <i class="bi bi-twitter fs-5"></i><span>Twitter</span>
                                </a>

                            </div>
                        </div>
            </section>

        </div> <!-- PENUTUP mekanisme-wrapper -->
    </main>
@endsection