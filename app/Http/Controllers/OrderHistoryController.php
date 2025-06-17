<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderHistoryController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->get();
        return view('order.history', compact('orders'));
    }

    public function history()
{
    $orders = Order::where('user_id', Auth::id())->latest()->get();
    return view('order.history', compact('orders'));
}

}
