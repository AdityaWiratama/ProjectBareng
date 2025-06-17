<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bika Ambon Kita')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #fffdf7;
            font-family: 'Poppins', sans-serif;
        }
        footer {
            background-color: #222 !important;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">Bika Ambon Kita</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('order.create') }}">Pemesanan</a>
                    </li>
                    @if(Auth::check() && Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.orders.index') }}">Admin</a>
                        </li>
                    @endif

                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endguest

                    @auth
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
            {{ Auth::user()->name }}
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>

            {{-- Tambahkan ini --}}
            <li><a class="dropdown-item" href="{{ route('order.history') }}">Riwayat Pemesanan</a></li>

            <li>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button class="dropdown-item" type="submit">Logout</button>
                </form>
            </li>
        </ul>
    </li>
@endauth

                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Container -->
    <div class="container mt-2">
        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>

    @if (!View::hasSection('hideFooter'))
    <!-- Footer -->
    <footer class="bg-dark text-white pt-5 pb-4" style="background: linear-gradient(135deg, #1b1b1b, #2e2e2e);">
        <div class="container text-center text-md-start">
            <div class="row text-center text-md-start">

                <!-- Tentang Kami -->
                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Bika Ambon Order</h5>
                    <p class="small">Nikmati kelembutan dan kelezatan Bika Ambon asli, dibuat setiap hari dengan resep tradisional dan bahan berkualitas terbaik langsung dari dapur kami ke rumah Anda.</p>
                </div>

                <!-- Kontak -->
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Kontak</h5>
                    <p class="mb-2"><i class="fas fa-map-marker-alt me-2 text-warning"></i>Jl. Masjid Raya No. 123, Jakarta</p>
                    <p class="mb-2"><i class="fas fa-phone me-2 text-warning"></i>+628535951066</p>
                    <p><i class="fas fa-envelope me-2 text-warning"></i>adityawiratama078@gmail.com</p>
                </div>

                <!-- Sosial Media -->
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Ikuti Kami</h5>
                    <a href="https://www.instagram.com/ditz.wr?igsh=MWptYXpobW94cWhp" class="text-white text-decoration-none d-block mb-2">
                        <i class="fab fa-instagram me-2 text-warning"></i>Instagram
                    </a>
                    <a href="#" class="text-white text-decoration-none d-block mb-2">
                        <i class="fab fa-whatsapp me-2 text-warning"></i>WhatsApp
                    </a>
                </div>

                <!-- Jam Buka -->
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Jam Operasional</h5>
                    <p class="mb-2"><i class="fas fa-clock me-2 text-warning"></i>Senin - Sabtu: 08:00 - 18:00</p>
                    <p><i class="fas fa-calendar-times me-2 text-warning"></i>Minggu & Libur: Tutup</p>
                </div>

            </div>

            <hr class="mb-4 text-light">

            <div class="row align-items-center">
                <div class="col-md-7 col-lg-8">
                    <p class="mb-0 small text-white">© 2024 Bika Ambon Order. All Rights Reserved.</p>
                </div>
                <div class="col-md-5 col-lg-4 text-end">
                    <p class="mb-0 small text-white">Design by <span class="text-warning">Aditya Wiratama</span></p>
                </div>
            </div>
        </div>
    </footer>
    @endif

    <!-- Bootstrap & FontAwesome -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</body>
</html>
