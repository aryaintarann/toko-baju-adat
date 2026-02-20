<?php

require __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();
$url = 'http://127.0.0.1:8000/api/payment/notification';

$payload = [
    'transaction_time' => '2026-02-20 15:00:00',
    'transaction_status' => 'settlement',
    'transaction_id' => 'TRANS-ID-' . time(),
    'status_message' => 'midtrans payment notification',
    'status_code' => '200',
    'signature_key' => 'dummy-signature',
    'payment_type' => 'bank_transfer',
    'order_id' => 'ORD-CALLBACK-1771558822',
    'merchant_id' => 'G123456789',
    'gross_amount' => '75000.00',
    'fraud_status' => 'accept',
    'currency' => 'IDR',
];

echo "Sending JSON Payload:\n" . json_encode($payload, JSON_PRETTY_PRINT) . "\n\n";

try {
    $response = $client->post($url, [
        'json' => $payload
    ]);

    echo "Response Status: " . $response->getStatusCode() . "\n";
    echo "Response Body: " . $response->getBody() . "\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    if (method_exists($e, 'getResponse') && $e->getResponse()) {
        echo "Response: " . $e->getResponse()->getBody() . "\n";
    }
}
