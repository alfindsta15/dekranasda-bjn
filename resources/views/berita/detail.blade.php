@extends('layouts.app')

@section('title', $news->title ?? 'Berita')

@push('head')
<style>
  :root {
    --soft-blue: #a6d8ff;   /* biru muda lembut */
    --main-blue: #4da8ff;   /* biru utama */
    --hover-blue: #2b8de5;  /* biru sedikit lebih gelap */
    --text-dark: #212529;
    --text-muted: #6c757d;
  }

  .news-container {
    max-width: 1000px;
    margin: 0 auto;
    padding: 48px 16px 64px;
  }

  /* ===== Tombol Kembali ===== */
  .back-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: var(--main-blue);
    font-weight: 500;
    text-decoration: none;
    margin-bottom: 1rem;
    transition: color 0.25s ease;
  }
  .back-btn:hover {
    color: var(--hover-blue);
    text-decoration: underline;
  }

  .news-title {
    font-weight: 800;
    font-size: clamp(1.5rem, 3vw, 2.2rem);
    line-height: 1.3;
    color: var(--text-dark);
    margin-bottom: 0.5rem;
  }

  .news-meta {
    color: var(--text-muted);
    font-size: 0.9rem;
    margin-bottom: 1rem;
  }

  .news-hero {
    width: 100%;
    max-height: 460px;
    object-fit: cover;
    border-radius: 0.75rem;
    border: 1px solid var(--soft-blue);
    box-shadow: 0 3px 10px rgba(77,168,255,0.15);
  }

  .news-content {
    margin-top: 1.5rem;
    font-size: 1rem;
    line-height: 1.7;
    color: var(--text-dark);
    white-space: pre-wrap;
  }

  .related-section {
    margin-top: 2.5rem;
  }
  .related-section h3 {
    font-weight: 700;
    margin-bottom: 0.75rem;
    color: var(--text-dark);
  }
  .related-section ul {
    padding-left: 1.25rem;
  }
  .related-section a {
    text-decoration: none;
    color: var(--main-blue);
  }
  .related-section a:hover {
    text-decoration: underline;
    color: var(--hover-blue);
  }
</style>
@endpush

@section('content')
@php use Illuminate\Support\Facades\Storage; @endphp

<div class="news-container">

  {{-- Tombol Kembali --}}
  <a href="{{ route('berita.index') }}" class="back-btn">
    <i class="bi bi-arrow-left"></i> Kembali ke Berita
  </a>

  {{-- Judul & Tanggal --}}
  <h1 class="news-title">{{ $news->title }}</h1>
  <div class="news-meta">{{ optional($news->created_at)->format('d M Y') }}</div>

  {{-- Gambar Utama --}}
  @php
    $cover = $news->image_url
      ?? ($news->image_path ? Storage::url($news->image_path) : asset('images/placeholder-news.jpg'));
  @endphp

  <div class="text-center mb-4">
    <img src="{{ $cover }}" alt="Gambar Berita" class="news-hero img-fluid"
         onerror="this.onerror=null;this.src='{{ asset('images/placeholder-news.jpg') }}'">
  </div>

  {{-- Konten --}}
  <div class="news-content">
    {!! nl2br(e($news->content)) !!}
  </div>

  {{-- Berita Terkait --}}
  @if(!empty($relatedNews) && count($relatedNews))
    <div class="related-section">
      <h3>Berita Terkait</h3>
      <ul class="list-unstyled">
        @foreach ($relatedNews as $related)
          <li class="mb-1">
            <i class="bi bi-chevron-right text-secondary me-1"></i>
            <a href="{{ route('berita.detail', $related->id) }}">{{ $related->title }}</a>
          </li>
        @endforeach
      </ul>
    </div>
  @endif
</div>
@endsection
