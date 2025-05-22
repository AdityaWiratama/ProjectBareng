@extends('layout')

@section('title', 'Admin - Detail Pesanan')

@section('content')
<div class="container py-5">
    <h1 class="fw-bold mb-4">Detail Pesanan #{{ $order->id }}</h1>

    <div class="card p-4 shadow-sm rounded">
        <dl class="row">
            <dt class="col-sm-3">Nama Pemesan</dt>
            <dd class="col-sm-9">{{ $order->name }}</dd>

            <dt class="col-sm-3">No. HP</dt>
            <dd class="col-sm-9">{{ $order->phone }}</dd>

            <dt class="col-sm-3">Produk</dt>
            <dd class="col-sm-9 text-capitalize">{{ str_replace('-', ' ', $order->product_slug) }}</dd>

            <dt class="col-sm-3">Rasa</dt>
            <dd class="col-sm-9 text-capitalize">{{ $order->flavor }}</dd>

            <dt class="col-sm-3">Jumlah</dt>
            <dd class="col-sm-9">{{ $order->quantity }}</dd>

            <dt class="col-sm-3">Total Harga</dt>
            <dd class="col-sm-9">Rp {{ number_format($order->total_price, 0, ',', '.') }}</dd>

            <dt class="col-sm-3">Alamat</dt>
            <dd class="col-sm-9">{{ $order->address }}</dd>

            <dt class="col-sm-3">Status</dt>
            <dd class="col-sm-9">
                @if($order->status == 'pending')
                    <span class="badge bg-warning text-dark">Menunggu</span>
                @elseif($order->status == 'shipped')
                    <span class="badge bg-success">Dikirim</span>
                @else
                    <span class="badge bg-secondary">Selesai</span>
                @endif
            </dd>
        </dl>

        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Pesanan</a>
    </div>
</div>
@endsection
