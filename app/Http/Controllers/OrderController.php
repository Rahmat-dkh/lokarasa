<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    use \App\Traits\HandlesPaymentSuccess;

    public function checkout()
    {
        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Cart is empty');
        }

        $productIds = array_keys($cart);
        // Eager load vendor
        $products = Product::with('vendor')->whereIn('id', $productIds)->get();

        // Group products by Vendor
        // If product has no vendor (legacy), group under 'LocalGo' (null)
        $grouped = $products->groupBy(function ($item) {
            return $item->vendor_id ?? 'default';
        });

        $orderGroups = [];
        $grandTotal = 0;

        foreach ($grouped as $vendorId => $vendorProducts) {
            if ($vendorId === 'default') {
                $vendorName = 'LocalGo Commerce (Official)';
                $realVendorId = null;
            } else {
                $vendorName = $vendorProducts->first()->vendor->shop_name ?? 'Unknown Vendor';
                $realVendorId = $vendorId;
            }

            $subtotal = 0;
            foreach ($vendorProducts as $product) {
                // Ensure quantity exists
                if (isset($cart[$product->id])) {
                    $qty = $cart[$product->id]['quantity'];
                    $subtotal += $product->price * $qty;
                    $product->cart_qty = $qty; // Attach temp property
                }
            }

            // Calculation Service Fee (Example: 2000 flat)
            $serviceFee = 2000;
            // Get Vendor Shipping Cost or Default
            $vendor = $vendorProducts->first()->vendor;
            $shippingCost = $vendor ? $vendor->flat_shipping_cost : 10000;

            $total = $subtotal + $serviceFee + $shippingCost;

            $orderGroups[] = [
                'vendor_id' => $realVendorId,
                'vendor_name' => $vendorName,
                'products' => $vendorProducts,
                'subtotal' => $subtotal,
                'service_fee' => $serviceFee,
                'shipping_cost' => $shippingCost,
                'total' => $total
            ];

            $grandTotal += $total;
        }

        $addresses = auth()->user()->addresses;

        return view('checkout.index', compact('orderGroups', 'addresses', 'grandTotal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'address_id' => 'required|exists:addresses,id',
        ]);

        $cart = Session::get('cart', []);
        if (empty($cart))
            return redirect()->route('products.index');

        $productIds = array_keys($cart);
        $products = Product::whereIn('id', $productIds)->get();
        $grouped = $products->groupBy(function ($item) {
            return $item->vendor_id ?? 'default';
        });

        $address = \App\Models\Address::find($request->address_id);
        $paymentReference = 'ORD-' . strtoupper(Str::random(10));
        $grandTotal = 0;

        DB::beginTransaction();
        try {
            foreach ($grouped as $vendorId => $vendorProducts) {
                $realVendorId = ($vendorId === 'default') ? null : $vendorId;

                $subtotal = 0;
                foreach ($vendorProducts as $p) {
                    $qty = $cart[$p->id]['quantity'];
                    $subtotal += $p->price * $qty;
                }

                $serviceFee = 2000;
                // Get Vendor Shipping Cost or Default
                $vendor = $vendorProducts->first()->vendor;
                $shippingCost = $vendor ? $vendor->flat_shipping_cost : 10000;
                $totalAmount = $subtotal + $serviceFee + $shippingCost;
                $grandTotal += $totalAmount;

                $order = Order::create([
                    'user_id' => auth()->id(),
                    'vendor_id' => $realVendorId,
                    'payment_reference' => $paymentReference,
                    'total_amount' => $totalAmount,
                    'status' => 'pending',
                    'shipping_address' => $address->address_line . ', ' . $address->city . ', ' . $address->province . ' - ' . $address->postal_code,
                    'phone' => $address->phone,
                    'service_fee' => $serviceFee,
                    'shipping_cost' => $shippingCost,
                ]);

                // Update user phone if empty
                if (!auth()->user()->phone && $address->phone) {
                    auth()->user()->update(['phone' => $address->phone]);
                }

                foreach ($vendorProducts as $p) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $p->id,
                        'vendor_id' => $realVendorId,
                        'quantity' => $cart[$p->id]['quantity'],
                        'price' => $p->price,
                    ]);
                }
            }

            // Clear Cart
            Session::forget('cart');
            DB::commit();

            // Midtrans Integration
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            \Midtrans\Config::$isProduction = config('midtrans.is_production');
            \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
            \Midtrans\Config::$is3ds = config('midtrans.is_3ds');

            $params = [
                'transaction_details' => [
                    'order_id' => $paymentReference,
                    'gross_amount' => (int) $grandTotal,
                ],
                'customer_details' => [
                    'first_name' => auth()->user()->name,
                    'email' => auth()->user()->email,
                    'phone' => $address->phone,
                ],
            ];

            try {
                $snapToken = \Midtrans\Snap::getSnapToken($params);
                return view('checkout.payment', compact('snapToken', 'grandTotal', 'paymentReference'));
            } catch (\Exception $e) {
                // Determine if it is a configuration error
                if (empty(config('midtrans.server_key'))) {
                    return redirect()->route('orders.index')->with('success', 'Order placed successfully! Ref: ' . $paymentReference . '. (Midtrans Key missing, assuming COD/Manual)');
                }
                return redirect()->route('orders.index')->with('error', 'Order placed, but payment generation failed: ' . $e->getMessage());
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to create order: ' . $e->getMessage());
        }
    }

    /**
     * Fallback for local development or delayed webhooks.
     * Verifies payment status with Midtrans when user returns to the site.
     */
    public function finish(Request $request)
    {
        $orderId = $request->get('order_id');
        if (!$orderId) {
            return redirect()->route('orders.index');
        }

        // Initialize Midtrans
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');

        try {
            $status = \Midtrans\Transaction::status($orderId);
            $orders = Order::where('payment_reference', $orderId)->get();

            if ($orders->isNotEmpty()) {
                if ($status['transaction_status'] == 'settlement' || $status['transaction_status'] == 'capture') {
                    $this->processPaymentSuccess($orders, 'Midtrans Verification (Finish Redirect)');
                    return redirect()->route('orders.index')->with('success', 'Pembayaran berhasil dikonfirmasi! Pesanan Anda sedang diproses.');
                }
            }
        } catch (\Exception $e) {
            Log::error('Midtrans Finish Error: ' . $e->getMessage());
        }

        return redirect()->route('orders.index')->with('info', 'Kami sedang memproses pembayaran Anda. Silakan cek status pesanan secara berkala.');
    }

    public function index()
    {
        $orders = auth()->user()->orders()->with(['items.product', 'vendor'])->orderBy('created_at', 'desc')->get();
        return view('orders.index', compact('orders'));
    }
}
