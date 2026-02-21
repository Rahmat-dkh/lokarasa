<?php

namespace App\Traits;

use App\Models\Order;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\DB;

trait HandlesPaymentSuccess
{
    /**
     * Process multiple orders that have been successfully paid.
     */
    protected function processPaymentSuccess($orders, $description = 'Payment Success')
    {
        foreach ($orders as $order) {
            // Check if wallet transaction already exists for this order to avoid double credit
            $alreadyCredited = WalletTransaction::where('reference_id', $order->id)
                ->where('type', 'credit')
                ->exists();

            if (!$alreadyCredited) {
                // Only update status to processing if it was still pending
                if ($order->status === 'pending') {
                    $order->update(['status' => 'processing']);

                    // AUTOMATED SHIPMENT CREATION WITH BITESHIP
                    // Only if shipping_courier and shipping_service are present
                    if ($order->shipping_courier && $order->shipping_service && $order->vendor) {
                        try {
                            $vendor = $order->vendor;
                            $user = $order->user;
                            $biteship = new \App\Services\BiteshipService();

                            $items = [];
                            foreach ($order->items as $item) {
                                $items[] = [
                                    'name' => $item->product->name,
                                    'description' => $item->product->name,
                                    'value' => (int) $item->price,
                                    'quantity' => (int) $item->quantity,
                                    'weight' => $item->product->weight > 0 ? (int) $item->product->weight : 1000
                                ];
                            }

                            $payload = [
                                'shipper_name' => $vendor->shop_name ?? 'Vendor',
                                'shipper_phone' => $vendor->user->phone ?? '6285712966082',
                                'origin_contact_name' => $vendor->shop_name ?? 'Vendor',
                                'origin_contact_phone' => $vendor->user->phone ?? '6285712966082',
                                'origin_address' => $vendor->address ?? 'Alamat Vendor',
                                'origin_postal_code' => (int) ($vendor->postal_code ?? 10110),
                                'destination_contact_name' => $user->name,
                                'destination_contact_phone' => $order->phone ?? '6285712966082',
                                'destination_address' => $order->shipping_address,
                                'destination_postal_code' => (int) (substr($order->shipping_address, -5)), // Assumption: last 5 chars are postal code
                                'courier_company' => $order->shipping_courier,
                                'courier_type' => $order->shipping_service,
                                'delivery_type' => 'now', // immediate processing
                                'items' => $items
                            ];

                            $response = $biteship->createShipment($payload);

                            if (isset($response['id'])) {
                                // Extract label URL from metadata or use the official tracking/label link from Biteship
                                $labelUrl = $response['metadata']['label_url'] ?? ($response['courier']['link'] ?? null);

                                $order->update([
                                    'shipment_id' => $response['id'],
                                    'tracking_number' => $response['courier']['tracking_id'] ?? null,
                                    'shipping_label' => $labelUrl,
                                ]);
                            }
                        } catch (\Exception $e) {
                            \Illuminate\Support\Facades\Log::error('Biteship Auto-Shipment Failed: ' . $e->getMessage());
                        }
                    }
                }

                // Credit Vendor Wallet
                if ($order->vendor_id) {
                    $vendor = $order->vendor;
                    $wallet = $vendor->wallet()->firstOrCreate(['vendor_id' => $vendor->id], ['balance' => 0]);

                    // Calculation: Vendor gets only the product price (Total - Service Fee - Shipping Cost)
                    $vendorCredit = $order->total_amount - ($order->service_fee ?? 0) - ($order->shipping_cost ?? 0);

                    $wallet->increment('balance', $vendorCredit);

                    WalletTransaction::create([
                        'vendor_wallet_id' => $wallet->id,
                        'amount' => $vendorCredit,
                        'type' => 'credit',
                        'description' => $description . ' for Order Ref: ' . $order->payment_reference,
                        'reference_id' => $order->id,
                    ]);
                }
            }
        }
    }
}
