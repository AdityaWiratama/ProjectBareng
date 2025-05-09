@extends('layout')

@section('title', 'Home - Bika Ambon Order')

@section('content')
<div class="text-center my-5">
    <h1 class="fw-bold">Selamat Datang di <span class="text-warning">Bika Ambon Order</span></h1>
    <p class="lead text-muted">Nikmati kelembutan dan cita rasa khas Bika Ambon yang kami tawarkan!</p>
    <a href="/order" class="btn btn-warning btn-lg mt-3">Pesan Sekarang</a>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img src="https://asset.kompas.com/crops/VzYx-AkbhGOs5xvoXncObdqgXLA=/142x4:829x462/1200x800/data/photo/2023/04/27/6449e926b9ed3.jpg" 
                 alt="Bika Ambon" 
                 class="img-fluid rounded shadow-sm" 
                 style="max-height: 300px; object-fit: cover;">
        </div>
        <div class="col-md-6 d-flex align-items-center">
            <div>
                <h2 class="fw-bold">Mengapa Memilih Kami?</h2>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">✅ Bika Ambon fresh setiap hari</li>
                    <li class="list-group-item">✅ Resep asli dengan rasa autentik</li>
                    <li class="list-group-item">✅ Tersedia berbagai varian rasa</li>
                    <li class="list-group-item">✅ Pengiriman cepat & aman</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="container mt-5">
    <h3 class="text-center text-success fw-bold">Promo Spesial 7 Hari!</h3>
    <p class="text-center text-muted">Berlaku dari <strong>8 Mei</strong> hingga <strong>14 Mei</strong> 2025</p>
    <div class="row mt-4">
        @foreach ($promos as $promo)
            <div class="col-md-4">
                <div class="card shadow border-success">
                    <img src="{{ $promo['image'] }}" 
                         class="card-img-top" 
                         alt="{{ $promo['name'] }}" 
                         style="height: 200px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold text-success">{{ $promo['name'] }}</h5>
                        <p class="text-muted">{{ $promo['description'] }}</p>
                        <p><span class="text-danger fw-bold">Rp{{ number_format($promo['price'], 0, ',', '.') }}</span> 
                            <del class="text-muted">Rp{{ number_format($promo['original_price'], 0, ',', '.') }}</del>
                        </p>
                        <a href="/order?product={{ $promo['slug'] }}" class="btn btn-success">Pesan Sekarang</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Varian Rasa -->
<div class="container mt-5">
    <h2 class="text-center fw-bold">Varian Rasa</h2>
    <div class="row mt-4">
        @foreach ($variants as $variant)
            <div class="col-md-4">
                <div class="card shadow">
                    <img src="{{ $variant['image'] }}" 
                         class="card-img-top img-fluid" 
                         alt="{{ $variant['name'] }}" 
                         style="height: 200px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $variant['name'] }}</h5>
                        <p class="text-muted">{{ $variant['description'] }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
