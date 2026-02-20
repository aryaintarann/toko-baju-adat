<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use App\Enums\OrderStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderService
{
    public function createOrder(array $data, array $cartItems): Order
    {
        return DB::transaction(function () use ($data, $cartItems) {
            $order = Order::create([
                'order_number' => Order::generateOrderNumber(),
                'customer_name' => $data['customer_name'],
                'customer_email' => $data['customer_email'],
                'customer_phone' => $data['customer_phone'],
                'customer_address' => $data['customer_address'],
                'total_amount' => 0, // Will be updated
                'status' => OrderStatus::Pending,
                'notes' => $data['notes'] ?? null,
                'courier' => $data['courier'] ?? null,
                'shipping_service' => $data['shipping_service'] ?? null,
                'shipping_cost' => $data['shipping_cost'] ?? 0,
                'province_id' => $data['province_id'] ?? null,
                'city_id' => $data['city_id'] ?? null,
            ]);

            $total = 0;

            foreach ($cartItems as $id => $item) {
                $product = Product::lockForUpdate()->find($id);

                if (!$product)
                    continue;

                // Decrement stock
                if ($product->stock >= $item['quantity']) {
                    $product->decrement('stock', $item['quantity']);
                } else {
                    throw new \Exception("Stok produk {$product->name} tidak mencukupi.");
                }

                $subtotal = $product->price * $item['quantity'];

                $order->items()->create([
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $item['quantity'],
                    'subtotal' => $subtotal,
                ]);

                $total += $subtotal;
            }

            $order->update(['total_amount' => $total + $order->shipping_cost]);

            // Send Emails
            try {
                // To Admin
                $adminEmail = env('ADMIN_EMAIL', config('mail.from.address')); // Use specific admin email or fallback
                \Illuminate\Support\Facades\Mail::to($adminEmail)->send(new \App\Mail\NewOrderAdminMail($order));

                // To Customer
                \Illuminate\Support\Facades\Mail::to($order->customer_email)->send(new \App\Mail\OrderCreatedMail($order));
            } catch (\Exception $e) {
                // Log error but don't fail the checkout process
                \Illuminate\Support\Facades\Log::error('Failed to send order creation emails: ' . $e->getMessage());
            }

            return $order;
        });
    }
}
