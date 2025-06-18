@extends('layout')

@section('title', 'Riwayat Pemesanan')

@section('content')
<style>
    body {
        background-color: #fffdf7;
        font-family: 'Poppins', sans-serif;
    }
    .table-container {
        background: #fffaf0;
        padding: 2rem;
        border-radius: 12px;
        max-width: 1100px;
        margin: 2rem auto;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 1rem;
    }
    th, td {
        padding: 1rem;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #fff0c4;
        font-weight: bold;
    }
    .badge-menunggu {
        background-color: #fff2b3;
        color: #7a5d00;
        padding: 0.5rem 1rem;
        border-radius: 999px;
        font-weight: bold;
    }
    .badge-dikirim {
        background-color: #d1f4ff;
        color: #007d99;
        padding: 0.5rem 1rem;
        border-radius: 999px;
        font-weight: bold;
    }
</style>

<div class="table-container">
    <h2 class="text-3xl font-bold text-center text-brown-700 mb-6">Riwayat Pemesanan Anda</h2>
    <table>
        <thead>
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
                   <td>{{ $order->product_slug }} - {{ $order->product['name'] }}</td>
                    <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y') }}</td>
                    <td>Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
                    <td>
                        @if ($order->status == 'menunggu')
                            <span class="badge-menunggu">Menunggu</span>
                        @elseif ($order->status == 'dikirim')
                            <span class="badge-dikirim">Dikirim</span>
                        @else
                            {{ ucfirst($order->status) }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
