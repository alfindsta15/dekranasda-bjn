{{-- resources/views/admin/news/create.blade.php --}}
@extends('layouts.admin')

@section('title','Tambah Berita')
@section('page_title','Tambah Berita')

@section('top_actions')
  <a href="{{ route('admin.news.index') }}" class="btn btn-outline-secondary">Kembali</a>
@endsection

@section('content')
  @if ($errors->any())
    <div class="alert alert-danger">
      <div class="fw-semibold mb-1">Periksa kembali isian Anda:</div>
      <ul class="mb-0">
        @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
      </ul>
    </div>
  @endif

  <div class="card">
    <div class="card-body">
      <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
          <label class="form-label">Judul Berita <span class="text-danger">*</span></label>
          <input type="text" name="title" class="form-control" value="{{ old('title') }}" required maxlength="255">
        </div>

        <div class="mb-3">
          <label class="form-label">Konten <span class="text-danger">*</span></label>
          <textarea name="content" rows="8" class="form-control" required>{{ old('content') }}</textarea>
        </div>

        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Gambar</label>
            <input type="file" name="image" class="form-control" accept="image/*">
            <div class="form-text">JPG/PNG/WEBP, maks 2MB.</div>
          </div>
          <div class="col-md-6">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
              <option value="published" @selected(old('status')==='published')>Published</option>
              <option value="draft"     @selected(old('status')==='draft')>Draft</option>
            </select>
          </div>
        </div>

        <div class="mt-4 d-flex gap-2">
          <button class="btn btn-primary"><i class="bi bi-save me-1"></i> Simpan</button>
          <a href="{{ route('admin.news.index') }}" class="btn btn-outline-secondary">Batal</a>
        </div>
      </form>
    </div>
  </div>
@endsection
