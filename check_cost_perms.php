<?php

use Illuminate\Support\Facades\Http;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->handle(Illuminate\Http\Request::capture());

$baseUrl = 'https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost';
$apiKey = 'VaqabfPNde9556a57b7755865cmR4nhn';

echo "Testing PascalCase JSON:\n";
$payload = [
    'Origin' => 26027,
    'Destination' => 26031,
    'Weight' => 1000,
    'Courier' => 'JNE'
];
$response = Http::withoutVerifying()->withHeaders(['key' => $apiKey])->post($baseUrl, $payload);
echo "Status: " . $response->status() . " Body: " . $response->body() . "\n\n";

echo "Testing lowercase JSON:\n";
$payload = [
    'origin' => 26027,
    'destination' => 26031,
    'weight' => 1000,
    'courier' => 'jne'
];
$response = Http::withoutVerifying()->withHeaders(['key' => $apiKey])->post($baseUrl, $payload);
echo "Status: " . $response->status() . " Body: " . $response->body() . "\n\n";

echo "Testing PascalCase Form:\n";
$payload = [
    'Origin' => 26027,
    'Destination' => 26031,
    'Weight' => 1000,
    'Courier' => 'JNE'
];
$response = Http::withoutVerifying()->asForm()->withHeaders(['key' => $apiKey])->post($baseUrl, $payload);
echo "Status: " . $response->status() . " Body: " . $response->body() . "\n\n";

echo "Testing lowercase Form:\n";
$payload = [
    'origin' => 26027,
    'destination' => 26031,
    'weight' => 1000,
    'courier' => 'jne'
];
$response = Http::withoutVerifying()->asForm()->withHeaders(['key' => $apiKey])->post($baseUrl, $payload);
echo "Status: " . $response->status() . " Body: " . $response->body() . "\n\n";
