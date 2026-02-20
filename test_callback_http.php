<?php

require __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();

// 1. Create a dummy order manually via DB facade (easier than bootstrapping full app just for model creation if we can)
// Actually, let's use the app bootstrap just for DB creation, then use HTTP for callback.

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$app->boot();

use App\Models\Order;
use App\Enums\OrderStatus;

// Create dummy order
$order = Order::create([
    'order_number' => 'ORD-TEST-' . time(),
    'customer_name' => 'Tester',
    'customer_email' => 'test@example.com',
    'customer_phone' => '08123456789',
    'customer_address' => 'Test Address',
    'total_amount' => 50000,
    'status' => OrderStatus::Pending,
    'payment_status' => 'pending',
    'courier' => 'jne',
    'shipping_service' => 'REG',
    'shipping_cost' => 10000,
    'province_id' => 1,
    'city_id' => 1,
]);

echo "Created Order: " . $order->order_number . "\n";

// 2. Send POST request to running server
$url = 'http://127.0.0.1:8000/api/payment/notification';
$payload = [
    'transaction_status' => 'settlement',
    'payment_type' => 'bank_transfer',
    'order_id' => $order->order_number,
    'fraud_status' => 'accept',
];

echo "Sending Callback to $url...\n";

try {
    $response = $client->post($url, [
        'json' => $payload
    ]);

    echo "Response Status: " . $response->getStatusCode() . "\n";
    echo "Response Body: " . $response->getBody() . "\n";

    // 3. Verify
    $order->refresh();
    echo "Updated Order Status: " . $order->status->value . "\n";
    echo "Updated Payment Status: " . $order->payment_status . "\n";

} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    if (method_exists($e, 'getResponse') && $e->getResponse()) {
        echo "Response: " . $e->getResponse()->getBody() . "\n";
    }
}
