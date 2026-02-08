<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MidtransNotificationController extends Controller
{
    use \App\Traits\HandlesPaymentSuccess;

    public function handle(Request $request)
    {
        $payload = $request->all();
        $orderId = $payload['order_id'];
        $statusCode = $payload['status_code'];
        $grossAmount = $payload['gross_amount'];
        $signatureKey = $payload['signature_key'];

        $serverKey = config('midtrans.server_key');

        // Verify Signature
        $signature = hash("sha512", $orderId . $statusCode . $grossAmount . $serverKey);

        if ($signature !== $signatureKey) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $transactionStatus = $payload['transaction_status'];
        $type = $payload['payment_type'];
        $fraudStatus = $payload['fraud_status'] ?? null;

        $orders = Order::where('payment_reference', $orderId)->get();

        if ($orders->isEmpty()) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        DB::beginTransaction();
        try {
            if ($transactionStatus == 'capture') {
                if ($type == 'credit_card') {
                    if ($fraudStatus == 'challenge') {
                        $this->updateOrdersStatus($orders, 'pending');
                    } else {
                        $this->processPaymentSuccess($orders);
                    }
                }
            } elseif ($transactionStatus == 'settlement') {
                $this->processPaymentSuccess($orders, 'Midtrans Settlement');
            } elseif ($transactionStatus == 'pending') {
                $this->updateOrdersStatus($orders, 'pending');
            } elseif ($transactionStatus == 'deny') {
                $this->updateOrdersStatus($orders, 'failed');
            } elseif ($transactionStatus == 'expire') {
                $this->updateOrdersStatus($orders, 'failed');
            } elseif ($transactionStatus == 'cancel') {
                $this->updateOrdersStatus($orders, 'failed');
            }

            DB::commit();
            return response()->json(['message' => 'Notification handled']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Midtrans Notification Error: ' . $e->getMessage());
            return response()->json(['message' => 'Error processing notification'], 500);
        }
    }

    private function updateOrdersStatus($orders, $status)
    {
        foreach ($orders as $order) {
            $order->update(['status' => $status]);
        }
    }
}
