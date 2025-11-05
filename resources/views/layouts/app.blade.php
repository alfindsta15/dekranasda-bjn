<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ config('app.name', 'Dekranasda Bojonegoro') }}</title>

  {{-- ✅ Bootstrap --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  {{-- ✅ Custom Style --}}
  <style>
    body {
      background-color: #f6f9fc;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .navbar {
      background: #fff;
      border-bottom: 1px solid #e9eef3;
      box-shadow: 0 4px 10px rgba(0,0,0,0.03);
    }
    .navbar-brand img {
      height: 48px;
      border-radius: 6px;
    }
    .hero {
      background: linear-gradient(135deg, #0284c7, #0369a1);
      color: #fff;
      padding: 4rem 0;
      text-align: center;
    }
    footer {
      background: #f1f8ff;
      border-top: 1px solid #dce9f5;
      padding: 2rem 0;
      font-size: 14px;
      color: #334155;
    }
    .social a {
      color: #0284c7;
      font-size: 20px;
      margin-right: 10px;
      text-decoration: none;
    }
    .social a:hover {
      color: #0369a1;
    }
  </style>

  @stack('head')
</head>

<body>

  {{-- ================= NAVBAR ================= --}}
  <nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
        <img src="{{ asset('images/logo.jpg') }}" alt="Logo Dekranasda">
        <div>
          <div class="fw-semibold text-uppercase" style="font-size: 11px; color:#475569;">Dewan Kerajinan Nasional Daerah</div>
          <div class="fw-bold" style="font-size: 16px; color:#111827;">Kabupaten Bojonegoro</div>
        </div>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav align-items-lg-center gap-lg-2">
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active fw-semibold text-primary' : '' }}" href="{{ route('home') }}">Beranda</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ request()->is('profil*') ? 'active fw-semibold text-primary' : '' }}" href="#" data-bs-toggle="dropdown">Profil</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{ route('profil.visimisi') }}">Visi & Misi</a></li>
              <li><a class="dropdown-item" href="{{ route('profil.struktur') }}">Struktur Organisasi</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ request()->is('binaan*') ? 'active fw-semibold text-primary' : '' }}" href="#" data-bs-toggle="dropdown">Binaan</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{ route('binaan.daftar') }}">Daftar Brand</a></li>
              <li><a class="dropdown-item" href="{{ route('binaan.brand') }}">Tata Cara Menjadi Binaan</a></li>
            </ul>
          </li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('produk.*') ? 'active fw-semibold text-primary' : '' }}" href="{{ route('produk.index') }}">Produk</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('berita.*') ? 'active fw-semibold text-primary' : '' }}" href="{{ route('berita.index') }}">Berita</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('kontak') ? 'active fw-semibold text-primary' : '' }}" href="{{ route('kontak') }}">Kontak Kami</a></li>
        </ul>
      </div>
    </div>
  </nav>

  {{-- ================= MAIN CONTENT ================= --}}
  <main class="py-5">
    <div class="container">
      @yield('content')
    </div>
  </main>

  {{-- ================= FOOTER ================= --}}
  <footer>
    <div class="container">
      <div class="row gy-4 align-items-center">
        <div class="col-md-4 d-flex align-items-center gap-2">
          <img src="{{ asset('images/logo.jpg') }}" class="rounded" height="50" alt="Logo">
          <div>
            <div class="fw-bold">DEKRANASDA</div>
            <div>Kabupaten Bojonegoro</div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="fw-semibold text-primary">Alamat Sekretariat</div>
          <div>Jl. Mas Tumapel No.1, Bojonegoro, Jawa Timur 62111</div>
          <div>Telp: (0353) 881 555</div>
          <div>Email: dekranasda@bojonegorokab.go.id</div>
        </div>
        <div class="col-md-4 text-md-end">
          <div class="fw-semibold mb-1">Ikuti Kami</div>
          <div class="social">
            <a href="#"><i class="bi bi-instagram"></i></a>
            <a href="#"><i class="bi bi-facebook"></i></a>
            <a href="#"><i class="bi bi-youtube"></i></a>
          </div>
        </div>
      </div>

      <hr class="my-4">

      <div class="text-center small">
        © {{ date('Y') }} Dekranasda Kab. Bojonegoro — Kominfo Kab. Bojonegoro.
        <a href="{{ route('admin.login') }}" class="text-primary text-decoration-none fw-semibold">Admin</a>
      </div>
    </div>
  </footer>

  {{-- ✅ Bootstrap JS --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts')
</body>
</html>
