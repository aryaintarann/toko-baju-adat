<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderTrackingController extends Controller
{
    public function index()
    {
        return view('tracking.index');
    }

    public function track(Request $request)
    {
        $request->validate([
            'order_number' => 'required|string',
        ]);

        $order = Order::with('items')->where('order_number', $request->order_number)->first();

        if (!$order) {
            return back()->withInput()->with('error', 'Pesanan tidak ditemukan. Pastikan Nomor Pesanan sudah benar.');
        }

        return view('tracking.index', compact('order'));
    }
}
