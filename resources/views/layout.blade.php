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
        <div class="row text-center text-md-start align-items-start">

            <!-- Logo dan Sosial Media -->
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h4 class="text-warning fw-bold">Bika Ambon</h4>
                <div class="d-flex gap-3 mt-3">
                    <a href="#" class="text-white"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.instagram.com/ditz.wr?igsh=MWptYXpobW94cWhp" class="text-white"><i class="fab fa-instagram"></i></a>
                </div>
            </div>

            <!-- Kontak -->
            <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mt-3">
                <h5 class="text-uppercase fw-bold text-warning mb-3">Contact Us</h5>
                <p class="small mb-1"><i class="fas fa-envelope me-2 text-warning"></i>adityawiratama078@gmail.com</p>
                <p class="small mb-1"><i class="fas fa-map-marker-alt me-2 text-warning"></i>Jl. Masjid Raya No.123, Jakarta</p>
                <p class="small mb-1"><i class="fas fa-phone me-2 text-warning"></i>+62 853 5951 066</p>
            </div>

            <!-- Subscribe -->
            <div class="col-md-5 col-lg-5 col-xl-5 mx-auto mt-3">
                <h5 class="text-uppercase fw-bold text-warning mb-3">Subscribe</h5>
                <p class="small">Enter your email to get notified about our new flavors & promos</p>
                <form class="d-flex mt-2" onsubmit="event.preventDefault(); alert('Terima kasih sudah berlangganan!');">
                    <input type="email" class="form-control me-2 bg-secondary text-white border-0" placeholder="Email" required>
                    <button class="btn btn-warning text-dark" type="submit"><i class="fas fa-paper-plane"></i></button>
                </form>
            </div>

        </div>

        <hr class="my-4 text-light">

        <div class="row">
            <div class="col-md-6">
                <p class="small mb-0 text-white">© 2024 Bika Ambon Order. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-end">
                <p class="small mb-0 text-white">Design by <span class="text-warning">Aditya Wiratama</span></p>
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
