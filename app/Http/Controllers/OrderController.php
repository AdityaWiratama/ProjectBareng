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
        // Ambil informasi produk yang dipilih (promo atau varian)
        $product = $this->getProductData($request->get('product', 'original'));

        return view('order.create', compact('product'));
    }

    // Mendapatkan data produk yang sedang promo
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

    // Mendapatkan data produk
    private function getProductData($slug)
    {
        $products = [
            'durian' => [
                'name' => 'Bika Ambon Durian',
                'image' => 'https://www.bing.com/images/search?view=detailv2&iss=sbi&FORM=recidp&sbisrc=ImgDropper&q=gambar+bika+ambon+durian&imgurl=https://bing.com/th?id=OSK.7e0443fdf84f410c06ce71ef5b423aaa&idpbck=1&sim=4&pageurl=bfc2ef4617728ca1420a324f17c4c581&idpp=recipe&ajaxhist=0&ajaxserp=0',
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

        // Default to original if slug is not found
        return $products[$slug] ?? $products['original'];
    }

    // Menyimpan pesanan ke database
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'flavor' => 'required|string|in:original,durian,matcha,coklat,pandan,keju',
            'product_slug' => 'required|string|in:original,durian,matcha',  // Validasi slug produk
        ]);

        // Dapatkan info produk
        $product = $this->getProductData($validated['product_slug']);
        
        // Hitung total harga
        $totalPrice = $product['price'] * $validated['quantity'];

        // Simpan pesanan ke dalam database
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

        // Redirect ke halaman sukses dengan pesan
        return redirect()->route('order.success')->with([
            'success' => 'Pesanan berhasil dibuat!', 
            'order' => $order
        ]);
    }

    // Menampilkan halaman sukses pemesanan
    public function success()
    {
        // Ambil data order dari session jika ada
        $order = session('order');
        
        return view('order.success', compact('order'));
    }
    
    // Alias method untuk confirmation (untuk backward compatibility)
    public function confirmation()
    {
        // Redirect ke success method untuk compatibility
        return $this->success();
    }
}