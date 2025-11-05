@extends('layouts.app')

@section('title','Struktur Organisasi')

@push('head')
<style>
  :root {
    --ink: #0f172a;
    --muted: #64748b;
    --line: #9ed0ff; /* biru muda soft */
    --ring: #e5e7eb;
    --card: #fff;
  }

  body {
    background-color: #f4f9ff; /* latar belakang biru muda lembut */
  }

  .wrap {
    max-width: 1280px;
    margin: 0 auto;
    padding: 48px 20px 64px;
  }

  /* ====== Judul Halaman ====== */
  .page-title {
    font-weight: 800;
    letter-spacing: .2px;
    font-size: clamp(26px, 3.2vw, 40px);
    color: #4da8ff; /* biru muda soft */
    margin: 0;
    text-align: center;
  }

  .page-sub {
    color: #555;
    margin-top: 6px;
    text-align: center;
  }

  .page-underline {
    width: 180px;
    height: 4px;
    background: var(--line);
    border-radius: 999px;
    margin: 12px auto 36px auto;
  }

  /* ====== Grid ====== */
  .grid {
    display: grid;
    gap: 28px;
    grid-template-columns: repeat(4, minmax(0, 1fr));
  }
  @media (max-width:1100px){.grid{grid-template-columns:repeat(3,1fr)}}
  @media (max-width:820px){.grid{grid-template-columns:repeat(2,1fr)}}
  @media (max-width:520px){.grid{grid-template-columns:1fr}}

  /* ====== Card ====== */
  .card {
    background: var(--card);
    border: 1px solid var(--ring);
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 10px 24px rgba(0,0,0,.06);
    transition: transform .25s, box-shadow .25s;
  }
  .card:hover {
    transform: translateY(-4px);
    box-shadow: 0 14px 28px rgba(0,0,0,.08);
  }

  .avatar {
    display: grid;
    place-items: center;
    background: #f8fafc;
    padding: 18px 0 6px;
  }

  .avatar-oval {
    width: 76%;
    aspect-ratio: 3/4;
    background: #e2e8f0;
    border-radius: 50% / 38%;
    box-shadow: inset 0 1px 0 rgba(255,255,255,.6),
                0 8px 20px rgba(0,0,0,.07);
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .avatar-oval img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    display: block;
  }

  .body {
    padding: 12px 16px 18px;
    text-align: center;
  }

  .name {
    font-weight: 800;
    color: #111827;
    font-size: clamp(15px, 2.2vw, 18px);
  }

  .pos {
    margin-top: 6px;
    color: var(--muted);
    font-size: 14px;
  }

  .desc {
    margin-top: 6px;
    color: #9ca3af;
    font-size: 12px;
  }
</style>
@endpush

@section('content')
  <div class="wrap">
    <h1 class="page-title">STRUKTUR ORGANISASI</h1>
    <div class="page-sub">Dekranasda Kabupaten Bojonegoro</div>
    <div class="page-underline"></div>

    @if($members->count())
      <div class="grid">
        @foreach($members as $m)
          <div class="card">
            <div class="avatar">
              <div class="avatar-oval">
                <img src="{{ $m->photo_url }}"
                     alt="{{ $m->name }}"
                     loading="lazy"
                     onerror="this.onerror=null;this.src='{{ asset('images/placeholder-person.png') }}';">
              </div>
            </div>
            <div class="body">
              <div class="name">{{ $m->name }}</div>
              <div class="pos">{{ $m->position }}</div>
              @if($m->description)
                <div class="desc">{{ $m->description }}</div>
              @endif
            </div>
          </div>
        @endforeach
      </div>
    @else
      <p class="text-muted text-center mt-4">Data struktur organisasi belum tersedia.</p>
    @endif
  </div>
@endsection
