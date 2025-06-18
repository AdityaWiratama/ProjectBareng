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
            'original' => [
                'name' => 'Bika Ambon Original',
                'price' => 28000,
            ],
            'keju' => [
                'name' => 'Bika Ambon Keju',
                'price' => 32000,
            ],
            'red_velvet' => [
                'name' => 'Bika Ambon Red Velvet',
                'price' => 35000,
            ],
            'pandan' => [
                'name' => 'Bika Ambon Pandan',
                'price' => 30000,
            ],
        ];

        return $products[$slug] ?? ['name' => 'Produk Tidak Dikenal', 'price' => 0];
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
            'user_id' => auth()->id(),
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
        $orders = Order::where('user_id', auth()->id())->latest()->get();

        foreach ($orders as $order) {
            $order->product = $this->getProductData($order->product_slug);
        }

        return view('order.history', compact('orders'));
    }

    public function destroy(Order $order) // Menggunakan Route Model Binding
    {
        $order->delete(); // Menghapus data order

        // Redirect atau berikan respons setelah penghapusan
        return redirect()->back()->with('success', 'Order berhasil dihapus!');
        // Atau:
        // return response()->json(['message' => 'Order berhasil dihapus!']);
    }
}
