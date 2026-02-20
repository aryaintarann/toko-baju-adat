<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('items')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(10)->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('items');
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,completed,cancelled,refunded',
        ]);

        $order->update(['status' => $request->status]);

        try {
            \Illuminate\Support\Facades\Mail::to($order->customer_email)->send(new \App\Mail\OrderStatusUpdatedMail($order));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Failed to send OrderStatusUpdatedMail: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui!');
    }
}
