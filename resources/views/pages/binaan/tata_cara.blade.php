@extends('layouts.app')

@section('title', 'Tata Cara Menjadi Binaan')

@push('head')
<style>
  .page-title {
    font-weight: 800;
    font-size: 2rem;
    text-align: center;
    color: #4da8ff; /* biru muda soft */
    margin-bottom: 0.25rem;
  }
  .page-sub {
    text-align: center;
    color: #555;
    margin-bottom: 1rem;
  }
  .underline {
    width: 200px;
    height: 4px;
    background-color: #a6d8ff;
    border-radius: 5px;
    margin: 0 auto 2rem auto;
  }
  .section-title {
    font-weight: 600;
    color: #1e3a8a;
    margin-bottom: 0.75rem;
  }
  .info-box {
    border: 1px solid #dbeafe;
    background-color: #f0f9ff;
    border-radius: 0.75rem;
    padding: 1rem 1.25rem;
    color: #0c4a6e;
  }
  .btn-softblue {
    background-color: #4da8ff;
    color: #fff;
    border: none;
    transition: all 0.3s ease;
  }
  .btn-softblue:hover {
    background-color: #1e90ff;
    color: #fff;
  }
</style>
@endpush

@section('content')
<div class="container py-5">
  {{-- Judul --}}
  <h1 class="page-title">Tata Cara Menjadi Binaan</h1>
  <div class="page-sub">Dekranasda Kabupaten Bojonegoro</div>
  <div class="underline"></div>

  <div class="mx-auto" style="max-width: 800px;">

    {{-- Persyaratan --}}
    <section class="mb-5">
      <h2 class="section-title">Persyaratan</h2>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">Pelaku usaha/kriya berdomisili di Kabupaten Bojonegoro.</li>
        <li class="list-group-item">Memiliki produk sendiri dan aktif berproduksi.</li>
        <li class="list-group-item">Kontak yang bisa dihubungi (No. HP/Email).</li>
        <li class="list-group-item">Portofolio/foto produk (jika ada).</li>
      </ul>
    </section>

    {{-- Alur Pendaftaran --}}
    <section class="mb-5">
      <h2 class="section-title">Alur Pendaftaran</h2>
      <ol class="list-group list-group-numbered">
        <li class="list-group-item">Isi formulir pendaftaran binaan.</li>
        <li class="list-group-item">Verifikasi berkas oleh tim Dekranasda.</li>
        <li class="list-group-item">Survey/assesment (bila diperlukan).</li>
        <li class="list-group-item">Penetapan &amp; pengumuman status binaan.</li>
      </ol>
    </section>

    {{-- Formulir --}}
    <section class="mb-5">
      <h2 class="section-title">Formulir Pendaftaran</h2>
      <p>Silakan hubungi kami untuk mendapatkan formulir resmi:</p>
      <div class="info-box mt-3">
        <div>📍 Jl. Mas Tumapel No. 1, Bojonegoro, Jawa Timur 62111</div>
        <div>☎️ (0353) 881 555</div>
        <div>✉️ dekranasda@bojonegorokab.go.id</div>
      </div>
    </section>

    {{-- Tombol --}}
    <div class="text-center mt-4">
      <a href="{{ route('binaan.daftar') }}" class="btn btn-softblue px-4 py-2 rounded-pill">
        Lihat Daftar Brand
      </a>
    </div>

  </div>
</div>
@endsection
