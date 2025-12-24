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
            <p class="text-muted">Daftar lengkap {{ $institutes->count() }} instansi yang tergabung di MPP Sukoharjo</p>
          </div>
          <div class="agency-search mt-3 mt-md-0">
            <input type="text" id="agencySearch" class="form-control" placeholder="Cari instansi atau layanan..." style="min-width: 300px;">
          </div>
        </div>
        
        <!-- All Agencies Grid -->
        <div id="allAgencies">
          <!-- Row 1 -->
          <div class="row g-4 mb-4">
            @foreach ($institutes as $institute)
            <div class="col-sm-6 col-lg-3">
              <div class="card agency-card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                  <img src="{{ asset('storage/' . $institute->logo_url) }}" class="agency-logo-new mb-3" alt="{{ $institute->name }}" style="height: 100px; width: auto; object-fit: cover;">
                  <h5 class="card-title fw-bold mb-2">{{ $institute->nama_instansi }}</h5>
                  <p class="text-muted small mb-3">{{ $institute->layanan->count() ?? 0 }} Layanan</p>
                  <a href="{{ route('instansi.show', $institute->slug) }}" class="btn btn-outline-primary btn-sm">Selengkapnya</a>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </section>
@endsection

@push('scripts')
    <script src="assets/js/all-instansi.js"></script>
@endpush
