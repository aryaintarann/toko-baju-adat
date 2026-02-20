<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Order;

class PaymentService
{
    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Fix for local SSL issues
        if (config('app.env') === 'local') {
            Config::$curlOptions = [
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_HTTPHEADER => [],
            ];
        }
    }

    public function getSnapToken(Order $order): string
    {
        $params = [
            'transaction_details' => [
                'order_id' => $order->order_number,
                'gross_amount' => (int) $order->total_amount,
            ],
            'customer_details' => [
                'first_name' => $order->customer_name,
                'email' => $order->customer_email,
                'phone' => $order->customer_phone,
                'address' => $order->customer_address,
            ],
            'item_details' => $order->items->map(function ($item) {
                return [
                    'id' => $item->product_id,
                    'price' => (int) $item->price,
                    'quantity' => $item->quantity,
                    'name' => substr($item->product_name, 0, 50),
                ];
            })->toArray(),
        ];

        // Add shipping cost if exists
        if ($order->shipping_cost > 0) {
            $params['item_details'][] = [
                'id' => 'SHIPPING',
                'price' => (int) $order->shipping_cost,
                'quantity' => 1,
                'name' => 'Biaya Pengiriman',
            ];
        }

        try {
            $snapToken = Snap::getSnapToken($params);
            return $snapToken;
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Midtrans Snap Token Error: ' . $e->getMessage());
            // Fallback for development/testing if keys are not set
            if (config('app.env') === 'local') {
                return 'dummy-snap-token-' . $order->order_number;
            }
            throw $e;
        }
    }
}
