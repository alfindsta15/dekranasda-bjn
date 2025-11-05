@extends('layouts.app')
@section('title', 'Produk')

@push('head')
<style>
  /* ===== Judul Halaman ===== */
  .produk-title {
    text-align: center;
    font-weight: 800;
    font-size: 2rem;
    color: #4da8ff; /* biru muda soft */
    margin-bottom: 0.25rem;
  }
  .produk-sub {
    text-align: center;
    color: #6c757d;
    margin-bottom: 1rem;
  }
  .produk-underline {
    width: 200px;
    height: 4px;
    background-color: #a6d8ff; /* garis biru lembut */
    border-radius: 5px;
    margin: 0 auto 2rem auto;
  }

  /* ===== Kartu Produk ===== */
  .card {
    transition: all 0.3s ease;
    border: none;
    border-radius: 1rem;
    overflow: hidden;
    background-color: #fff;
  }

  .card:hover {
    transform: translateY(-6px);
    box-shadow: 0 1rem 1.5rem rgba(0, 0, 0, 0.1);
  }

  .card-img-top {
    transition: transform 0.4s ease;
  }

  .card:hover .card-img-top {
    transform: scale(1.05);
  }

  .btn-outline-dark {
    border-radius: 50px;
  }

  /* ===== Warna Harga ===== */
  .price-text {
    color: #0077b6; /* biru toska lembut */
    font-weight: 700;
  }

  /* ===== Background Section ===== */
  .produk-section {
    background-color: #f8f9fa;
    border-radius: 1rem;
    padding: 3rem 1rem;
  }
</style>
@endpush

@section('content')
<div class="container py-5">
  <div class="produk-section">
    <h2 class="produk-title">Daftar Produk Kami</h2>
    <div class="produk-sub">Temukan berbagai produk unggulan binaan Dekranasda Bojonegoro</div>
    <div class="produk-underline"></div>

    @if($products->count() > 0)
      <div class="row g-4">
        @foreach($products as $product)
          <div class="col-6 col-md-4 col-lg-3">
            <div class="card h-100 shadow-sm">
              <div class="ratio ratio-4x3">
                <img 
                  src="{{ $product->image_url }}" 
                  class="card-img-top object-fit-cover" 
                  alt="{{ $product->name }}">
              </div>
              <div class="card-body p-3 d-flex flex-column justify-content-between">
                <div>
                  <h6 class="fw-semibold mb-1 text-dark text-truncate">{{ $product->name }}</h6>
                  <small class="text-muted d-block mb-1">
                    {{ $product->category->name ?? 'Tanpa Kategori' }}
                  </small>
                  <p class="price-text mb-2">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                    <small class="text-muted">/ {{ $product->unit ?? 'pcs' }}</small>
                  </p>
                </div>
                <a href="{{ route('produk.show', $product->id) }}" 
                   class="btn btn-outline-dark btn-sm fw-semibold mt-auto">
                  Lihat Detail
                </a>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <div class="d-flex justify-content-center mt-5">
        {{ $products->links() }}
      </div>

    @else
      <div class="text-center py-5">
        <p class="text-muted mb-3">Belum ada produk yang tersedia saat ini.</p>
        <a href="{{ route('home') }}" class="btn btn-primary px-4 rounded-pill">
          Kembali ke Beranda
        </a>
      </div>
    @endif
  </div>
</div>
@endsection
