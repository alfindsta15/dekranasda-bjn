{{-- resources/views/admin/produk/edit.blade.php --}}
@extends('layouts.admin')
@section('title','Edit Produk')
@section('page_title','Kelola Produk')
@section('top_actions')
  <a href="{{ route('admin.produk.index') }}" class="btn btn-outline-secondary">Kembali</a>
@endsection
@section('content')
  <div class="card card-shadow">
    <div class="card-body">
      <h5 class="mb-3">Edit Produk</h5>
      <form method="POST" action="{{ route('admin.produk.update',$product) }}" enctype="multipart/form-data">
        @method('PUT')
        @include('admin.produk.form', ['product'=>$product])
      </form>
    </div>
  </div>
@endsection
