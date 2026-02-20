<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// We need to properly initialize the application to usage of Facades and Eloquent
$app->boot();

use App\Models\Order;
use App\Enums\OrderStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

// 1. Create a dummy order for testing
$order = App\Models\Order::create([
    'order_number' => 'ORD-TEST-' . time(),
    'customer_name' => 'Tester',
    'customer_email' => 'test@example.com',
    'customer_phone' => '08123456789',
    'customer_address' => 'Test Address',
    'total_amount' => 50000,
    'status' => App\Enums\OrderStatus::Pending,
    'payment_status' => 'pending',
    'courier' => 'jne',
    'shipping_service' => 'REG',
    'shipping_cost' => 10000,
    'province_id' => 1,
    'city_id' => 1,
]);

echo "Created Order: " . $order->order_number . " with status " . $order->status->value . "\n";

// 2. Simulate Callback Request
$payload = [
    'transaction_status' => 'settlement',
    'payment_type' => 'bank_transfer',
    'order_id' => $order->order_number,
    'fraud_status' => 'accept',
];

$request = Illuminate\Http\Request::create(
    '/api/payment/notification',
    'POST',
    $payload
);

$response = $kernel->handle($request);

echo "Response Status: " . $response->getStatusCode() . "\n";
echo "Response Body: " . $response->getContent() . "\n";

// 3. Verify Order Status Updated
$order->refresh();
echo "Updated Order Status: " . $order->status->value . "\n"; // Should be processing
echo "Updated Payment Status: " . $order->payment_status . "\n"; // Should be paid
