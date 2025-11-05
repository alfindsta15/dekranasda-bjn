{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('title','Dashboard')
@section('page_title','Dashboard')

{{-- Kanan-atas: info admin --}}
@section('top_actions')
  <div class="d-flex align-items-center gap-3">
    <div class="text-end">
      <div class="fw-semibold">{{ auth()->user()->name ?? 'Administrator' }}</div>
      <small class="text-muted">Administrator</small>
    </div>
    <div class="rounded-circle d-flex align-items-center justify-content-center"
         style="width:40px;height:40px;background:#e0f2fe;border:1px solid #cfe8ff;">
      <i class="bi bi-person"></i>
    </div>
  </div>
@endsection

@push('head')
<style>
  :root{
    --sky-50:#f0f9ff; --sky-100:#e0f2fe; --sky-200:#bae6fd; --sky-300:#7dd3fc;
    --primary:#3b82f6; --text:#0f172a; --muted:#64748b;
  }
  .kpi-card{
    background: var(--sky-100);
    border: 1px solid #cfe8ff;
    border-radius: 16px;
    box-shadow: 0 8px 24px rgba(15,23,42,.06);
  }
  .kpi-card .icon{
    width:44px;height:44px;border-radius:12px;
    background: var(--sky-200);
    display:flex;align-items:center;justify-content:center;
  }
  .section-title{ font-weight:700; color:var(--text); }
  .quick-card{
    border:1px dashed #cfe0ff; background:var(--sky-50); border-radius:14px;
    transition: all .15s ease; height:100%;
  }
  .quick-card:hover{ border-color:#9cc6ff; transform: translateY(-1px); }
</style>
@endpush

@section('content')
<div class="container-fluid px-0">

  {{-- RINGKASAN (KPI) --}}
  <div class="row g-3">
    <div class="col-12 col-md-3">
      <div class="kpi-card p-3">
        <div class="d-flex align-items-center gap-3">
          <div class="icon"><i class="bi bi-box-seam"></i></div>
          <div>
            <div class="text-muted small">Total Produk</div>
            <div class="fs-3 fw-bold">{{ $totalProduk ?? 0 }}</div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-3">
      <div class="kpi-card p-3">
        <div class="d-flex align-items-center gap-3">
          <div class="icon"><i class="bi bi-newspaper"></i></div>
          <div>
            <div class="text-muted small">Total Berita</div>
            <div class="fs-3 fw-bold">{{ $totalBerita ?? 0 }}</div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-3">
      <div class="kpi-card p-3">
        <div class="d-flex align-items-center gap-3">
          <div class="icon"><i class="bi bi-people"></i></div>
          <div>
            <div class="text-muted small">Total Binaan</div>
            <div class="fs-3 fw-bold">{{ $totalBinaan ?? 0 }}</div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-3">
      <div class="kpi-card p-3">
        <div class="d-flex align-items-center gap-3">
          <div class="icon"><i class="bi bi-envelope"></i></div>
          <div>
            <div class="text-muted small">Pesan Masuk</div>
            <div class="fs-3 fw-bold">{{ $totalPesan ?? 0 }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- AKSI CEPAT --}}
  <div class="d-flex align-items-center justify-content-between mt-4 mb-2">
    <h5 class="section-title mb-0">Aksi Cepat</h5>
  </div>
  <div class="row g-3">
    <div class="col-12 col-md-3">
      <a class="text-decoration-none d-block" href="{{ route('admin.produk.create') }}">
        <div class="quick-card p-3 text-center">
          <div class="display-6">+</div>
          <div class="fw-semibold">Tambah Produk</div>
        </div>
      </a>
    </div>
    <div class="col-12 col-md-3">
      <a class="text-decoration-none d-block" href="{{ route('admin.news.create') }}">
        <div class="quick-card p-3 text-center">
          <div class="display-6">+</div>
          <div class="fw-semibold">Tambah Berita</div>
        </div>
      </a>
    </div>
    <div class="col-12 col-md-3">
      <a class="text-decoration-none d-block" href="{{ route('admin.organisasi.create') }}">
        <div class="quick-card p-3 text-center">
          <div class="display-6">+</div>
          <div class="fw-semibold">Tambah Anggota</div>
        </div>
      </a>
    </div>
    <div class="col-12 col-md-3">
      <a class="text-decoration-none d-block" href="{{ route('admin.binaan.create') }}">
        <div class="quick-card p-3 text-center">
          <div class="display-6">+</div>
          <div class="fw-semibold">Tambah Binaan</div>
        </div>
      </a>
    </div>
  </div>

  {{-- AKTIVITAS TERBARU --}}
  <div class="d-flex align-items-center justify-content-between mt-5 mb-2">
    <h5 class="section-title mb-0">Aktivitas Terbaru</h5>
  </div>
  <div class="card shadow-sm border-0">
    <div class="list-group list-group-flush">
      @forelse(($aktivitas ?? []) as $a)
        <div class="list-group-item d-flex align-items-start gap-3">
          <div class="rounded-circle d-flex align-items-center justify-content-center"
               style="width:36px;height:36px;background:var(--sky-200);">
            <i class="bi bi-dot"></i>
          </div>
          <div>
            <div class="fw-semibold">{{ $a['judul'] }}</div>
            <small class="text-muted">{{ $a['waktu'] }}</small>
          </div>
        </div>
      @empty
        <div class="list-group-item text-muted">Belum ada aktivitas terbaru.</div>
      @endforelse
    </div>
  </div>

  {{-- PREVIEW WEBSITE --}}
  <div class="d-flex align-items-center justify-content-between mt-5 mb-2">
    <h5 class="section-title mb-0">Preview Website</h5>
  </div>
  <div class="card shadow-sm border-0 p-3" style="background:var(--sky-50);">
    <div class="d-flex gap-2">
      <a href="{{ url('/') }}" target="_blank" class="btn btn-primary">
        <i class="bi bi-box-arrow-up-right me-1"></i> Lihat Website
      </a>
      <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary">
        <i class="bi bi-arrow-clockwise me-1"></i> Refresh Data
      </a>
    </div>
  </div>

</div>
@endsection
