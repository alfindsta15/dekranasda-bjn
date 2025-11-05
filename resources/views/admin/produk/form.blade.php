@csrf
<div class="row g-3">
  {{-- NAMA PRODUK --}}
  <div class="col-12">
    <label class="form-label">Nama Produk *</label>
    <input type="text" name="name" class="form-control"
           value="{{ old('name', $product->name ?? '') }}" required>
    @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
  </div>

  {{-- KATEGORI --}}
  <div class="col-md-6">
    <label class="form-label">Kategori *</label>
    <select name="category_id" class="form-select" required>
      <option value="">Pilih Kategori</option>
      @foreach($categories as $c)
        <option value="{{ $c->id }}" @selected(old('category_id', $product->category_id ?? null) == $c->id)>
          {{ $c->name }}
        </option>
      @endforeach
    </select>
    @error('category_id') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
  </div>

  {{-- HARGA (decimal) --}}
  <div class="col-md-3">
    <label class="form-label">Harga *</label>
    <div class="input-group">
      <span class="input-group-text">Rp</span>
      <input type="number" name="price" step="0.01" min="0" class="form-control"
             value="{{ old('price', isset($product)? number_format($product->price, 2, '.', '') : '') }}" required>
    </div>
    @error('price') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
  </div>

  {{-- SATUAN --}}
  <div class="col-md-3">
    <label class="form-label">Satuan *</label>
    <input type="text" name="unit" class="form-control" placeholder="Pcs, Box, Potong, dll"
           value="{{ old('unit', $product->unit ?? '') }}" required>
    @error('unit') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
  </div>

  {{-- DESKRIPSI --}}
  <div class="col-12">
    <label class="form-label">Deskripsi</label>
    <textarea name="description" rows="4" class="form-control">{{ old('description', $product->description ?? '') }}</textarea>
    @error('description') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
  </div>

  {{-- GAMBAR --}}
  <div class="col-12">
    <label class="form-label">Gambar Produk</label>
    <input type="file" name="image" class="form-control" accept=".jpg,.jpeg,.png,.webp">
    @error('image') <div class="text-danger small mt-1">{{ $message }}</div> @enderror

    @if(!empty($product?->image_url))
      <div class="mt-2">
        <img src="{{ $product->image_url }}" height="72" class="rounded" style="object-fit:cover; max-height:72px">
      </div>
    @endif
  </div>

  {{-- ===== INFORMASI PENJUAL ===== --}}
  <div class="col-12">
    <hr class="my-2">
    <h6 class="fw-semibold mb-2">Informasi Penjual</h6>
  </div>

  {{-- PEMILIK --}}
  <div class="col-md-6">
    <label class="form-label">Pemilik</label>
    <input type="text" name="owner_name" class="form-control"
           value="{{ old('owner_name', $product->owner_name ?? '') }}">
    @error('owner_name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
  </div>

  {{-- PHONE / WA --}}
  <div class="col-md-6">
    <label class="form-label">Phone / WhatsApp</label>
    <input type="text" name="owner_phone" class="form-control" placeholder="0812xxxxxxx"
           value="{{ old('owner_phone', $product->owner_phone ?? '') }}">
    @error('owner_phone') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
  </div>

  {{-- ALAMAT --}}
  <div class="col-12">
    <label class="form-label">Alamat</label>
    <textarea name="owner_address" rows="3" class="form-control">{{ old('owner_address', $product->owner_address ?? '') }}</textarea>
    @error('owner_address') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
  </div>

  {{-- INSTAGRAM --}}
  <div class="col-md-6">
    <label class="form-label">Instagram</label>
    <div class="input-group">
      <span class="input-group-text">@</span>
      <input type="text" name="instagram" class="form-control" placeholder="namatoko"
             value="{{ old('instagram', ltrim($product->instagram ?? '', '@')) }}">
    </div>
    <small class="text-muted">Isi tanpa simbol @ (akan disimpan sebagai <code>namatoko</code> dan ditampilkan sebagai <code>@namatoko</code>).</small>
    @error('instagram') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
  </div>

  {{-- STATUS UNGGULAN --}}
  <div class="col-md-3 form-check ms-2">
    <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="unggulan"
           @checked(old('is_featured', $product->is_featured ?? false))>
    <label class="form-check-label" for="unggulan">Produk Unggulan</label>
  </div>

  {{-- AKSI --}}
  <div class="col-12 d-flex gap-2 mt-2">
    <button class="btn btn-primary">
      <i class="bi bi-save me-1"></i> Simpan
    </button>
    <a href="{{ route('admin.produk.index') }}" class="btn btn-outline-secondary">Batal</a>
  </div>
</div>
