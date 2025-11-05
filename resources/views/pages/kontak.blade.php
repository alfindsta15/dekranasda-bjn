@extends('layouts.app')

@section('title', 'Kontak Kami')

@push('head')
<style>
  .contact-section {
    background-color: #E6F4FA;
  }
  .contact-card {
    border: none;
    border-radius: 1rem;
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.1);
  }
  .contact-icon {
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: #fff;
    border: 1px solid #ddd;
    transition: all 0.3s ease;
  }
  .contact-icon:hover {
    transform: scale(1.1);
  }
  .form-control:focus {
    border-color: #4da8ff;
    box-shadow: 0 0 0 0.25rem rgba(77,168,255,0.25);
  }
</style>
@endpush

@section('content')
<section class="py-5 contact-section">
  <div class="container py-5">
    <div class="row g-5 align-items-start">

      {{-- BAGIAN KIRI: Info Kontak --}}
      <aside class="col-md-5">
        <div class="card contact-card">
          <div class="card-body p-4">
            <h2 class="fw-bold mb-3" style="font-size: 1.8rem;">Kontak Kami</h2>
            <p class="text-muted mb-4">
              Hubungi kami melalui media sosial resmi berikut:
            </p>

            <ul class="list-unstyled">
              @foreach($socials as $s)
                @php $icon = $s['icon'] ?? ''; @endphp
                @if(!in_array($icon, ['instagram','youtube'])) @continue @endif
                <li class="mb-4">
                  <a href="{{ $s['url'] }}" target="_blank" rel="noopener" class="d-flex align-items-center text-decoration-none">
                    <div class="contact-icon me-3">
                      @if($icon === 'instagram')
                        <i class="bi bi-instagram fs-4 text-primary"></i>
                      @else
                        <i class="bi bi-youtube fs-4 text-danger"></i>
                      @endif
                    </div>
                    <span class="fw-semibold text-dark">{{ $s['label'] }}</span>
                  </a>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
      </aside>

      {{-- BAGIAN KANAN: Form Pesan --}}
      <section class="col-md-7">
        <div class="card contact-card">
          <div class="card-body p-4">
            <h1 class="fw-bold text-center text-md-start mb-3" style="font-size: 1.8rem;">Kirim Sebuah Pesan</h1>
            <p class="text-muted text-center text-md-start mb-4">
              Silakan kirim pesan di bawah ini jika ada pertanyaan atau saran untuk kami.
            </p>

            {{-- Alert Validasi --}}
            @if ($errors->any())
              <div class="alert alert-danger">
                <strong>Oops!</strong> Ada beberapa data yang belum benar. Silakan periksa kembali.
              </div>
            @endif

            {{-- Alert Sukses --}}
            @if (session('success'))
              <div class="alert alert-success">
                {{ session('success') }}
              </div>
            @endif

            <form method="POST" action="{{ route('kontak.store') }}">
              @csrf

              <div class="row g-3 mb-3">
                <div class="col-md-6">
                  <label for="name" class="form-label fw-semibold">Nama</label>
                  <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name') }}" 
                    class="form-control @error('name') is-invalid @enderror" 
                    placeholder="Nama Lengkap">
                  @error('name') 
                    <div class="invalid-feedback">{{ $message }}</div> 
                  @enderror
                </div>
                <div class="col-md-6">
                  <label for="email" class="form-label fw-semibold">Email</label>
                  <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    class="form-control @error('email') is-invalid @enderror" 
                    placeholder="Alamat Email">
                  @error('email') 
                    <div class="invalid-feedback">{{ $message }}</div> 
                  @enderror
                </div>
              </div>

              <div class="mb-3">
                <label for="body" class="form-label fw-semibold">Pesan</label>
                <textarea 
                  id="body" 
                  name="body" 
                  rows="6" 
                  class="form-control @error('body') is-invalid @enderror" 
                  placeholder="Tulis pesan kamu di sini...">{{ old('body') }}</textarea>
                @error('body') 
                  <div class="invalid-feedback">{{ $message }}</div> 
                @enderror
              </div>

              <div class="text-center text-md-start">
                <button type="submit" class="btn btn-primary px-4 py-2">
                  <i class="bi bi-send me-2"></i> Kirim Pesan
                </button>
              </div>
            </form>
          </div>
        </div>
      </section>

    </div>
  </div>
</section>
@endsection
