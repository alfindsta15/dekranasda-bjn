@extends('layouts.admin')
@section('title','Data Binaan')
@section('page_title','Data Binaan')

@section('top_actions')
  <a href="{{ route('admin.binaan.create') }}" class="btn btn-primary">
    <i class="bi bi-plus-lg me-1"></i> Tambah Binaan
  </a>
@endsection

@section('content')
  @if(session('ok')) <div class="alert alert-success">{{ session('ok') }}</div> @endif

  <div class="card card-shadow">
    <div class="card-body p-0">
      <table class="table mb-0 align-middle">
        <thead class="table-light">
          <tr>
            <th style="width:60px">No</th>
            <th>Nama</th>
            <th>Kontak</th>
            <th>Status</th>
            <th class="text-end" style="width:180px">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($binaan as $row)
            @php
              // Ambil URL gambar yang aman: gunakan accessor image_url jika ada,
              // jika tidak ada accessor, fallback ke asset('storage/...').
              $thumb = method_exists($row, 'getAttribute') && !empty($row->image_url)
                       ? $row->image_url
                       : ($row->image ? asset('storage/' . ltrim($row->image, '/')) : null);
            @endphp
            <tr>
              {{-- Nomor urut paginasi --}}
              <td>{{ ($binaan->currentPage()-1)*$binaan->perPage() + $loop->iteration }}</td>

              {{-- Nama + thumbnail --}}
              <td>
                <div class="d-flex align-items-center gap-2">
                  @if($thumb)
                    <img src="{{ $thumb }}" alt="{{ $row->name ?? 'Foto' }}"
                         style="width:40px;height:40px;object-fit:cover;border-radius:6px;border:1px solid #e5e7eb">
                  @else
                    <div style="width:40px;height:40px;border-radius:6px;background:#f3f4f6;border:1px solid #e5e7eb"></div>
                  @endif
                  <div>
                    <div class="fw-semibold">{{ $row->name ?? '-' }}</div>
                    @if(!empty($row->address))
                      <div class="text-muted small">{{ $row->address }}</div>
                    @endif
                  </div>
                </div>
              </td>

              {{-- Kontak (HP + email kecil) --}}
              <td>
                <div>{{ $row->phone ?: '-' }}</div>
                @if(!empty($row->email))
                  <div class="text-muted small">{{ $row->email }}</div>
                @endif
              </td>

              {{-- Status --}}
              <td>
                <span class="badge {{ ($row->status ?? 'nonaktif') === 'aktif' ? 'bg-success' : 'bg-secondary' }}">
                  {{ strtoupper($row->status ?? 'nonaktif') }}
                </span>
              </td>

              {{-- Aksi --}}
              <td class="text-end">
                <a class="btn btn-sm btn-info" href="{{ route('admin.binaan.edit', $row) }}" title="Edit">
                  <i class="bi bi-pencil"></i>
                </a>
                <form class="d-inline" method="POST"
                      action="{{ route('admin.binaan.destroy', $row) }}"
                      onsubmit="return confirm('Hapus data ini?')">
                  @csrf @method('DELETE')
                  <button class="btn btn-sm btn-danger" title="Hapus">
                    <i class="bi bi-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="text-center py-4 text-muted">Belum ada data.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    <div class="card-footer">
      {{ $binaan->links() }}
    </div>
  </div>
@endsection
