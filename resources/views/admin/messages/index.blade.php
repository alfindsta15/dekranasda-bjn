@extends('layouts.admin')

@section('title', 'Pesan Masuk')

@section('content')
<div class="container py-4">
  <h1 class="h3 mb-4 fw-bold">📩 Pesan Masuk</h1>

  @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if ($messages->isEmpty())
    <div class="alert alert-info">Belum ada pesan yang masuk.</div>
  @else
  <div class="card shadow-sm">
    <div class="card-body table-responsive">
      <table class="table table-bordered align-middle">
        <thead class="table-light">
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Pesan</th>
            <th>Status</th>
            <th>Tanggal</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($messages as $index => $msg)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $msg->name }}</td>
            <td>{{ $msg->email }}</td>
            <td>{{ Str::limit($msg->body, 50) }}</td>
            <td>
              @if($msg->is_read)
                <span class="badge bg-success">Dibaca</span>
              @else
                <span class="badge bg-warning text-dark">Baru</span>
              @endif
            </td>
            <td>{{ $msg->created_at->format('d M Y H:i') }}</td>
            <td>
              <a href="{{ route('admin.messages.show', $msg->id) }}" class="btn btn-sm btn-info">Lihat</a>
              <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus pesan ini?')">Hapus</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  @endif
</div>
@endsection
