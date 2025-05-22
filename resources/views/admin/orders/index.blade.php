@extends('layouts.adminnavbar')

@section('title', 'Admin - Daftar Pesanan')

@section('content')
<div class="container py-5">
    <h1 class="fw-bold mb-4">📦 Daftar Pesanan</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive shadow rounded">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-warning">
                <tr class="text-center">
                    <th>#</th>
                    <th>Nama</th>
                    <th>No. HP</th>
                    <th>Produk</th>
                    <th>Rasa</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Alamat</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->phone }}</td>
                    <td class="text-capitalize">{{ str_replace('-', ' ', $order->product_slug) }}</td>
                    <td class="text-capitalize">{{ $order->flavor }}</td>
                    <td class="text-center">{{ $order->quantity }}</td>
                    <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                    <td>{{ $order->address }}</td>
                    <td>
                        @if($order->status == 'pending')
                            <span class="badge bg-warning text-dark">Menunggu</span>
                        @elseif($order->status == 'shipped')
                            <span class="badge bg-success">Dikirim</span>
                        @else
                            <span class="badge bg-secondary">Selesai</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-primary mb-1">Detail</a>
                        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="d-inline">
                            @csrf @method('PUT')
                            <input type="hidden" name="status" value="shipped">
                            <button type="submit" class="btn btn-sm btn-success mb-1" onclick="return confirm('Tandai pesanan ini sebagai dikirim?')">Kirim</button>
                        </form>
                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger mb-1" onclick="return confirm('Yakin ingin menghapus pesanan ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center text-muted">Belum ada pesanan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
