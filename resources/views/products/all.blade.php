@extends('layout')

@section('title', 'Semua Produk')

@section('content')
<div class="container my-5">
    <h2 class="text-center mb-4">Semua Produk</h2>
    <div class="row">
        @forelse ($products as $product)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    @else
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="{{ $product->name }}">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text text-muted">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <p class="card-text">{{ Str::limit($product->description, 60) }}</p>
                        <a href="#" class="btn btn-primary mt-auto">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">Belum ada produk.</p>
        @endforelse
    </div>
</div>
@endsection
