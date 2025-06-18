@extends('layout')

@section('title', 'Home - Bika Ambon Kita')

@section('content')
<style>
    body {
        background-color: #fffdf7;
        font-family: 'Poppins', sans-serif;
    }

    /* Hero Banner Baru */
    .hero-banner {
        position: relative;
         background-image: url('https://i.pinimg.com/736x/92/65/e8/9265e83f363be902a5068fc0f7cf78b0.jpg');
        background-size: cover;
        background-position: center;
        height: 90vh;
        border-radius: 0 0 30px 30px;
        overflow: hidden;
    }

    .hero-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 4rem 2rem;
        background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.5) 60%, rgba(0,0,0,0.9) 100%);
    }

    .hero-overlay h1,
    .hero-overlay p {
        color: #fff;
    }

    .btn-cta {
        background-color: #ffb300;
        color: #fff;
        font-weight: 600;
        padding: 12px 30px;
        border-radius: 30px;
        text-decoration: none;
        transition: 0.3s;
    }

    .btn-cta:hover {
        background-color: #ffa000;
    }

    .section-title {
        font-weight: 700;
        font-size: 1.8rem;
        color: #4e342e;
        margin-bottom: 1rem;
        text-align: center;
    }

    .why-card li {
        padding: 0.5rem 0;
        font-weight: 500;
        color: #4e342e;
    }

    .card-custom {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .card-custom:hover {
        transform: translateY(-5px);
    }

    .card-img-top {
        height: 220px;
        object-fit: cover;
    }

    .text-promo {
        color: #ff7043;
        font-weight: 700;
    }

    .btn-order {
        background-color: #ffb300;
        color: #fff;
        font-weight: 600;
        border-radius: 30px;
        padding: 10px 24px;
        transition: 0.3s;
    }

    .btn-order:hover {
        background-color: #ffa000;
    }
</style>

{{-- Hero Section Baru --}}
<div class="hero-banner mb-5">
    <div class="hero-overlay text-white text-start">
        <div class="container">
            <h1 class="display-4 fw-bold">Bika Ambon Asli & Lembut</h1>
            <p class="lead">Dibuat dengan resep tradisional untuk rasa yang tak terlupakan.</p>
            <a href="{{ route('order.create') }}" class="btn btn-cta mt-3">Pesan Sekarang</a>
        </div>
    </div>
</div>

{{-- Mengapa Memilih Kami --}}
<div class="container mb-5">
    <div class="row align-items-center">
        <div class="col-md-6 mb-3">
            <img src="https://asset.kompas.com/crops/VzYx-AkbhGOs5xvoXncObdqgXLA=/142x4:829x462/1200x800/data/photo/2023/04/27/6449e926b9ed3.jpg"
                 alt="Bika Ambon"
                 class="img-fluid rounded-4 shadow"
                 style="object-fit: cover; max-height: 300px; width: 100%;">
        </div>
        <div class="col-md-6">
            <h2 class="fw-bold mb-3">Kenapa Harus Kami?</h2>
            <ul class="list-unstyled why-card">
                <li>✅ Fresh Baked Setiap Hari</li>
                <li>✅ Resep Tradisional Otentik</li>
                <li>✅ Banyak Pilihan Varian Rasa</li>
                <li>✅ Packing Rapi & Aman Sampai Tujuan</li>
            </ul>
        </div>
    </div>
</div>

{{-- Promo Section --}}
@if($promos->count())
    <div class="container mt-5">
        <h3 class="section-title text-success">🎁 Promo Spesial 7 Hari!</h3>
        <div class="row mt-4">
            @foreach ($promos as $promo)
                <div class="col-md-4 mb-4 d-flex">
                    <div class="card card-custom w-100">
                        @if (filter_var($promo->image, FILTER_VALIDATE_URL))
                            <img src="{{ $promo->image }}" class="card-img-top" alt="{{ $promo->name }}">
                        @else
                            <img src="{{ asset('storage/'.$promo->image) }}" class="card-img-top" alt="{{ $promo->name }}">
                        @endif
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold text-success">{{ $promo->name }}</h5>
                            <p class="text-muted">{{ $promo->description }}</p>
                            <p>
                                <span class="text-promo">Rp{{ number_format($promo->price, 0, ',', '.') }}</span>
                                <del class="text-muted">Rp{{ number_format($promo->original_price, 0, ',', '.') }}</del>
                            </p>
                            <a href="{{ route('order.create', ['product' => $promo->slug]) }}" class="btn btn-order mt-2">Pesan</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif

{{-- Varian Rasa --}}
@if($variants->count())
    <div class="container mt-5">
        <h2 class="section-title">Varian Rasa Bika Ambon</h2>
        <div class="row mt-4">
            @foreach ($variants as $variant)
                <div class="col-md-4 mb-4 d-flex">
                    <div class="card card-custom w-100">
                        @if (filter_var($variant->image, FILTER_VALIDATE_URL))
                            <img src="{{ $variant->image }}" class="card-img-top" alt="{{ $variant->name }}">
                        @else
                            <img src="{{ asset('storage/'.$variant->image) }}" class="card-img-top" alt="{{ $variant->name }}">
                        @endif
                        <div class="card-body text-center d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title fw-bold">{{ $variant->name }}</h5>
                                <p class="text-muted">{{ $variant->description }}</p>
                            </div>
                            <a href="{{ route('order.create', ['product' => $variant->slug]) }}" class="btn btn-order mt-3">Pesan</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
@endsection
