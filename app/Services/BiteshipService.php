<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BiteshipService
{
    protected $apiKey;
    protected $baseUrl = 'https://api.biteship.com/v1';

    public function __construct()
    {
        $this->apiKey = env('BITESHIP_API_KEY');
    }

    /**
     * Get shipping rates from Biteship.
     *
     * @param array $origin Address details (postal_code is critical)
     * @param array $destination Address details (postal_code is critical)
     * @param array $items List of items (name, quantity, weight, value)
     * @return array List of available couriers and rates
     */
    public function getShippingRates($origin, $destination, $items)
    {
        try {
            // Validate required fields
            if (empty($origin['postal_code']) || empty($destination['postal_code'])) {
                Log::warning('Biteship: Missing postal code for rates calculation.');
                return [];
            }

            $payload = [
                'origin_postal_code' => $origin['postal_code'],
                'destination_postal_code' => $destination['postal_code'],
                'couriers' => 'jne,sicepat,jnt,anteraja', // Default couriers
                'items' => array_map(function ($item) {
                    return [
                        'name' => $item['name'] ?? 'Item',
                        'value' => $item['price'] ?? 0,
                        'quantity' => $item['quantity'] ?? 1,
                        'weight' => $item['weight'] ?? 1000, // Default 1kg if missing
                    ];
                }, $items),
            ];

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->post($this->baseUrl . '/rates/couriers', $payload);

            if ($response->successful()) {
                $data = $response->json();
                return $data['pricing'] ?? [];
            } else {
                Log::error('Biteship API Error: ' . $response->body());
                return [];
            }
        } catch (\Exception $e) {
            Log::error('Biteship Exception: ' . $e->getMessage());
            return [];
        }
    }
}
