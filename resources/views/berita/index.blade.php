@extends('layouts.app')

@section('title', 'Berita')

@push('head')
<style>
  /* ===== Warna utama biru muda soft ===== */
  :root {
    --soft-blue: #a6d8ff;   /* biru muda lembut */
    --light-blue: #e8f5ff;  /* latar lembut */
    --text-dark: #212529;
    --text-muted: #6b7280;
  }

  /* ===== Judul Halaman ===== */
  .news-title {
    text-align: center;
    font-weight: 800;
    font-size: 2.3rem;
    color: #4da8ff;
    margin-bottom: 0.25rem;
  }
  .news-sub {
    text-align: center;
    color: var(--text-muted);
    margin-bottom: 1rem;
  }
  .underline {
    width: 180px;
    height: 4px;
    background-color: var(--soft-blue);
    border-radius: 4px;
    margin: 0 auto 2rem;
  }

  /* ===== Grid Layout ===== */
  .news-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 1.5rem;
  }

  /* ===== Kartu Berita ===== */
  .news-card {
    background-color: #fff;
    border: 1px solid var(--light-blue);
    border-radius: 14px;
    box-shadow: 0 3px 10px rgba(173, 216, 255, 0.25);
    overflow: hidden;
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
  }
  .news-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 8px 20px rgba(77, 168, 255, 0.2);
  }

  .news-thumb {
    aspect-ratio: 16/9;
    overflow: hidden;
    background-color: var(--light-blue);
  }
  .news-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .3s ease;
  }
  .news-card:hover .news-thumb img {
    transform: scale(1.05);
  }

  .news-body {
    padding: 1rem 1.25rem 1.25rem;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
  }

  .news-meta {
    font-size: 0.85rem;
    color: var(--text-muted);
    margin-bottom: 0.5rem;
  }

  .news-title-text {
    font-weight: 600;
    font-size: 1.05rem;
    color: var(--text-dark);
    line-height: 1.5;
    flex-grow: 1;
  }

  .read-more {
    color: #4da8ff; /* biru muda soft */
    font-weight: 500;
    font-size: 0.95rem;
    margin-top: 0.75rem;
    text-decoration: none;
    display: inline-block;
  }
  .read-more:hover {
    text-decoration: underline;
    color: #2b8de5; /* sedikit lebih gelap saat hover */
  }

  /* ===== Responsif Tambahan ===== */
  @media (max-width: 576px) {
    .news-title {
      font-size: 1.8rem;
    }
  }
</style>
@endpush

@section('content')
<div class="container py-5">

  {{-- Judul --}}
  <h1 class="news-title">Berita</h1>
  <div class="news-sub">Dekranasda Kabupaten Bojonegoro</div>
  <div class="underline"></div>

  @php
    use Illuminate\Support\Facades\Storage;
  @endphp

  @if(isset($message))
    <p class="text-center">{{ $message }}</p>
  @else
    @if(($beritas ?? collect())->count())
      <div class="news-grid">
        @foreach ($beritas as $berita)
          @php
            $cover = $berita->image_url
              ?? ($berita->image_path ? Storage::url($berita->image_path) : asset('images/placeholder-news.jpg'));
          @endphp

          <article class="news-card">
            <div class="news-thumb">
              <img src="{{ $cover }}" alt="{{ $berita->title }}" loading="lazy"
                   onerror="this.onerror=null;this.src='{{ asset('images/placeholder-news.jpg') }}'">
            </div>
            <div class="news-body">
              <div class="news-meta">
                {{ optional($berita->created_at)->format('F jS, Y') }}
              </div>
              <div class="news-title-text">{{ $berita->title }}</div>
              <a href="{{ route('berita.detail', $berita->id) }}" class="read-more">Baca Selengkapnya</a>
            </div>
          </article>
        @endforeach
      </div>

      {{-- Pagination --}}
      <div class="mt-5 d-flex justify-content-center">
        {{ $beritas->links() }}
      </div>
    @else
      <div class="alert alert-secondary mt-3 text-center">Belum ada berita.</div>
    @endif
  @endif
</div>
@endsection
