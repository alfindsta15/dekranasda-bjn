{{-- resources/views/admin/produk/create.blade.php --}}
@extends('layouts.admin')
@section('title','Tambah Produk')
@section('page_title','Kelola Produk')
@section('top_actions')
  <a href="{{ route('admin.produk.index') }}" class="btn btn-outline-secondary">Kembali</a>
@endsection
@section('content')
  <div class="card card-shadow">
    <div class="card-body">
      <h5 class="mb-3">Tambah Produk Baru</h5>
      <form method="POST" action="{{ route('admin.produk.store') }}" enctype="multipart/form-data">
        @include('admin.produk.form', ['product'=>null])
      </form>
    </div>
  </div>
@endsection
