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
            <img src="" alt="Bika Ambon">
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
    <h2 class="text-center fw-bold">Varian Rasa</h2>
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card shadow">
                <img src="https://source.unsplash.com/300x200/?cake,chocolate" class="card-img-top" alt="Coklat">
                <div class="card-body text-center">
                    <h5 class="card-title">Bika Ambon Coklat</h5>
                    <p class="text-muted">Kelezatan coklat berpadu dengan tekstur lembut Bika Ambon.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow">
                <img src="https://source.unsplash.com/300x200/?cake,pandan" class="card-img-top" alt="Pandan">
                <div class="card-body text-center">
                    <h5 class="card-title">Bika Ambon Pandan</h5>
                    <p class="text-muted">Aroma harum pandan yang menggugah selera.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow">
                <img src="https://source.unsplash.com/300x200/?cake,cheese" class="card-img-top" alt="Keju">
                <div class="card-body text-center">
                    <h5 class="card-title">Bika Ambon Keju</h5>
                    <p class="text-muted">Taburan keju melimpah, bikin makin nikmat!</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
