<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;

class OrderFixTestSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('role', 'customer')->first();
        $vendor = Vendor::first();
        $product = Product::where('vendor_id', $vendor->id)->first();

        if ($user && $vendor && $product) {
            $paymentRef = 'ORD-FIX-TEST-' . strtoupper(\Illuminate\Support\Str::random(5));

            $order = Order::create([
                'user_id' => $user->id,
                'vendor_id' => $vendor->id,
                'payment_reference' => $paymentRef,
                'total_amount' => $product->price + 2000 + 10000,
                'status' => 'pending',
                'shipping_address' => 'Jl. Test No. 123, Bandung',
                'service_fee' => 2000,
                'shipping_cost' => 10000,
            ]);

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'vendor_id' => $vendor->id,
                'quantity' => 1,
                'price' => $product->price,
            ]);
        }
    }
}
