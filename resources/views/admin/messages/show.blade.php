@extends('layouts.admin')

@section('title', 'Detail Pesan')

@section('content')
<div class="container py-4">
  <h1 class="h3 mb-4 fw-bold">Detail Pesan</h1>

  <div class="card shadow-sm">
    <div class="card-body">
      <p><strong>Nama:</strong> {{ $message->name }}</p>
      <p><strong>Email:</strong> {{ $message->email }}</p>
      <p><strong>Tanggal:</strong> {{ $message->created_at->format('d M Y H:i') }}</p>
      <hr>
      <p>{{ $message->body }}</p>
    </div>
  </div>

  <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary mt-3">← Kembali</a>
</div>
@endsection
