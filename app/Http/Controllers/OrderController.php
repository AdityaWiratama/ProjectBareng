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
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'phone' => 'required|integer',
        //     'address' => 'required|string|max:255',
        //     'quantity' => 'required|interger',
        //     'status' => 'required|string|max:255',
        // ]);
    
        // Simpan ke database

        $status="pending";
        Order::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'quantity' => $request->quantity,
            'status' => $status,
        ]);
    
        // Redirect ke halaman sukses
        return redirect()->route('order.success')->with('success', 'Pesanan berhasil dibuat!');
    }
    

    // Menampilkan halaman sukses setelah pemesanan
    public function success()
    {
        return view('order.success');
    }
}

