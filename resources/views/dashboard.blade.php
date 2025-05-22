@extends('layout')

@section('title', 'Dashboard - Bika Ambon Order')

@section('content')
    <style>
        body {
            background: #f5f5f5;
            font-family: 'Poppins', sans-serif;
        }

        .dashboard-container {
            padding: 2rem 1rem;
        }

        .header-title {
            font-size: 2.4rem;
            font-weight: 800;
            color: #3e2723;
        }

        .section-sub {
            font-size: 1rem;
            color: #6d4c41;
        }

        .stats-wrapper {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .stat-box {
            background: #ffffff;
            padding: 1.5rem 2rem;
            border-radius: 16px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: 0.3s ease;
        }

        .stat-box:hover {
            transform: translateY(-4px);
        }

        .icon-box {
            font-size: 2rem;
            background: #fff8e1;
            color: #ffb300;
            padding: 1rem;
            border-radius: 50%;
            box-shadow: 0 2px 10px rgba(255, 179, 0, 0.2);
        }

        .info-box {
            display: flex;
            flex-direction: column;
        }

        .info-title {
            font-size: 1rem;
            color: #6d4c41;
        }

        .info-value {
            font-size: 1.7rem;
            font-weight: bold;
            color: #3e2723;
        }

        .announcement {
            margin-top: 3rem;
            background: linear-gradient(to right, #fffde7, #fff9c4);
            border-left: 6px solid #ffca28;
            padding: 1.5rem;
            border-radius: 10px;
            color: #5d4037;
            font-weight: 500;
        }

        .btn-back {
            display: inline-block;
            margin-top: 2rem;
            background-color: #ffca28;
            color: #3e2723;
            font-weight: 600;
            padding: 12px 32px;
            border-radius: 30px;
            text-decoration: none;
            transition: 0.3s ease;
        }

        .btn-back:hover {
            background-color: #fbc02d;
        }
    </style>

    <div class="container dashboard-container">
        <div class="text-center mb-4">
            <h1 class="header-title">Dashboard Bika Ambon</h1>
            <p class="section-sub">Pantau statistik dan aktivitas tokomu secara real-time ✨</p>
        </div>

        {{-- Statistik Section --}}
        <div class="stats-wrapper">
            <div class="stat-box">
                <div class="icon-box">🧁</div>
                <div class="info-box">
                    <span class="info-title">Total Orders</span>
                    <span class="info-value">12</span>
                </div>
            </div>
            <div class="stat-box">
                <div class="icon-box">👥</div>
                <div class="info-box">
                    <span class="info-title">Customers</span>
                    <span class="info-value">8</span>
                </div>
            </div>
            <div class="stat-box">
                <div class="icon-box">💰</div>
                <div class="info-box">
                    <span class="info-title">Revenue</span>
                    <span class="info-value">Rp 1.200.000</span>
                </div>
            </div>
        </div>

        {{-- Pengumuman/Info --}}
        <div class="announcement mt-5">
            Selamat datang kembali, Admin! Jangan lupa untuk mengecek pesanan terbaru hari ini dan pastikan stok Bika Ambon tersedia.
        </div>

        {{-- Tombol Kembali --}}
        <div class="text-center">
            <a href="{{ route('home') }}" class="btn-back">Kembali ke Beranda</a>
        </div>
    </div>
@endsection
