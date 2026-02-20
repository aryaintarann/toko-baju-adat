<?php

use Illuminate\Support\Facades\Http;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->handle(Illuminate\Http\Request::capture());

$baseUrl = 'https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost';
$apiKey = 'VaqabfPNde9556a57b7755865cmR4nhn';

$payload = [
    'Origin' => 26027, // Denpasar ID
    'Destination' => 26031, // Padangsambian (from previous search)
    'Weight' => 1000,
    'Courier' => 'JNE'
];

$response = Http::withoutVerifying()
    ->withHeaders(['key' => $apiKey])
    ->post($baseUrl, $payload);

echo "Status: " . $response->status() . "\n";
echo "Body: " . $response->body();
