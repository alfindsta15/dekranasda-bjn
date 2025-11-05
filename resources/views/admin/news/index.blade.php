{{-- resources/views/admin/news/index.blade.php --}}
@extends('layouts.admin')

@section('title','Kelola Berita')
@section('page_title','Kelola Berita')

@section('top_actions')
  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate">
    <i class="bi bi-plus-lg me-1"></i> Tambah Berita
  </button>
@endsection

@push('head')
<style>
  .table td, .table th { vertical-align: middle; }
  .badge-soft-success{background:#e8f7ee;color:#198754;border:1px solid #bfe9d1}
  .badge-soft-secondary{background:#eef2f6;color:#6c757d;border:1px solid #dfe3e7}
  .thumb{width:60px;height:42px;object-fit:cover;border-radius:.25rem;border:1px solid rgba(0,0,0,.06)}
  .card-shadow{box-shadow:0 4px 14px rgba(0,0,0,.06)}
</style>
@endpush

@section('content')
  {{-- flash --}}
  @if(session('ok'))    <div class="alert alert-success">{{ session('ok') }}</div> @endif
  @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif

  <div class="card card-shadow">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table align-middle">
          <thead class="table-light">
            <tr>
              <th style="width:64px;">No</th>
              <th>Judul</th>
              <th style="width:100px;">Gambar</th>
              <th style="width:160px;">Tanggal</th>
              <th style="width:120px;">Status</th>
              <th style="width:140px;">Aksi</th>
            </tr>
          </thead>
          <tbody>
          @forelse($news as $n)
            <tr>
              <td>{{ ($news->currentPage()-1)*$news->perPage() + $loop->iteration }}</td>
              <td class="fw-semibold">{{ $n->title }}</td>
              <td>
                <img class="thumb" src="{{ $n->image_url }}" alt="thumb">
              </td>
              <td>{{ optional($n->created_at)->format('d/m/Y') }}</td>
              <td>
                @if(($n->status ?? 'draft') === 'published')
                  <span class="badge badge-soft-success">published</span>
                @else
                  <span class="badge badge-soft-secondary">draft</span>
                @endif
              </td>
              <td class="d-flex gap-2">
                <a href="{{ route('admin.news.edit',$n) }}" class="btn btn-sm btn-info">Edit</a>
                <form action="{{ route('admin.news.destroy',$n) }}" method="POST"
                      onsubmit="return confirm('Hapus berita ini?')">
                  @csrf @method('DELETE')
                  <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td colspan="6" class="text-center text-muted">Belum ada berita.</td></tr>
          @endforelse
          </tbody>
        </table>
      </div>

      {{-- pagination --}}
      <div class="mt-3">
        {{ $news->links() }}
      </div>
    </div>
  </div>

  {{-- Modal: Tambah Berita --}}
  <div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="modalCreateLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
        <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data" id="formCreateNews">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="modalCreateLabel">Tambah Berita</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>

          <div class="modal-body">
            @if($errors->any())
              <div class="alert alert-danger">
                <div class="fw-semibold mb-1">Periksa kembali isian Anda:</div>
                <ul class="mb-0">
                  @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
                </ul>
              </div>
            @endif

            <div class="mb-3">
              <label class="form-label">Judul Berita <span class="text-danger">*</span></label>
              <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Konten <span class="text-danger">*</span></label>
              <textarea name="content" rows="6" class="form-control" required>{{ old('content') }}</textarea>
            </div>

            <div class="mb-3">
              <label class="form-label">Gambar</label>
              <input type="file" name="image" class="form-control" accept="image/*">
              <div class="form-text">JPG/PNG/WEBP, maks 2MB.</div>
            </div>

            <div class="mb-3">
              <label class="form-label">Status</label>
              <select name="status" class="form-select">
                <option value="published" @selected(old('status')==='published')>Published</option>
                <option value="draft"     @selected(old('status')==='draft')>Draft</option>
              </select>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
<script>
(function(){
  const modalEl = document.getElementById('modalCreate');
  if (!modalEl) return;

  // reset form & bersihkan alert saat modal ditutup
  modalEl.addEventListener('hidden.bs.modal', () => {
    const f = document.getElementById('formCreateNews');
    if (f) f.reset();
    modalEl.querySelectorAll('.alert').forEach(a => a.remove());
  });

  // kalau ada error validasi dari server, buka modal otomatis
  @if ($errors->any())
    const createModal = new bootstrap.Modal(modalEl);
    createModal.show();
  @endif
})();
</script>
@endpush
