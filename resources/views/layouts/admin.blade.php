<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>@yield('title','Admin Panel')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    :root { --sidebar:#1f2a37; --sidebar-active:#111827; }
    body{background:#f6f9fc;}
    .sidebar { width:230px; min-height:100vh; background:var(--sidebar); position:fixed; left:0; top:0; color:#d1d5db; }
    .sidebar .brand{ padding:16px 20px; font-weight:700; color:#fff; border-bottom:1px solid #273341;}
    .sidebar .nav-link{ color:#d1d5db; border-radius:.5rem; }
    .sidebar .nav-link:hover, .sidebar .nav-link.active{ background:var(--sidebar-active); color:#fff; }
    .main { margin-left:230px; }
    .topbar{ position:sticky; top:0; z-index:1020; background:#fff; border-bottom:1px solid #e9eef3;}
    .card-shadow{ box-shadow:0 8px 24px rgba(15,23,42,.06); }
    .table > :not(caption) > * > * { vertical-align: middle; }
  </style>
  @stack('head')
</head>
<body>
  <!-- Sidebar -->
  <aside class="sidebar d-flex flex-column">
    <div class="brand d-flex align-items-center gap-2">
      <img src="{{ asset('images/logo.jpg') }}" height="26" alt="Logo"> <span>Admin Panel</span>
    </div>
    <nav class="p-3 d-grid gap-1">
      <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
         href="{{ route('admin.dashboard') }}">
        <i class="bi bi-speedometer2 me-2"></i>Dashboard
      </a>

      <a class="nav-link {{ request()->routeIs('admin.produk.*') ? 'active' : '' }}"
         href="{{ route('admin.produk.index') }}">
        <i class="bi bi-box-seam me-2"></i>Kelola Produk
      </a>

      <a class="nav-link {{ request()->routeIs('admin.news.*') ? 'active' : '' }}"
         href="{{ route('admin.news.index') }}">
        <i class="bi bi-newspaper me-2"></i>Kelola Berita
      </a>

      <a class="nav-link {{ request()->routeIs('admin.organisasi.*') ? 'active' : '' }}"
         href="{{ route('admin.organisasi.index') }}">
        <i class="bi bi-diagram-3 me-2"></i>Struktur Organisasi
      </a>

      <a class="nav-link {{ request()->routeIs('admin.binaan.*') ? 'active' : '' }}"
         href="{{ route('admin.binaan.index') }}">
        <i class="bi bi-people me-2"></i>Data Binaan
      </a>

      <a class="nav-link" href="#"><i class="bi bi-images me-2"></i>Galeri</a>
      <a class="nav-link" href="#"><i class="bi bi-envelope me-2"></i>Pesan Masuk</a>
      <a class="nav-link" href="#"><i class="bi bi-gear me-2"></i>Pengaturan</a>

      <div class="mt-auto pt-3">
        <form method="POST" action="{{ route('logout') }}">@csrf
          <button class="btn btn-danger w-100"><i class="bi bi-box-arrow-right me-1"></i> Logout</button>
        </form>
      </div>
    </nav>
  </aside>

  <!-- Main -->
  <div class="main">
    <div class="topbar">
      <div class="container-fluid px-4 d-flex align-items-center justify-content-between py-3">
        <h5 class="mb-0">@yield('page_title','')</h5>
        <div>@yield('top_actions')</div>
      </div>
    </div>

    <div class="container-fluid px-4 py-4">
      @yield('content')
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts')
</body>
</html>
