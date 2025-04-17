<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    // Menampilkan halaman form pemesanan
    public function create()
    {
        return view('order.create');
    }

    // Menyimpan pesanan ke database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'flavor' => 'required|string',
        ]);
    
        // Simpan ke database
        Order::create([
            'name' => $request->name,
            'flavor' => $request->flavor,
        ]);
    
        // Redirect ke halaman sukses
        return redirect()->route('orders.success')->with('success', 'Pesanan berhasil dibuat!');
    }
    

    // Menampilkan halaman sukses setelah pemesanan
    public function success()
    {
        return view('order.success');
    }
}

