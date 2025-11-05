@extends('layouts.app')

@section('title', 'Visi & Misi')

@section('content')
<div class="container py-5">
  <div class="text-center mb-5">
    <h1 class="fw-bold display-5 text-primary mb-2">Visi & Misi</h1>
    <p class="text-secondary">Dekranasda Kabupaten Bojonegoro</p>
    <hr class="mx-auto opacity-100" style="width: 100px; height: 4px; background-color: #6cb4ff; border: none; border-radius: 2px;">
  </div>

  {{-- Section Visi --}}
  <div class="bg-light rounded-4 shadow-sm p-5 mb-5 border-start border-4 border-primary">
    <h2 class="fw-bold text-primary mb-3">Visi</h2>
    <p class="fs-5 text-dark fw-semibold mb-0">
      Dekranas menjadi lembaga yang handal dalam mendukung kemandirian ekonomi Indonesia.
    </p>
  </div>

  {{-- Section Misi --}}
  <div class="bg-white rounded-4 shadow-sm p-5 border-start border-4 border-info">
    <h2 class="fw-bold text-info mb-3">Misi</h2>
    <p class="text-secondary mb-3">Dekranasda Kabupaten Bojonegoro</p>

    <ol class="ps-3 fs-6 text-dark">
      <li class="mb-2">Menyiapkan regenerasi sumber daya manusia (SDM)/perajin yang unggul dan menggali.</li>
      <li class="mb-2">Melestarikan dan mengembangkan warisan tradisi dan budaya bangsa.</li>
      <li class="mb-2">Meningkatkan daya saing produk kerajinan berbasis kearifan lokal dengan selera global melalui pengembangan inovasi, desain, kreatifitas, dan efisiensi.</li>
      <li class="mb-2">Meningkatkan hubungan kemitraan dan kerjasama dengan lembaga nasional dan internasional di bidang industri kerajinan.</li>
      <li class="mb-2">Mendorong perluasan akses pasar bagi produk–produk kerajinan Indonesia.</li>
      <li class="mb-2">Membangun ekosistem industri kerajinan melalui penguatan potensi kerajinan Indonesia.</li>
      <li>Mendorong industri kecil dan menengah (IKM) kerajinan masuk ke dalam rantai pasok global.</li>
    </ol>
  </div>
</div>
@endsection

@push('head')
<style>
  body {
    background-color: #f4f9ff; /* biru muda lembut */
  }
  h1, h2 {
    font-family: 'Poppins', sans-serif;
  }
  ol {
    counter-reset: item;
  }
  ol > li {
    list-style: decimal;
    margin-left: 1rem;
  }
</style>
@endpush
