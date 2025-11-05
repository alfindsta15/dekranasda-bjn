@extends('layouts.admin')

@section('title', 'Struktur Organisasi')

@section('content')
<div class="container py-4">

    {{-- Judul Halaman --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold mb-0">Struktur Organisasi</h2>
        <a href="{{ route('admin.organisasi.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Tambah Anggota
        </a>
    </div>

    {{-- Notifikasi --}}
    @if (session('ok'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('ok') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Tabel Daftar Anggota --}}
    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Urutan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($members as $m)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ $m->photo_url }}" alt="Foto" width="60" class="rounded">
                            </td>
                            <td>{{ $m->name }}</td>
                            <td>{{ $m->position }}</td>
                            <td>{{ $m->order }}</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-warning" 
                                        data-bs-toggle="modal"
                                        data-bs-target="#editModal{{ $m->id }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>

                                <form action="{{ route('admin.organisasi.destroy', $m->id) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Hapus anggota ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        {{-- Modal Edit --}}
                        <div class="modal fade" id="editModal{{ $m->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('admin.organisasi.update', $m->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Anggota</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label>Nama</label>
                                                <input type="text" name="name" value="{{ $m->name }}" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>Jabatan</label>
                                                <input type="text" name="position" value="{{ $m->position }}" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>Deskripsi</label>
                                                <textarea name="description" class="form-control" rows="3">{{ $m->description }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label>Urutan</label>
                                                <input type="number" name="order" value="{{ $m->order }}" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label>Foto Baru (opsional)</label>
                                                <input type="file" name="photo" class="form-control">
                                                @if($m->photo_path)
                                                    <small class="text-muted">Foto saat ini: {{ basename($m->photo_path) }}</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-3">Belum ada anggota organisasi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal Tambah Anggota --}}
<div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.organisasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Anggota Organisasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Jabatan</label>
                        <input type="text" name="position" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Urutan</label>
                        <input type="number" name="order" class="form-control" value="0">
                    </div>
                    <div class="mb-3">
                        <label>Foto</label>
                        <input type="file" name="photo" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Jika route create dipanggil, langsung buka modal tambah --}}
@if (session('showCreateModal'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modal = new bootstrap.Modal(document.getElementById('createModal'));
            modal.show();
        });
    </script>
@endif

@endsection
