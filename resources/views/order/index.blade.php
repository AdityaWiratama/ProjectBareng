@extends('layout')

@section('content')
<div class="container">
    <h2 class="text-center my-4">Buat Pesanan</h2>
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="flavor" class="form-label">Pilih Rasa</label>
            <select class="form-control" id="flavor" name="flavor">
                <option value="Original">Original</option>
                <option value="Coklat">Coklat</option>
                <option value="Keju">Keju</option>
            </select>
        </div>
        <button type="submit" class="btn btn-warning">Pesan Sekarang</button>
    </form>
</div>
@endsection
