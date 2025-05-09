@extends('layout')

@section('title', 'Dashboard - Bika Ambon Order')

@section('content')
    <style>
        body {
            background: #fff8e1;
            font-family: 'Poppins', sans-serif;
        }

        .dashboard-title {
            font-weight: 700;
            color: #6b4c35;
        }

        .stat-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            font-size: 2rem;
            color: #ffb300;
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: bold;
            color: #8d6e63;
        }

        .go-home-btn {
            background-color: #a1887f;
            border: none;
            padding: 12px 32px;
            font-size: 1rem;
            font-weight: 600;
            color: white;
            border-radius: 30px;
        }

        .go-home-btn:hover {
            background-color: #8d6e63;
        }

        .bika-pattern {
            background: linear-gradient(135deg, #fff3cd 25%, #ffe082 100%);
            border-radius: 20px;
            padding: 1.5rem;
        }
    </style>

    <div class="container my-5">
        <h2 class="dashboard-title text-center mb-4">📊 Dashboard Bika Ambon</h2>

        <div class="alert alert-success text-center shadow-sm">
            Selamat datang! Anda telah masuk sebagai admin toko <strong>Bika Ambon</strong>.
        </div>

        {{-- Kartu Statistik --}}
        <div class="row mt-4">
            <div class="col-md-4 mb-4">
                <div class="card stat-card bika-pattern text-center">
                    <div class="card-body">
                        <div class="stat-icon mb-2">🧁</div>
                        <h5 class="card-title">Total Orders</h5>
                        <p class="stat-value">12</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card stat-card bika-pattern text-center">
                    <div class="card-body">
                        <div class="stat-icon mb-2">👥</div>
                        <h5 class="card-title">Customers</h5>
                        <p class="stat-value">8</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card stat-card bika-pattern text-center">
                    <div class="card-body">
                        <div class="stat-icon mb-2">💰</div>
                        <h5 class="card-title">Revenue</h5>
                        <p class="stat-value">Rp 1.200.000</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tombol Kembali --}}
        <div class="text-center mt-4">
            <a href="{{ route('home') }}" class="go-home-btn shadow-sm">
                🏠 beranda
            </a>
        </div>
    </div>
@endsection
