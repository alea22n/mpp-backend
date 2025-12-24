<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('beranda') }}">
            <img src="{{ asset('assets/img/LOGOO MPP.png') }}" alt="Logo MPP Sukoharjo" class="navbar-logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link fw-medium text-dark @if(request()->is('/')) active @endif" href="{{ url('/') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-medium text-dark @if(request()->is('profile*')) active @endif" href="{{ url('profile') }}">Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-medium text-dark @if(request()->is('instansi*')) active @endif" href="{{ url('instansi') }}">Instansi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-medium text-dark @if(request()->is('skm*')) active @endif" href="{{ url('skm') }}">SKM</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


