@extends('layouts.app')

@section('content')

@push('head')
<style>
  /* ===== Animasi dan Warna ===== */
  .fade-up {
    opacity: 0;
    transform: translateY(20px);
    animation: fadeUp 0.8s ease forwards;
  }

  @keyframes fadeUp {
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .section-divider {
    height: 6px;
    background: linear-gradient(to right, #a6d8ff, #4da8ff);
    border-radius: 50px;
    margin-bottom: 3rem;
  }

  .section-title {
    color: #4da8ff;
    font-weight: 800;
    letter-spacing: 0.5px;
  }

  .benefit-card {
    border: none;
    border-radius: 1rem;
    transition: all 0.3s ease;
  }
  .benefit-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 1rem 1.5rem rgba(0, 0, 0, 0.1);
  }

  .benefit-icon {
    font-size: 2.5rem;
    color: #4da8ff;
    margin-bottom: 0.75rem;
  }

  .highlight-tag {
    background-color: #e9f6ff;
    border: 1px solid #4da8ff;
    color: #004c91;
    border-radius: 30px;
    display: inline-block;
    padding: 0.4rem 1.2rem;
    font-weight: 600;
  }

  /* ====== Section biru muda ====== */
  .keuntungan-section {
    background-color: #e6f0fa;
    border-radius: 20px;
  }
  .keuntungan-section .card {
    background-color: #ffffff;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  .keuntungan-section .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
  }

 .instagram-fullscreen {
    position: relative;
    width: 100vw;       /* penuh selebar layar */
    height: 100vh;    
    max-width: 1200px;  /* penuh setinggi layar */
    overflow-y: auto;   /* bisa discroll kalau konten lebih panjang */
    background: #fff;
    margin: 0;
    padding: 0;
  }

  /* Reset gaya blockquote Instagram agar tidak terbatas */
  blockquote.instagram-media {
    width: 100% !important;
    max-width: none !important;
    min-height: 100vh; /* minimal isi layar */
    margin: 0 auto !important;
    border: none !important;
  }

  /* Hapus pembatas bawaan container */
  .no-container-padding {
    padding: 0 !important;
    margin: 0 !important;
  }
</style>
@endpush


{{-- ===================== HERO ===================== --}}
<section class="position-relative overflow-hidden rounded-4 shadow mb-5 fade-up">
  <img src="{{ asset('images/gambar 1.jpg') }}"
       alt="Dekranasda Bojonegoro"
       class="w-100 object-fit-cover"
       style="height: 420px; filter: brightness(55%); object-position: center;">

  <div class="position-absolute top-50 start-0 translate-middle-y text-white px-4 px-md-5">
    <p class="d-inline-flex align-items-center gap-2 text-uppercase fw-bold small bg-white bg-opacity-25 px-3 py-1 rounded-pill">
      <span class="badge bg-info rounded-circle p-1"></span> Selamat Datang di Website
    </p>

    <h1 class="mt-3 fw-bolder display-5">Dewan Kerajinan Nasional Daerah (Dekranasda)</h1>
    <h2 class="fs-5 fw-semibold">Kabupaten Bojonegoro</h2>

    <p class="mt-3 fs-6" style="max-width: 700px;">
      Dekranasda Kabupaten Bojonegoro menjadi rumah kolaborasi bagi perajin dan UMKM lokal.
      Kami mendorong promosi, peningkatan daya saing, serta pembukaan akses pasar yang lebih luas
      melalui kurasi produk, pendampingan, dan jejaring kemitraan.
    </p>

    <div class="mt-4 d-flex flex-wrap gap-3">
      <a href="{{ url('/produk') }}" class="btn btn-primary fw-semibold px-4">Jelajah Produk</a>
      <a href="https://www.instagram.com/dekranasda.bojonegoro" target="_blank" class="btn btn-outline-light fw-semibold px-4">Ikuti Instagram</a>
    </div>
  </div>
</section>

<div class="section-divider"></div>


{{-- ===================== KEUNTUNGAN MENJADI BINAAN ===================== --}}
<section class="keuntungan-section py-5 fade-up">
  <div class="container">
    <div class="bg-white border rounded-4 shadow p-4 p-md-5">

      <div class="text-center mb-5">
        <span class="highlight-tag d-inline-block px-4 py-2 rounded-pill bg-primary text-white fw-semibold">
          KEUNTUNGAN MENJADI BINAAN
        </span>
      </div>

      <div class="row g-9 align-items-stretch justify-content-center">

        <div class="col-12 col-sm-6 col-md-3 col-lg-2">
          <div class="card benefit-card text-center h-100 border border-2 border-primary-subtle rounded-4 shadow-sm">
            <div class="card-body">
              <h6 class="fw-bold mb-2 text-primary">Pemberdayaan & Promosi</h6>
              <p class="small text-muted">
                Pemberdayaan dan promosi untuk menciptakan pelaku usaha unggul, mandiri, dan berdaya saing.
              </p>
            </div>
          </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3 col-lg-2">
          <div class="card benefit-card text-center h-100 border border-2 border-primary-subtle rounded-4 shadow-sm">
            <div class="card-body">
              <h6 class="fw-bold mb-2 text-primary">Group Chat Komunikasi</h6>
              <p class="small text-muted">
                Informasi kegiatan disampaikan lebih cepat dan mudah lewat grup komunikasi binaan.
              </p>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-4 text-center my-3 my-md-0">
          <img src="{{ asset('images/gambar 2.jpg') }}"
          class="img-fluid rounded-4 shadow border border-3 border-primary-subtle"
          alt="Keuntungan menjadi binaan"
          style="max-width: 310px; margin-top: 30px;">
        </div>

        <div class="col-12 col-sm-6 col-md-3 col-lg-2">
          <div class="card benefit-card text-center h-100 border border-2 border-primary-subtle rounded-4 shadow-sm">
            <div class="card-body">
              <h6 class="fw-bold mb-2 text-primary">Validasi Produk</h6>
              <p class="small text-muted">
                Kurasi produk dilakukan dengan melibatkan akademisi dan profesional sebagai kurator.
              </p>
            </div>
          </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3 col-lg-2">
          <div class="card benefit-card text-center h-100 border border-2 border-primary-subtle rounded-4 shadow-sm">
            <div class="card-body">
              <h6 class="fw-bold mb-2 text-primary">Pengembangan Bisnis</h6>
              <p class="small text-muted">
                Meningkatkan kreativitas UMKM, melestarikan budaya lokal, dan membangun komunitas yang solid.
              </p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>


{{-- ===================== DEKRANASDA KABUPATEN BOJONEGORO ===================== --}}
<section class="my-5 fade-up">
  <div class="container">
    <div class="border rounded-4 shadow-sm p-4 p-md-5 bg-white">
      <div class="row g-4 align-items-center">
        <div class="col-md-6">
          <div class="border border-3 border-primary rounded-4 p-2 bg-white">
            <img src="{{ asset('images/gambar 3.jpg') }}" class="img-fluid rounded-3 shadow-sm" alt="Pelantikan Dekranasda Bojonegoro">
          </div>
        </div>

        <div class="col-md-6">
          <h3 class="section-title mb-3">DEKRANASDA KABUPATEN BOJONEGORO</h3>
          <p class="text-muted">
            <strong>Bupati Bojonegoro Setyo Wahono</strong> optimis bahwa
            <strong>kolaborasi dan inovasi</strong> Dekranasda mampu menjadi penggerak kerajinan daerah
            dalam <strong>meningkatkan daya saing</strong> serta mendorong para perajin lokal agar
            lebih baik dan produktif.
          </p>
          <p class="text-muted">
            Ia menegaskan bahwa <strong>sinergi antara pemerintah, swasta, dan masyarakat</strong>
            menjadi penggerak utama ekonomi lokal. Ditekankan pula pentingnya menumbuhkan
            kebanggaan menggunakan <strong>produk Bojonegoro</strong> sebagai bagian dari pembangunan kreatif daerah.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>


{{-- ===================== GALERI KEGIATAN ===================== --}}
<section class="mt-5 fade-up">
  <div class="container">
    <div class="text-center mb-4">
      <h4 class="fw-bold text-primary mb-1">Galeri Kegiatan</h4>
      <p class="text-muted small mb-0">Dekranasda Kabupaten Bojonegoro</p>
       <hr class="border-gray-200 mb-1">
    </div>


  <div class="instagram-fullscreen">
  <iframe 
    src="https://www.instagram.com/dekranasda.bojonegoro/embed" 
    width="100%" 
    height="100%" 
    frameborder="0" 
    style="height: 100vh;" 
    allowfullscreen>
  </iframe>
</div>

</div>

  </div>
</section>

<script async src="//www.instagram.com/embed.js"></script>
@endsection
