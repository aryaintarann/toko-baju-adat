<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ShippingService
{
    protected $apiKey;
    protected $baseUrl;
    protected $origin;

    public function __construct()
    {
        $this->apiKey = config('services.rajaongkir.key');
        $this->baseUrl = config('services.rajaongkir.base_url', 'https://rajaongkir.komerce.id/api/v1');
        $this->origin = config('services.rajaongkir.origin', '114'); // Default 114 (Denpasar)
    }

    public function searchDestination($search)
    {
        try {
            $response = Http::withoutVerifying()
                ->withHeaders(['key' => $this->apiKey])
                ->get($this->baseUrl . '/destination/domestic-destination', [
                    'search' => $search
                ]);

            if ($response->successful()) {
                // Komerce returns data directly or inside 'data'? 
                // Based on standard Komerce/Laravel wrapper, often 'data'.
                // If direct list, we'll see.
                // Safest to return json()['data'] if exists, else json().
                $json = $response->json();
                return $json['data'] ?? $json;
                // Actually, based on search result: "The Komerce API ... provides a structured JSON response containing a list".
                // I'll assume 'data' key is standard for Komerce.
            } else {
                Log::error('Komerce SearchDestination Failed: ' . $response->body());
            }
        } catch (\Exception $e) {
            Log::error('Komerce SearchDestination Connection Error: ' . $e->getMessage());
        }

        return [];
    }

    public function getCost($destination, $weight, $courier)
    {
        try {
            $response = Http::withoutVerifying()
                ->asForm()
                ->withHeaders(['key' => $this->apiKey])
                ->post($this->baseUrl . '/calculate/domestic-cost', [
                    'origin' => $this->origin,
                    'destination' => $destination,
                    'weight' => $weight,
                    'courier' => strtolower($courier),
                ]);

            if ($response->successful()) {
                // Return data directly (array of services).
                // Example response data item: 
                // { "service": "CTC", "description": "JNE City Courier", "cost": 9000, "etd": "1 day" }
                // We map it to match what checkout JS expects: 
                // service.cost[0].value and service.cost[0].etd

                $data = $response->json()['data'] ?? [];

                return array_map(function ($item) {
                    return [
                        'service' => $item['service'],
                        'description' => $item['description'],
                        'cost' => [
                            [
                                'value' => $item['cost'],
                                'etd' => $item['etd']
                            ]
                        ]
                    ];
                }, $data);
            } else {
                Log::error('RajaOngkir GetCost Failed: ' . $response->body());
            }
        } catch (\Exception $e) {
            Log::error('RajaOngkir GetCost Connection Error: ' . $e->getMessage());
        }

        return [];
    }
}
