@extends('layouts.app')

@section('title', $product->name ?? 'Detail Produk')

@push('head')
<style>
  /* ===== Warna Harga ===== */
  .price-text {
    color: #0077b6; /* biru toska lembut - sama seperti index.blade.php */
    font-weight: 700;
  }

  /* ===== Tampilan Produk Lainnya ===== */
  .produk-lainnya-title {
    background-color: #a6d8ff;
    color: #004b78;
    text-align: center;
    padding: 0.5rem 0;
    border-radius: 0.75rem 0.75rem 0 0;
    font-weight: 700;
  }

  .produk-lainnya-wrapper {
    background-color: #f0f8ff;
    border-radius: 0 0 0.75rem 0.75rem;
    padding: 1.5rem;
  }

  .card {
    border: none;
    transition: all 0.3s ease;
    border-radius: 1rem;
    overflow: hidden;
  }

  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.1);
  }

  .card-img-top {
    transition: transform 0.4s ease;
  }

  .card:hover .card-img-top {
    transform: scale(1.05);
  }
</style>
@endpush

@section('content')
@php
    $priceFull  = 'Rp '.number_format($product->price ?? 0, 2, ',', '.');
    $unitLabel  = $product->unit ? ' / '.$product->unit : '';
    $category   = strtoupper($product->category->name ?? 'PRODUK');

    $ownerName    = $product->owner_name ?? null;
    $ownerPhone   = $product->owner_phone ?? ($product->whatsapp ?? null);
    $ownerAddress = $product->owner_address ?? null;
    $instagram    = $product->instagram ?? null;

    $phoneDigits  = $ownerPhone ? preg_replace('/\D/','', $ownerPhone) : null;
    $waText       = urlencode("Halo, saya tertarik dengan produk ".$product->name);
    $igHandle     = $instagram ? ltrim($instagram, '@') : null;
    $igUrl        = $igHandle ? "https://instagram.com/{$igHandle}" : null;
@endphp

<div class="container py-5">

  {{-- Kategori --}}
  <div class="text-center mb-3">
    <span class="badge bg-light text-dark border px-3 py-2 fw-semibold">{{ $category }}</span>
  </div>

  {{-- Detail Produk --}}
  <div class="card border-0 shadow-sm mb-5">
    <div class="card-body p-4">
      <div class="row g-4 align-items-start">

        {{-- Gambar Produk --}}
        <div class="col-md-5">
          <div class="border rounded overflow-hidden">
            <img src="{{ $product->image_url }}" 
                 alt="{{ $product->name }}" 
                 class="img-fluid w-100" 
                 style="object-fit: cover; height: 320px;">
          </div>
        </div>

        {{-- Informasi Produk --}}
        <div class="col-md-7">
          <h3 class="fw-bold">{{ $product->name }}</h3>
          <h4 class="price-text mt-2">
            {{ $priceFull }} 
            <small class="text-muted">{{ $unitLabel }}</small>
          </h4>

          <div class="mt-4">
            <h6 class="fw-semibold text-dark">Deskripsi</h6>
            <p class="text-muted small mb-0">
              {{ $product->description ?: 'Deskripsi belum tersedia.' }}
            </p>
          </div>

          {{-- Info Penjual --}}
          <div class="mt-4 border rounded p-3 bg-light">
            <h6 class="fw-semibold text-dark mb-3">Informasi Penjual</h6>
            <div class="row small">
              @if($ownerName)
                <div class="col-md-6 mb-2">
                  <strong class="text-secondary d-block">Pemilik</strong>
                  <span class="fw-semibold">{{ $ownerName }}</span>
                </div>
              @endif

              @if($ownerPhone)
                <div class="col-md-6 mb-2">
                  <strong class="text-secondary d-block">Kontak</strong>
                  <span class="fw-semibold">
                    @if($phoneDigits)
                      <a href="tel:{{ $phoneDigits }}" class="text-decoration-none text-dark">{{ $ownerPhone }}</a>
                      <span class="text-muted mx-1">|</span>
                      <a href="https://wa.me/{{ $phoneDigits }}?text={{ $waText }}" 
                         target="_blank" 
                         class="text-success text-decoration-none">
                        WhatsApp
                      </a>
                    @else
                      {{ $ownerPhone }}
                    @endif
                  </span>
                </div>
              @endif

              @if($ownerAddress)
                <div class="col-12 mb-2">
                  <strong class="text-secondary d-block">Alamat</strong>
                  <span class="fw-semibold">{{ $ownerAddress }}</span>
                </div>
              @endif

              @if($instagram)
                <div class="col-md-6 mb-2">
                  <strong class="text-secondary d-block">Instagram</strong>
                  <a href="{{ $igUrl }}" 
                     target="_blank" 
                     class="text-decoration-none text-dark fw-semibold">
                     {{ '@'.$igHandle }}
                  </a>
                </div>
              @endif
            </div>
          </div>

          {{-- Tombol kembali --}}
          <div class="mt-4">
            <a href="{{ route('produk.index') }}" 
               class="btn btn-outline-secondary btn-sm">
               ← Kembali ke Daftar Produk
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Produk Lainnya --}}
  @isset($otherProducts)
    @if($otherProducts->count() > 0)
      <h5 class="produk-lainnya-title">Produk Lainnya</h5>
      <div class="produk-lainnya-wrapper">
        <div class="row g-3">
          @foreach($otherProducts as $item)
            <div class="col-6 col-md-4 col-lg-3">
              <a href="{{ route('produk.show', $item->id) }}" class="text-decoration-none">
                <div class="card h-100 border-0 shadow-sm">
                  <img src="{{ $item->image_url }}" 
                       class="card-img-top" 
                       alt="{{ $item->name }}" 
                       style="object-fit: cover; height: 140px;">
                  <div class="card-body p-2 text-center">
                    <p class="card-title small fw-semibold text-dark mb-1">{{ $item->name }}</p>
                    <p class="price-text small mb-0">
                      Rp {{ number_format($item->price ?? 0, 0, ',', '.') }}
                      @if($item->unit)
                        <span class="text-muted">/ {{ $item->unit }}</span>
                      @endif
                    </p>
                  </div>
                </div>
              </a>
            </div>
          @endforeach
        </div>
      </div>
    @endif
  @endisset
</div>
@endsection
