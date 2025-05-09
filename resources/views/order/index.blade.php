@extends('layout')

@section('content')
<div class="container">
    <h2 class="text-center my-4">Buat Pesanan</h2>
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <!-- Nama -->
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <!-- Telepon -->
        <div class="mb-3">
            <label for="phone" class="form-label">Nomor Telepon</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>

        <!-- Alamat -->
        <div class="mb-3">
            <label for="address" class="form-label">Alamat Pengiriman</label>
            <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
        </div>

        <!-- Jumlah Pesanan -->
        <div class="mb-3">
            <label for="quantity" class="form-label">Jumlah Pesanan</label>
            <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
        </div>

        <!-- Varian Rasa -->
        <div class="mb-3">
            <label for="flavor" class="form-label">Pilih Rasa</label>
            <select class="form-control" id="flavor" name="flavor" required>
                <option value="Original">Original</option>
                <option value="Coklat">Coklat</option>
                <option value="Keju">Keju</option>
            </select>
        </div>

        <button type="submit" class="btn btn-warning">Pesan Sekarang</button>
    </form>
</div>
@endsection
