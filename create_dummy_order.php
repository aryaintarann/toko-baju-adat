<?php

use App\Models\Order;
use App\Enums\OrderStatus;

$order = Order::create([
    'order_number' => 'ORD-CALLBACK-' . time(),
    'customer_name' => 'Callback Tester',
    'customer_email' => 'callback@test.com',
    'customer_phone' => '08123456789',
    'customer_address' => 'Test Address',
    'total_amount' => 75000,
    'status' => OrderStatus::Pending,
    'payment_status' => 'pending',
    'courier' => 'jne',
    'shipping_service' => 'REG',
    'shipping_cost' => 15000,
    'province_id' => 1,
    'city_id' => 1,
]);

echo "ORDER_NUMBER=" . $order->order_number;
