@extends('frontend.layouts.app')

@section('title', 'Survei Kepuasan Masyarakat - MPP Kabupaten Sukoharjo')
@section('meta_description', 'Survei Kepuasan Masyarakat (SKM) Mal Pelayanan Publik Kabupaten Sukoharjo')

@section('content')
    <!-- Hero Header -->
    <section class="py-5 text-center">
        <h1 class="fw-bold" style="font-size:38px;">Survei Kepuasan Masyarakat</h1>

        <div class="mt-5">
            <a href="https://docs.google.com/forms/d/e/1FAIpQLSd7unvBlg8O9-s6Pu9zkw84rwcklbbwAxA8Lm6D3AyuNxKFzg/viewform?usp=header"
               class="btn-survey">Ikuti Survei</a>
        </div>
    </section>

    <section class="py-5" style="background:#f2f2f2;">
        <div class="container py-4" style="background:white; border-radius:12px;">
            <div class="row text-center g-4">
                <div class="col-md-4">
                    <i class="bi bi-check-circle" style="font-size:55px; color:#f4b400;" class="mb-3"></i>
                    <h5 class="fw-bold">Easy</h5>
                    <p>Desain sistem survei yang ringkas dan <em>user friendly</em> memudahkan masyarakat mengisi survei.</p>
                </div>
                <div class="col-md-4">
                    <i class="bi bi-wifi" style="font-size:55px; color:#f4b400;" class="mb-3"></i>
                    <h5 class="fw-bold">Online</h5>
                    <p>SKM <em>Online</em> dapat diakses kapanpun dan dimanapun secara daring.</p>
                </div>
                <div class="col-md-4">
                    <i class="bi bi-clock" style="font-size:55px; color:#f4b400;" class="mb-3"></i>
                    <h5 class="fw-bold">Realtime</h5>
                    <p>Setiap survei yang telah diisi oleh masyarakat akan dikalkulasikan secara <em>realtime</em>.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SKM Content - Empty/To be filled -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="bi bi-clipboard-data display-1 text-muted mb-4"></i>
                        <h3 class="h4 text-muted">Konten sedang dalam pengembangan</h3>
                        <p class="text-muted">Halaman ini akan segera diisi dengan formulir survei kepuasan masyarakat</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
