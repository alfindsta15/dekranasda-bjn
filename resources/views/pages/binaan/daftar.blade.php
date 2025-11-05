@extends('layouts.app')

@section('title', 'Daftar Brand Binaan')

@push('head')
<style>
  /* ===== Judul dan Subjudul ===== */
  .brand-title {
    text-align: center;
    font-weight: 800;
    font-size: 2.2rem;
    color: #4da8ff; /* biru muda soft */
    margin-bottom: 0.3rem;
  }
  .brand-sub {
    text-align: center;
    color: #6c757d;
    margin-bottom: 1rem;
  }
  .brand-underline {
    width: 200px;
    height: 4px;
    background-color: #a6d8ff; /* garis biru lembut */
    border-radius: 5px;
    margin: 0 auto 2.5rem auto;
  }

  /* ===== Kartu Brand ===== */
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

  .card img {
    transition: transform 0.4s ease;
  }

  .card:hover img {
    transform: scale(1.05);
  }

  /* ===== Ikon ===== */
  .bi {
    font-size: 1rem;
  }

  /* ===== Section Wrapper ===== */
  .brand-section {
    background-color: #f8f9fa;
    border-radius: 1rem;
    padding: 3rem 1rem;
  }
</style>
@endpush

@section('content')
<div class="container py-5">
  <div class="brand-section">
    <h1 class="brand-title">Daftar Brand Binaan</h1>
    <div class="brand-sub">Dekranasda Kabupaten Bojonegoro</div>
    <div class="brand-underline"></div>

    @if($binaan->isNotEmpty())
      <div class="row g-4">
        @foreach ($binaan as $row)
          @php $img = $row->image_url ?? null; @endphp
          <div class="col-12 col-sm-6 col-lg-4">
            <div class="card h-100 shadow-sm rounded-4 overflow-hidden position-relative">

              {{-- Gambar --}}
              @if($img)
                <img src="{{ $img }}" alt="{{ $row->name }}" class="card-img-top" style="height: 230px; object-fit: cover;">
              @else
                <div class="d-flex align-items-center justify-content-center bg-light text-muted" style="height:230px;">
                  <small><em>Tidak ada gambar</em></small>
                </div>
              @endif

              {{-- Isi Card --}}
              <div class="card-body">
                <h5 class="card-title fw-semibold text-dark mb-1">{{ $row->name ?? '-' }}</h5>

                @if($row->brand)
                  <p class="text-primary small fw-medium mb-3">{{ $row->brand }}</p>
                @endif

                <ul class="list-unstyled small text-secondary mb-0">
                  @if($row->phone)
                    <li class="mb-1 d-flex align-items-center">
                      <i class="bi bi-telephone text-primary me-2"></i> {{ $row->phone }}
                    </li>
                  @endif
                  @if($row->address)
                    <li class="d-flex align-items-start">
                      <i class="bi bi-geo-alt text-primary me-2"></i>
                      <span>{{ $row->address }}</span>
                    </li>
                  @endif
                </ul>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      {{-- Pagination --}}
      <div class="mt-5 d-flex justify-content-center">
        {{ $binaan->withQueryString()->links() }}
      </div>

    @else
      <div class="alert alert-info text-center py-5 rounded-4 shadow-sm">
        Belum ada data binaan untuk ditampilkan.
      </div>
    @endif
  </div>
</div>
@endsection
