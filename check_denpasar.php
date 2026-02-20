<?php

use Illuminate\Support\Facades\Http;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->handle(Illuminate\Http\Request::capture());

$baseUrl = 'https://rajaongkir.komerce.id/api/v1/destination/domestic-destination';
$apiKey = 'VaqabfPNde9556a57b7755865cmR4nhn';

$response = Http::withoutVerifying()->withHeaders(['key' => $apiKey])->get($baseUrl, ['search' => 'Denpasar']);

echo $response->body();
