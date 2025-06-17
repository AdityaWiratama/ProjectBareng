@extends('layout')

@section('title', 'Riwayat Pemesanan - Bika Ambon Kita')

@section('content')
<style>
    body {
        background-color: #fffdf7;
        font-family: 'Poppins', sans-serif;
    }

    .section-title {
        font-weight: 700;
        font-size: 1.8rem;
        color: #4e342e;
        margin: 2rem 0 1rem;
        text-align: center;
    }

    .table-orders {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        overflow: hidden;
    }

    .table th, .table td {
        vertical-align: middle;
        text-align: center;
    }

    .badge-status {
        font-size: 0.9rem;
        padding: 0.4em 0.8em;
        border-radius: 20px;
    }

    .badge-success {
        background-color: #c8e6c9;
        color: #2e7d32;
    }

    .badge-pending {
        background-color: #fff9c4;
        color: #fbc02d;
    }

    .badge-cancel {
        background-color: #ffcdd2;
        color: #c62828;
    }
</style>

<div class="container">
    <h2 class="section-title">Riwayat Pemesanan Anda</h2>

    @if($orders->count())
        <div class="table-responsive table-orders">
            <table class="table table-bordered">
                <thead class="table-warning">
                    <tr>
                        <th>#</th>
                        <th>Produk</th>
                        <th>Tanggal</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach ($orders as $index => $order)
<tr>
    <td>{{ $index + 1 }}</td>
    <td>{{ $order->product['name'] ?? '-' }}</td>
    <td>{{ \Carbon\Carbon::parse($order->created_at)->translatedFormat('d M Y') }}</td>
    <td>Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
    <td>
        @if ($order->status === 'pending')
            <span style="background-color: #fff3cd; color: #856404; padding: 4px 12px; border-radius: 20px;">Menunggu</span>
        @elseif ($order->status === 'shipped')
            <span style="background-color: #d1ecf1; color: #0c5460; padding: 4px 12px; border-radius: 20px;">Dikirim</span>
        @elseif ($order->status === 'completed')
            <span style="background-color: #d4edda; color: #155724; padding: 4px 12px; border-radius: 20px;">Selesai</span>
        @else
            <span style="background-color: #f8d7da; color: #721c24; padding: 4px 12px; border-radius: 20px;">Dibatalkan</span>
        @endif
    </td>
</tr>
@endforeach

            </table>
        </div>
    @else
        <p class="text-center mt-4 text-muted">Belum ada riwayat pemesanan.</p>
    @endif
</div>
@endsection
