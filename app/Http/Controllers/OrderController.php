<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    // Menampilkan halaman home dengan produk dan promo
    public function home()
    {
        $promos = $this->getPromotedProducts();
        return view('home', compact('promos'));
    }

    public function create(Request $request)
    {
        // Ambil informasi produk yang dipilih
        $product = $this->getProductData($request->get('product', 'original'));

        return view('order.create', compact('product'));
    }

    private function getPromotedProducts()
    {
        return [
            [
                'name' => 'Bika Ambon Durian',
                'image' => 'https://img-global.cpcdn.com/recipes/bb61eb8e38cf85a7/680x482cq70/bika-ambon-durian-ekonomis-foto-resep-utama.jpg',
                'price' => '35000',
                'old_price' => '45000',
                'description' => 'Aroma durian khas yang menggoda selera.',
                'slug' => 'durian',
            ],
            [
                'name' => 'Bika Ambon Red Velvet',
                'image' => 'https://img-global.cpcdn.com/recipes/2a0fdf18c502cc94/680x482cq70/bika-ambon-matcha-foto-resep-utama.jpg',
                'price' => '32000',
                'old_price' => '42000',
                'description' => 'Rasa unik matcha untuk pecinta teh hijau.',
                'slug' => 'matcha',
            ],
            [
                'name' => 'Bika Ambon Original',
                'image' => 'https://pemerintahsumut.wordpress.com/wp-content/uploads/2014/12/bika-ambon.jpg',
                'price' => '28000',
                'old_price' => '38000',
                'description' => 'Rasa klasik yang tak pernah gagal memanjakan lidah.',
                'slug' => 'original',
            ],
        ];
    }

    private function getProductData($slug)
    {
        $products = [
            'durian' => [
                'name' => 'Bika Ambon Ubi Ungu',
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSfKS8poRRQ6aQ0FrDVvN6D-Qn4VagfMEufYg&s',
                'price' => '35000',
                'description' => 'Aroma durian khas yang menggoda selera.',
            ],
            'matcha' => [
                'name' => 'Bika Ambon Red Velvet',
                'image' => 'https://img-global.cpcdn.com/recipes/2a0fdf18c502cc94/680x482cq70/bika-ambon-matcha-foto-resep-utama.jpg',
                'price' => '32000',
                'description' => 'Rasa unik matcha untuk pecinta teh hijau.',
            ],
            'original' => [
                'name' => 'Bika Ambon Original',
                'image' => 'https://pemerintahsumut.wordpress.com/wp-content/uploads/2014/12/bika-ambon.jpg',
                'price' => '28000',
                'description' => 'Rasa klasik yang tak pernah gagal memanjakan lidah.',
            ],
            'coklat' => [
                'name' => 'Bika Ambon Coklat',
                'image' => 'https://img-global.cpcdn.com/recipes/b6d18cb817e00d92/680x482cq70/bika-ambon-coklat-foto-resep-utama.jpg',
                'price' => '30000',
                'description' => 'Kelezatan coklat berpadu dengan tekstur lembut Bika Ambon.',
            ],
            'pandan' => [
                'name' => 'Bika Ambon Pandan',
                'image' => 'https://img-global.cpcdn.com/recipes/8666eec402d3f1f0/680x482cq70/bika-ambon-pandan-foto-resep-utama.jpg',
                'price' => '30000',
                'description' => 'Aroma harum pandan yang menggugah selera.',
            ],
            'keju' => [
                'name' => 'Bika Ambon Keju',
                'image' => 'https://pemerintahsumut.wordpress.com/wp-content/uploads/2014/12/bika-ambon.jpg',
                'price' => '32000',
                'description' => 'Taburan keju melimpah, bikin makin nikmat!',
            ]
        ];

        return $products[$slug] ?? $products['original'];
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'flavor' => 'required|string|in:original,durian,matcha,coklat,pandan,keju',
            'product_slug' => 'required|string|in:original,durian,matcha',
        ]);

        $product = $this->getProductData($validated['product_slug']);
        $totalPrice = $product['price'] * $validated['quantity'];

        $order = Order::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'quantity' => $validated['quantity'],
            'flavor' => $validated['flavor'],
            'product_slug' => $validated['product_slug'],
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        return redirect()->route('order.success')->with([
            'success' => 'Pesanan berhasil dibuat!',
            'order' => $order
        ]);
    }

    public function success()
    {
        $order = session('order');
        return view('order.success', compact('order'));
    }

    public function confirmation()
    {
        return $this->success();
    }

    // Halaman admin list pesanan
    public function index()
    {
        $orders = Order::latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    // Detail pesanan
    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    // ✅ Tambahkan: Form edit status pesanan
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.orders.edit', compact('order'));
    }

    // ✅ Sudah ada: Update status pesanan
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,shipped,completed',
        ]);

        $order = Order::findOrFail($id);
        $order->name = 'name';
        // $order->products = 'products';
        $order->status = $validated['status'];
        $order->save();

        return redirect()->route('admin.orders.index')->with('success', 'Status pesanan berhasil diperbarui.');
    }
}
