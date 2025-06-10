@extends('layout')

@section('title', 'Pemesanan - Bika Ambon Order')

@section('content')
<div class="container py-5">
    <h1 class="text-center fw-bold mb-4">Pesan <span class="text-warning">Bika Ambon</span> Favoritmu!</h1>
    <p class="text-center text-muted">Pilih produk dan varian rasa yang kamu inginkan, lalu lakukan pemesanan dengan mudah.</p>

    <div class="row mt-5" id="order-form">
        <div class="col-md-6">
            <img src="https://asset.kompas.com/crops/VzYx-AkbhGOs5xvoXncObdqgXLA=/142x4:829x462/1200x800/data/photo/2023/04/27/6449e926b9ed3.jpg" class="img-fluid rounded shadow" alt="Bika Ambon">
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
                        <option value="bika_ambon">Bika Ambon</option>
                        <!-- Tambahkan produk lain jika ada -->
                    </select>
                </div>

                <div class="mb-3">
                    <label for="flavor" class="form-label fw-bold">Pilih Varian Rasa</label>
                    <select class="form-select" id="flavor" name="flavor" required>
                        <option value="original">Original</option>
                        <option value="Red Velvet">Red Velvet</option>
                        <option value="Ubi Unggu">Ubi Unggu</option>
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
                            <span id="unit-price">Rp 28.000</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Total:</span>
                            <span id="total-price" class="fw-bold">Rp 28.000</span>
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
            @php
                $products = [
                    ['name' => 'original', 'title' => 'Bika Ambon Original', 'price' => 28000, 'img' => 'https://pemerintahsumut.wordpress.com/wp-content/uploads/2014/12/bika-ambon.jpg'],
                    ['name' => 'Red Velvet', 'title' => 'Bika Ambon Red Velvet', 'price' => 35000, 'img' => 'https://img-global.cpcdn.com/recipes/c0acf7368481ec21/680x482cq70/bika-ambon-red-velvet-gluten-free-foto-resep-utama.jpg'],
                    ['name' => 'Ubi Unggu', 'title' => 'Bika Ambon Ubi Unggu', 'price' => 32000, 'img' => 'https://img-global.cpcdn.com/recipes/d18fc3ad3e7788f7/680x482cq70/bika-ambon-ubi-ungu-pr_kuetradisionalberserat-foto-resep-utama.jpg'],
                    ['name' => 'coklat', 'title' => 'Bika Ambon Coklat', 'price' => 30000, 'img' => 'https://img-global.cpcdn.com/recipes/b6d18cb817e00d92/680x482cq70/bika-ambon-coklat-foto-resep-utama.jpg'],
                    ['name' => 'pandan', 'title' => 'Bika Ambon Pandan', 'price' => 30000, 'img' => 'https://img-global.cpcdn.com/recipes/8666eec402d3f1f0/680x482cq70/bika-ambon-pandan-foto-resep-utama.jpg'],
                    ['name' => 'keju', 'title' => 'Bika Ambon Keju', 'price' => 32000, 'img' => 'https://www.mbrownex.com/web/image/product.template/1542/image'],
                ];
            @endphp

            @foreach($products as $product)
                <div class="col-md-4 mb-4">
                    <a href="#order-form" onclick="selectFlavor('{{ $product['name'] }}')">
                        <div class="card shadow border-0">
                            <img src="{{ $product['img'] }}" class="card-img-top" alt="{{ $product['title'] }}">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $product['title'] }}</h5>
                                <p class="text-muted">Rasa lezat dan khas untuk segala suasana.</p>
                                <p class="fw-bold text-success">Rp {{ number_format($product['price']) }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    function selectFlavor(value) {
        document.getElementById('flavor').value = value;
        scrollToOrderForm();
        updatePrice();
    }

    function scrollToOrderForm() {
        document.getElementById('order-form').scrollIntoView({ behavior: 'smooth' });
    }

    document.addEventListener('DOMContentLoaded', function () {
        const quantityInput = document.getElementById('quantity');
        const unitPriceElement = document.getElementById('unit-price');
        const totalPriceElement = document.getElementById('total-price');
        const flavorSelect = document.getElementById('flavor');

        const prices = {
            'original': 28000,
            'Red Velvet': 35000,
            'Ubi Unggu': 32000,
            'coklat': 30000,
            'pandan': 30000,
            'keju': 32000
        };

        function updatePrice() {
            const selectedFlavor = flavorSelect.value;
            const quantity = parseInt(quantityInput.value) || 1;
            const unitPrice = prices[selectedFlavor] || 28000;
            const total = unitPrice * quantity;

            unitPriceElement.textContent = `Rp ${formatNumber(unitPrice)}`;
            totalPriceElement.textContent = `Rp ${formatNumber(total)}`;
        }

        function formatNumber(number) {
            return new Intl.NumberFormat('id-ID').format(number);
        }

        quantityInput.addEventListener('input', updatePrice);
        flavorSelect.addEventListener('change', updatePrice);

        updatePrice();
    });
</script>
@endsection