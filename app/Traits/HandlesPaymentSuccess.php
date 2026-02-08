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
                }

                // Credit Vendor Wallet
                if ($order->vendor_id) {
                    $vendor = $order->vendor;
                    $wallet = $vendor->wallet()->firstOrCreate(['vendor_id' => $vendor->id], ['balance' => 0]);

                    // Calculation: Vendor gets (Total - Service Fee)
                    $vendorCredit = $order->total_amount - ($order->service_fee ?? 0);

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
