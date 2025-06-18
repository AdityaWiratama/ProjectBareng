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
            <thead class="table-warning text-center">
                <tr>
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
                    <td class="text-center">
                        @if($order->status == 'pending')
                            <span class="badge bg-warning text-dark">Menunggu</span>
                        @elseif($order->status == 'shipped')
                            <span class="badge bg-success">Dikirim</span>
                        @else
                            <span class="badge bg-secondary">Selesai</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="d-flex flex-column gap-1">
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-primary w-100">
                                <i class="fa-solid fa-eye"></i> Detail
                            </a>
                            <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="w-100">
                                @csrf @method('PUT')
                                <input type="hidden" name="status" value="shipped">
                                <button type="submit" class="btn btn-sm btn-success w-100" onclick="return confirm('Tandai pesanan ini sebagai dikirim?')">
                                    <i class="fas fa-paper-plane me-1"></i> Kirim
                                </button>
                            </form>
                            <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="w-100">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger w-100" onclick="return confirm('Yakin ingin menghapus pesanan ini?')">
                                    <i class="fas fa-trash-alt me-1"></i> Hapus
                                </button>
                            </form>
                        </div>
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
