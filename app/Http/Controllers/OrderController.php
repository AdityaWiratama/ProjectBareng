<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
                'name' => 'Bika Ambon Matcha',
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
                'name' => 'Bika Ambon Durian',
                'image' => 'https://img-global.cpcdn.com/recipes/bb61eb8e38cf85a7/680x482cq70/bika-ambon-durian-ekonomis-foto-resep-utama.jpg',
                'price' => '35000',
                'description' => 'Aroma durian khas yang menggoda selera.',
            ],
            'matcha' => [
                'name' => 'Bika Ambon Matcha',
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
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTxvQx8xKxv8rQxEqQjvLYzQKzJjKzZBFQNnA&s',
                'price' => '32000',
                'description' => 'Taburan keju melimpah, bikin makin nikmat!',
            ],
            'red_velvet' => [
                'name' => 'Bika Ambon Red Velvet',
                'image' => 'https://img-global.cpcdn.com/recipes/c0acf7368481ec21/680x482cq70/bika-ambon-red-velvet-gluten-free-foto-resep-utama.jpg',
                'price' => '35000',
                'description' => 'Warna merah cantik dengan rasa yang lembut dan manis.',
            ],
            'ubi_unggu' => [
                'name' => 'Bika Ambon Ubi Unggu',
                'image' => 'https://img-global.cpcdn.com/recipes/d18fc3ad3e7788f7/680x482cq70/bika-ambon-ubi-ungu-pr_kuetradisionalberserat-foto-resep-utama.jpg',
                'price' => '32000',
                'description' => 'Rasa manis alami ubi unggu yang kaya nutrisi.',
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
        'flavor' => 'required|string',
    ]);

    // Konversi flavor jadi slug (contoh: "Red Velvet" => "red_velvet")
    $productSlug = strtolower(str_replace(' ', '_', $validated['flavor']));

    $product = $this->getProductData($productSlug);
    $totalPrice = intval($product['price']) * $validated['quantity'];

    $order = Order::create([
        'name' => $validated['name'],
        'phone' => $validated['phone'],
        'address' => $validated['address'],
        'quantity' => $validated['quantity'],
        'flavor' => $validated['flavor'],
        'product_slug' => $productSlug,
        'total_price' => $totalPrice,
        'status' => 'pending',
    ]);

    return redirect()->route('order.success')->with('order', $order);
}
    public function success()
    {
        $order = session('order');

        if (!$order) {
            return redirect()->route('home')->with('error', 'Data pesanan tidak ditemukan.');
        }

        return view('order.success', compact('order'));
    }

    public function confirmation()
    {
        return $this->success();
    }

    public function index()
    {
        $orders = Order::latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,shipped,completed',
        ]);

        $order = Order::findOrFail($id);
        $order->status = $validated['status'];
        $order->save();

        return redirect()->route('admin.orders.index')->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function history()
    {
        $orders = Order::where('phone', 'like', '%' . (request()->user()->phone ?? '') . '%')->latest()->get();

        foreach ($orders as $order) {
            $order->product = $this->getProductData($order->product_slug);
        }

        return view('order.history', compact('orders'));
    }
}
