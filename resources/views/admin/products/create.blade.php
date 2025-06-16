@extends('layout')

@section('title', 'Tambah Produk')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">Tambah Produk Baru</h1>

    {{-- Tampilkan error validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Create --}}
    @include('admin.products.form')
</div>
@endsection
