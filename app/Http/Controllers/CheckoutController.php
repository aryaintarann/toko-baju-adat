<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja kosong!');
        }

        $cartItems = [];
        $total = 0;

        foreach ($cart as $id => $item) {
            $product = Product::find($id);
            if ($product) {
                $subtotal = $product->price * $item['quantity'];
                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $item['quantity'],
                    'subtotal' => $subtotal,
                ];
                $total += $subtotal;
            }
        }

        return view('checkout.index', compact('cartItems', 'total'));
    }

    public function store(\App\Http\Requests\StoreOrderRequest $request, \App\Services\OrderService $orderService)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja kosong!');
        }

        try {
            // Transform cart session data to match Product ID keys
            $order = $orderService->createOrder($request->validated(), $cart);

            // Clear cart
            session()->forget('cart');

            return redirect()->route('checkout.success', $order->id)
                ->with('success', 'Pesanan berhasil dibuat!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function success($orderId, \App\Services\PaymentService $paymentService)
    {
        $order = Order::with('items')->findOrFail($orderId);

        if ($order->status === \App\Enums\OrderStatus::Pending && !$order->snap_token) {
            $order->snap_token = $paymentService->getSnapToken($order);
            $order->save();
        }

        return view('checkout.success', compact('order'));
    }
}
