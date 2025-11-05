@extends('layouts.admin')
@section('title','Edit Binaan')
@section('page_title','Edit Binaan')

@section('content')
  <div class="card card-shadow">
    <div class="card-body">
      <form method="POST" action="{{ route('admin.binaan.update', $binaan) }}" enctype="multipart/form-data">
        @csrf @method('PUT')

        {{-- Gambar --}}
        <div class="mb-3">
          <label class="form-label d-block">Gambar</label>

          @if($binaan->image)
            @php
              // Jika image sudah URL penuh (http/https) pakai langsung,
              // kalau tidak, ambil dari /storage (symlink publik).
              $currentImage = \Illuminate\Support\Str::startsWith($binaan->image, ['http://','https://'])
                ? $binaan->image
                : asset('storage/' . ltrim($binaan->image, '/'));
            @endphp
            <div class="mb-2">
              <img src="{{ $currentImage }}"
                   alt="Gambar saat ini" class="rounded border" style="max-height:140px">
            </div>
            <div class="form-check mb-2">
              <input class="form-check-input" type="checkbox" name="remove_image" id="remove_image" value="1">
              <label class="form-check-label" for="remove_image">Hapus gambar saat ini</label>
            </div>
          @endif

          <input type="file" name="image" accept="image/*"
                 class="form-control @error('image') is-invalid @enderror">
          <div class="form-text">Biarkan kosong jika tidak ingin mengganti. Maks 2MB (JPG/PNG).</div>
          @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Nama Usaha --}}
        <div class="mb-3">
          <label class="form-label">Nama Usaha</label>
          <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                 value="{{ old('name', $binaan->name) }}" required>
          @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Alamat --}}
        <div class="mb-3">
          <label class="form-label">Alamat</label>
          <textarea name="address" rows="2" class="form-control @error('address') is-invalid @enderror" required>{{ old('address', $binaan->address) }}</textarea>
          @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- No HP --}}
        <div class="mb-3">
          <label class="form-label">No HP</label>
          <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                 value="{{ old('phone', $binaan->phone) }}" required>
          @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Instagram (opsional) --}}
        <div class="mb-3">
          <label class="form-label">Instagram (opsional)</label>
          <input type="text" name="instagram" placeholder="@username atau url"
                 class="form-control @error('instagram') is-invalid @enderror"
                 value="{{ old('instagram', $binaan->instagram) }}">
          @error('instagram') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Facebook (opsional) --}}
        <div class="mb-3">
          <label class="form-label">Facebook (opsional)</label>
          <input type="text" name="facebook" placeholder="nama halaman atau url"
                 class="form-control @error('facebook') is-invalid @enderror"
                 value="{{ old('facebook', $binaan->facebook) }}">
          @error('facebook') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Email --}}
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                 value="{{ old('email', $binaan->email) }}">
          @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Status --}}
        <div class="mb-3">
          <label class="form-label">Status</label>
          <select name="status" class="form-select @error('status') is-invalid @enderror" required>
            <option value="aktif" {{ old('status',$binaan->status)=='aktif'?'selected':'' }}>Aktif</option>
            <option value="nonaktif" {{ old('status',$binaan->status)=='nonaktif'?'selected':'' }}>Nonaktif</option>
          </select>
          @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="d-flex gap-2">
          <a href="{{ route('admin.binaan.index') }}" class="btn btn-outline-secondary">Kembali</a>
          <button class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
@endsection
