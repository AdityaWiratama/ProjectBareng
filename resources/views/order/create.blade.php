@extends('layout')

@section('title', 'Pemesanan - Bika Ambon Order')

@section('content')
<div class="container py-5">
    <h1 class="text-center fw-bold mb-4">Pesan <span class="text-warning">Bika Ambon</span> Favoritmu!</h1>
    <p class="text-center text-muted">Pilih varian rasa dan jumlah yang kamu inginkan, lalu lakukan pemesanan dengan mudah.</p>

    <div class="row mt-5" id="order-form">
        <div class="col-md-6">
            <img src="{{ isset($product) ? $product['image'] : 'https://asset.kompas.com/crops/VzYx-AkbhGOs5xvoXncObdqgXLA=/142x4:829x462/1200x800/data/photo/2023/04/27/6449e926b9ed3.jpg' }}" class="img-fluid rounded shadow" alt="Bika Ambon">
        </div>
        <div class="col-md-6">
            <form action="{{ route('order.store') }}" method="POST" class="p-4 border rounded shadow-sm bg-light">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">Nama Lengkap</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama Anda" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label fw-bold">Nomor HP</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Contoh: 08123456789" required>
                </div>

                <div class="mb-3">
                    <label for="product_slug" class="form-label fw-bold">Pilih Produk</label>
                    <select class="form-select" id="product_slug" name="product_slug" required>
                        <option value="original" {{ isset($product) && $product['name'] == 'Bika Ambon Original' ? 'selected' : '' }}>Bika Ambon Original</option>
                        <option value="durian" {{ isset($product) && $product['name'] == 'Bika Ambon Durian' ? 'selected' : '' }}>Bika Ambon Durian</option>
                        <option value="matcha" {{ isset($product) && $product['name'] == 'Bika Ambon Matcha' ? 'selected' : '' }}>Bika Ambon Matcha</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="flavor" class="form-label fw-bold">Pilih Varian Rasa</label>
                    <select class="form-select" id="flavor" name="flavor" required>
                        <option value="original">Original</option>
                        <option value="durian">Durian</option>
                        <option value="matcha">Matcha</option>
                        <option value="coklat">Coklat</option>
                        <option value="pandan">Pandan</option>
                        <option value="keju">Keju</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="quantity" class="form-label fw-bold">Jumlah Pesanan</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" min="1" value="1" required>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label fw-bold">Alamat Pengiriman</label>
                    <textarea class="form-control" id="address" name="address" rows="3" placeholder="Masukkan alamat lengkap" required></textarea>
                </div>

                <div class="mb-3">
                    <div class="card p-3">
                        <p class="fw-bold mb-1">Detail Harga:</p>
                        <div class="d-flex justify-content-between">
                            <span>Harga Satuan:</span>
                            <span id="unit-price">Rp {{ isset($product) ? number_format($product['price']) : '28.000' }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Total:</span>
                            <span id="total-price" class="fw-bold">Rp {{ isset($product) ? number_format($product['price']) : '28.000' }}</span>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-warning w-100 fw-bold">Pesan Sekarang</button>
            </form>
        </div>
    </div>

    <div class="container mt-5">
        <h2 class="text-center fw-bold">Varian Rasa yang Tersedia</h2>
        <div class="row mt-4">
            <div class="col-md-4 mb-4">
                <a href="{{ route('order.create', ['product' => 'original']) }}">
                    <div class="card shadow border-0">
                        <img src="https://pemerintahsumut.wordpress.com/wp-content/uploads/2014/12/bika-ambon.jpg" class="card-img-top" alt="Original">
                        <div class="card-body text-center">
                            <h5 class="card-title">Bika Ambon Original</h5>
                            <p class="text-muted">Rasa klasik yang tak pernah gagal memanjakan lidah.</p>
                            <p class="fw-bold text-success">Rp 28.000</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="{{ route('order.create', ['product' => 'durian']) }}">
                    <div class="card shadow border-0">
                        <img src="https://img-global.cpcdn.com/recipes/7d1727f5e2843ae1/680x482cq70/bika-ambon-durian-foto-resep-utama.jpg" class="card-img-top" alt="Durian">
                        <div class="card-body text-center">
                            <h5 class="card-title">Bika Ambon Durian</h5>
                            <p class="text-muted">Aroma durian khas yang menggoda selera.</p>
                            <p class="fw-bold text-success">Rp 35.000</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="{{ route('order.create', ['product' => 'matcha']) }}">
                    <div class="card shadow border-0">
                        <img src="https://img-global.cpcdn.com/recipes/2a0fdf18c502cc94/680x482cq70/bika-ambon-matcha-foto-resep-utama.jpg" class="card-img-top" alt="Matcha">
                        <div class="card-body text-center">
                            <h5 class="card-title">Bika Ambon Matcha</h5>
                            <p class="text-muted">Rasa unik matcha untuk pecinta teh hijau.</p>
                            <p class="fw-bold text-success">Rp 32.000</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="#order-form" onclick="selectFlavor('coklat')">
                    <div class="card shadow border-0">
                        <img src="https://img-global.cpcdn.com/recipes/b6d18cb817e00d92/680x482cq70/bika-ambon-coklat-foto-resep-utama.jpg" class="card-img-top" alt="Coklat">
                        <div class="card-body text-center">
                            <h5 class="card-title">Bika Ambon Coklat</h5>
                            <p class="text-muted">Kelezatan coklat berpadu dengan tekstur lembut Bika Ambon.</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="#order-form" onclick="selectFlavor('pandan')">
                    <div class="card shadow border-0">
                        <img src="https://img-global.cpcdn.com/recipes/8666eec402d3f1f0/680x482cq70/bika-ambon-pandan-foto-resep-utama.jpg" class="card-img-top" alt="Pandan">
                        <div class="card-body text-center">
                            <h5 class="card-title">Bika Ambon Pandan</h5>
                            <p class="text-muted">Aroma harum pandan yang menggugah selera.</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="#order-form" onclick="selectFlavor('keju')">
                    <div class="card shadow border-0">
                        <img src="https://pemerintahsumut.wordpress.com/wp-content/uploads/2014/12/bika-ambon.jpg" class="card-img-top" alt="Keju">
                        <div class="card-body text-center">
                            <h5 class="card-title">Bika Ambon Keju</h5>
                            <p class="text-muted">Taburan keju melimpah, bikin makin nikmat!</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    function selectFlavor(value) {
        document.getElementById('flavor').value = value;
        document.getElementById('product_slug').value = 'original'; // Default to original when selecting these flavors
        scrollToOrderForm();
    }

    function scrollToOrderForm() {
        document.getElementById('order-form').scrollIntoView({ behavior: 'smooth' });
    }

    // Update total price based on quantity
    document.addEventListener('DOMContentLoaded', function() {
        const quantityInput = document.getElementById('quantity');
        const unitPriceElement = document.getElementById('unit-price');
        const totalPriceElement = document.getElementById('total-price');
        const productSelect = document.getElementById('product_slug');

        // Price mapping based on product
        const prices = {
            'original': 28000,
            'durian': 35000,
            'matcha': 32000
        };

        function updatePrice() {
            const selectedProduct = productSelect.value;
            const quantity = parseInt(quantityInput.value);
            const unitPrice = prices[selectedProduct] || 28000;
            const total = unitPrice * quantity;

            unitPriceElement.textContent = `Rp ${formatNumber(unitPrice)}`;
            totalPriceElement.textContent = `Rp ${formatNumber(total)}`;
        }

        function formatNumber(number) {
            return new Intl.NumberFormat('id-ID').format(number);
        }

        quantityInput.addEventListener('change', updatePrice);
        quantityInput.addEventListener('input', updatePrice);
        productSelect.addEventListener('change', updatePrice);

        // Initial calculation
        updatePrice();
    });
</script>
@endsection