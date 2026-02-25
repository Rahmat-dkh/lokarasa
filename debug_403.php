<?php
use App\Models\User;
use App\Models\Order;
use App\Models\Vendor;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "--- Debugging Order #24 and Admin ---\n";

$order = Order::find(24);
if ($order) {
    echo "Order #24:\n";
    echo "  - ID: " . $order->id . "\n";
    echo "  - Vendor ID (DB): " . ($order->vendor_id ?? 'NULL') . " (Type: " . gettype($order->vendor_id) . ")\n";
    echo "  - Status: " . $order->status . "\n";
} else {
    echo "Order #24 NOT found.\n";
}

$admins = User::where('role', 'admin')->get();
foreach ($admins as $admin) {
    echo "Admin User (ID: " . $admin->id . "):\n";
    echo "  - Name: " . $admin->name . "\n";
    if ($admin->vendor) {
        echo "  - Vendor ID: " . $admin->vendor->id . " (Type: " . gettype($admin->vendor->id) . ")\n";
        echo "  - Shop Name: " . $admin->vendor->shop_name . "\n";
    } else {
        echo "  - NO VENDOR PROFILE\n";
    }
}

echo "--- Check comparison logic ---\n";
if ($order && count($admins) > 0) {
    $admin = $admins->first();
    if ($admin->vendor) {
        $oid = $order->vendor_id;
        $vid = $admin->vendor->id;
        echo "Strict comparison (PHP): " . ($oid === $vid ? 'MATCH' : 'NO MATCH') . "\n";
        echo "Loose comparison (PHP): " . ($oid == $vid ? 'MATCH' : 'NO MATCH') . "\n";
    }
}
