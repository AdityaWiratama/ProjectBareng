@extends('layout')

@section('title', 'Manajemen Produk')

@section('hideFooter')
@endsection

@php
    use Illuminate\Support\Str;
@endphp

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">📦 Manajemen Produk</h1>

    {{-- Flash Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">+ Tambah Produk</a>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-warning">
                <tr class="text-center">
                    <th>#</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Deskripsi</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $index => $product)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $product->name }}</td>
                        <td>Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                        <td>{{ $product->description }}</td>
                        <td class="text-center">
                            @if($product->image)
                                @if(Str::startsWith($product->image, ['http://', 'https://']))
                                    <img src="{{ $product->image }}" alt="{{ $product->name }}" width="80" class="rounded shadow-sm">
                                @else
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="80" class="rounded shadow-sm">
                                @endif
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex flex-column gap-1">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-warning w-100">
                                    <i class="fas fa-edit me-1"></i> Edit
                                </a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="w-100" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger w-100">
                                        <i class="fas fa-trash-alt me-1"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada produk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
