@extends('layout')

@section('title', 'Pemesanan - Bika Ambon Order')

@section('content')
<div class="container py-5">
    <h1 class="text-center fw-bold mb-4">Pesan <span class="text-warning">Bika Ambon</span> Favoritmu!</h1>
    <p class="text-center text-muted">Pilih varian rasa dan jumlah yang kamu inginkan, lalu lakukan pemesanan dengan mudah.</p>

    <div class="row mt-5">
        <div class="col-md-6">
            <img src="{{ asset('images/bika-ambon.jpg') }}" class="img-fluid rounded shadow" alt="Bika Ambon">
        </div>
        <div class="col-md-6">
            <form action="/order/submit" method="POST" class="p-4 border rounded shadow-sm bg-light">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">Nama Lengkap</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama Anda" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label fw-bold">Nomor HP</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Contoh: 08123456789" required>
                </div>

                <div class="mb-3">
                    <label for="flavor" class="form-label fw-bold">Pilih Varian Rasa</label>
                    <select class="form-select" id="flavor" name="flavor" required>
                        <option value="coklat">Bika Ambon Coklat</option>
                        <option value="pandan">Bika Ambon Pandan</option>
                        <option value="keju">Bika Ambon Keju</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="quantity" class="form-label fw-bold">Jumlah Pesanan</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" min="1" value="1" required>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label fw-bold">Alamat Pengiriman</label>
                    <textarea class="form-control" id="address" name="address" rows="3" placeholder="Masukkan alamat lengkap" required></textarea>
                </div>

                <button type="submit" class="btn btn-warning w-100 fw-bold">Pesan Sekarang</button>
            </form>
        </div>
    </div>

    <div class="container mt-5">
        <h2 class="text-center fw-bold">Varian Rasa yang Tersedia</h2>
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card shadow border-0">
                    <img src="https://source.unsplash.com/300x200/?cake,chocolate" class="card-img-top" alt="Coklat">
                    <div class="card-body text-center">
                        <h5 class="card-title">Bika Ambon Coklat</h5>
                        <p class="text-muted">Kelezatan coklat berpadu dengan tekstur lembut Bika Ambon.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow border-0">
                    <img src="https://source.unsplash.com/300x200/?cake,pandan" class="card-img-top" alt="Pandan">
                    <div class="card-body text-center">
                        <h5 class="card-title">Bika Ambon Pandan</h5>
                        <p class="text-muted">Aroma harum pandan yang menggugah selera.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow border-0">
                    <img src="https://source.unsplash.com/300x200/?cake,cheese" class="card-img-top" alt="Keju">
                    <div class="card-body text-center">
                        <h5 class="card-title">Bika Ambon Keju</h5>
                        <p class="text-muted">Taburan keju melimpah, bikin makin nikmat!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
