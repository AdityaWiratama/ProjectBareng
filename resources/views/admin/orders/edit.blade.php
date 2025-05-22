@extends('layouts.editnavbar')

@section('title', 'Edit Pesanan')

@section('content')
<div class="container py-5">
    <h1 class="fw-bold mb-4">✏️ Edit Status Pesanan</h1>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $order->name }}">
                </div>

                <div class="mb-3">
                    <label for="product" class="form-label">Produk</label>
                    <input type="text" id="product" name="product" class="form-control" value="{{ str_replace('-', ' ', $order->product_slug) }}">
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Menunggu</option>
                        <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Dikirim</option>
                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
