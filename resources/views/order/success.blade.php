@extends('layout')

@section('title', 'Pesanan Berhasil')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 p-4">
                <div class="text-center">
                    <div class="mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="#28a745" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.97 11.03a.75.75 0 0 0 1.07 0l4.992-4.992a.75.75 0 1 0-1.06-1.06L7.5 9.439 5.53 7.47a.75.75 0 0 0-1.06 1.06l2.5 2.5z"/>
                        </svg>
                    </div>
                    <h1 class="fw-bold text-success mb-3">Pesanan Berhasil!</h1>
                    <p class="lead text-muted mb-4">
                        Terima kasih telah memesan <span class="fw-bold text-warning">Bika Ambon</span>. 
                        Kami sedang memproses pesanan Anda, dan akan segera kami kirimkan.
                    </p>
                    <a href="/" class="btn btn-warning btn-lg px-4 shadow-sm fw-bold">Kembali ke Home</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
