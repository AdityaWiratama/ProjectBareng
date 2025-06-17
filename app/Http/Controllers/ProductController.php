<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Promo;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Halaman utama untuk user
    public function home()
    {
        $promos = Promo::all();
        $variants = Product::all();

        return view('home', compact('promos', 'variants'));
    }

    // Tampilkan semua produk (admin)
    public function index()
    {
        $products = Product::latest()->get(); // Urutkan dari terbaru
        return view('admin.products.index', compact('products'));
    }

    // Form tambah produk (admin)
    public function create()
    {
        return view('admin.products.create');
    }

    // Simpan produk baru (admin)
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ]);

        // Handle upload gambar jika ada
        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validatedData);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    // Tampilkan form edit produk (admin)
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    // Update produk (admin)
    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ]);

        // Handle upload gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $validatedData['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validatedData);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    // Hapus produk (admin)
    public function destroy(Product $product)
    {
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus!');
    }

    // =============================
    // Fungsi baru: Menampilkan All Product untuk User
    public function allProducts()
    {
        $products = Product::latest()->get();
        return view('products.all', compact('products'));
    }
}
