@extends('layouts.admin')

@section('title','Kelola Produk')
@section('page_title','Kelola Produk')

@section('top_actions')
  <a href="{{ route('admin.produk.create') }}" class="btn btn-primary">
    <i class="bi bi-plus-lg me-1"></i> Tambah Produk
  </a>
@endsection

@section('content')
  <div class="card card-shadow">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table align-middle">
          <thead class="table-light">
            <tr>
              <th style="width:90px;">Gambar</th>
              <th>Nama Produk</th>
              <th style="width:140px;">Kategori</th>
              <th style="width:160px;">Harga</th>
              <th style="width:120px;">Status</th>
              <th style="width:110px;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($products as $p)
            <tr>
              <td>
                <img src="{{ $p->image_url ?? asset('images/placeholder.png') }}" class="rounded" width="64" height="48" style="object-fit:cover">
              </td>
              <td>
                <div class="fw-semibold">{{ $p->name }}</div>
                @if($p->is_featured)
                  <span class="badge text-bg-warning">UNGGULAN</span>
                @endif
              </td>
              <td>{{ $p->category->name ?? '-' }}</td>
              <td>Rp {{ number_format($p->price,0,',','.') }}/{{ $p->unit }}</td>
              <td>
                <span class="badge {{ $p->is_active ? 'text-bg-success':'text-bg-secondary' }}">
                  {{ $p->is_active ? 'AKTIF':'NONAKTIF' }}
                </span>
              </td>
              <td class="d-flex gap-2">
                <a href="{{ route('admin.produk.edit',$p) }}" class="btn btn-sm btn-info"><i class="bi bi-pencil"></i></a>
                <form method="POST" action="{{ route('admin.produk.destroy',$p) }}" onsubmit="return confirm('Hapus produk ini?')">
                  @csrf @method('DELETE')
                  <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                </form>
              </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center text-muted">Belum ada data.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
      {{ $products->links() }}
    </div>
  </div>
@endsection
