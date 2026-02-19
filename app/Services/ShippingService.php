<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ShippingService
{
    protected $apiKey;
    protected $baseUrl;
    protected $origin;

    public function __construct()
    {
        $this->apiKey = config('services.rajaongkir.key');
        $this->baseUrl = 'https://api.rajaongkir.com/starter';
        $this->origin = config('services.rajaongkir.origin', '114'); // Default 114 (Denpasar)
    }

    public function getProvinces()
    {
        try {
            $response = Http::withHeaders(['key' => $this->apiKey])
                ->get($this->baseUrl . '/province');

            if ($response->successful()) {
                return $response->json()['rajaongkir']['results'];
            }
        } catch (\Exception $e) {
            // Fallback
        }

        return [];
    }

    public function getCities($provinceId)
    {
        try {
            $response = Http::withHeaders(['key' => $this->apiKey])
                ->get($this->baseUrl . '/city', ['province' => $provinceId]);

            if ($response->successful()) {
                return $response->json()['rajaongkir']['results'];
            }
        } catch (\Exception $e) {
            // Fallback
        }

        return [];
    }

    public function getCost($destination, $weight, $courier)
    {
        try {
            $response = Http::withHeaders(['key' => $this->apiKey])
                ->post($this->baseUrl . '/cost', [
                    'origin' => $this->origin,
                    'destination' => $destination,
                    'weight' => $weight,
                    'courier' => $courier,
                ]);

            if ($response->successful()) {
                return $response->json()['rajaongkir']['results'][0]['costs'];
            }
        } catch (\Exception $e) {
            // Fallback
        }

        return [];
    }
}
