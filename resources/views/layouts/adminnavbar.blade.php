<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-k5cLQv5/fClXHLTb+5+p3Ebp8FbrRXc6xHZNO5VJ7ulJ1Sp3uY6zwbT0HQxu2Q9/x6ISHevQ1LSAtIHT2oVZ1g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">Bika Ambon Order</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">

                    {{-- Menu khusus admin --}}
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.orders.index') }}">Pesanan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('order.create') }}">Tambah Pesanan</a>
                        </li>
                        {{-- Tambahkan menu Manajemen Produk --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.products.index') }}">Manajemen Produk</a>
                        </li>
                    @endauth

                    {{-- Edit hanya muncul jika $order tersedia --}}
                    @isset($order)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.orders.edit', $order->id) }}">Edit</a>
                        </li>
                    @endisset

                    {{-- Profil dan Logout --}}
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
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

    <div class="container mt-4">
        {{-- Flash Message --}}
        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
