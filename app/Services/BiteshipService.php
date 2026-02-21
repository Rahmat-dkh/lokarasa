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
     * @param string $couriers Comma-separated list of couriers
     * @return array List of available couriers and rates
     */
    public function getShippingRates($origin, $destination, $items, $couriers = 'jne,sicepat,jnt,anteraja')
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
                'couriers' => $couriers,
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
    /**
     * Create a shipment in Biteship.
     *
     * @param array $payload Shipment details
     * @return array Response from Biteship
     */
    public function createShipment($payload)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->post($this->baseUrl . '/orders', $payload);

            if ($response->successful()) {
                return $response->json();
            } else {
                Log::error('Biteship Create Shipment Error: ' . $response->body());
                return ['success' => false, 'message' => $response->body()];
            }
        } catch (\Exception $e) {
            Log::error('Biteship Create Shipment Exception: ' . $e->getMessage());
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * Get shipment details from Biteship.
     */
    public function getShipment($shipmentId)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
            ])->get($this->baseUrl . '/orders/' . $shipmentId);

            if ($response->successful()) {
                return $response->json();
            } else {
                Log::error('Biteship Get Shipment Error: ' . $response->body());
                return ['success' => false, 'message' => $response->body()];
            }
        } catch (\Exception $e) {
            Log::error('Biteship Get Shipment Exception: ' . $e->getMessage());
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * Get shipping label from Biteship.
     */
    public function getLabel($shipmentId)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
            ])->get($this->baseUrl . '/orders/' . $shipmentId . '/label');

            if ($response->successful()) {
                return $response->json();
            } else {
                Log::error('Biteship Get Label Error: ' . $response->body());
                return ['success' => false, 'message' => $response->body()];
            }
        } catch (\Exception $e) {
            Log::error('Biteship Get Label Exception: ' . $e->getMessage());
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
