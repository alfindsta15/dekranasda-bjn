@extends('layouts.admin')
@section('title','Tambah Binaan')
@section('page_title','Tambah Binaan')

@section('content')
  <div class="card card-shadow">
    <div class="card-body">
      <form method="POST" action="{{ route('admin.binaan.store') }}" enctype="multipart/form-data">
        @csrf

        {{-- Gambar (foto utama) --}}
        <div class="mb-3">
          <label class="form-label">Gambar</label>
          <input type="file" name="image"
                 accept="image/*"
                 class="form-control @error('image') is-invalid @enderror">
          <div class="form-text">Format: JPG/PNG, maks 2MB.</div>
          @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Nama Usaha --}}
        <div class="mb-3">
          <label class="form-label">Nama Usaha</label>
          <input type="text" name="name"
                 class="form-control @error('name') is-invalid @enderror"
                 value="{{ old('name') }}" required>
          @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Alamat --}}
        <div class="mb-3">
          <label class="form-label">Alamat</label>
          <textarea name="address" rows="2"
                    class="form-control @error('address') is-invalid @enderror"
                    required>{{ old('address') }}</textarea>
          @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- No HP --}}
        <div class="mb-3">
          <label class="form-label">No HP</label>
          <input type="text" name="phone"
                 class="form-control @error('phone') is-invalid @enderror"
                 value="{{ old('phone') }}" required>
          @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Instagram (opsional) --}}
        <div class="mb-3">
          <label class="form-label">Instagram (opsional)</label>
          <input type="text" name="instagram"
                 placeholder="@username atau url"
                 class="form-control @error('instagram') is-invalid @enderror"
                 value="{{ old('instagram') }}">
          @error('instagram') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Facebook (opsional) --}}
        <div class="mb-3">
          <label class="form-label">Facebook (opsional)</label>
          <input type="text" name="facebook"
                 placeholder="nama halaman atau url"
                 class="form-control @error('facebook') is-invalid @enderror"
                 value="{{ old('facebook') }}">
          @error('facebook') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Email --}}
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email"
                 class="form-control @error('email') is-invalid @enderror"
                 value="{{ old('email') }}">
          @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Status --}}
        <div class="mb-3">
          <label class="form-label">Status</label>
          <select name="status" class="form-select @error('status') is-invalid @enderror" required>
            <option value="aktif"    {{ old('status')=='aktif'?'selected':'' }}>Aktif</option>
            <option value="nonaktif" {{ old('status')=='nonaktif'?'selected':'' }}>Nonaktif</option>
          </select>
          @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="d-flex gap-2">
          <a href="{{ route('admin.binaan.index') }}" class="btn btn-outline-secondary">Batal</a>
          <button class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
@endsection
