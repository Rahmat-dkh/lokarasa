<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $vendor = auth()->user()->vendor;
        $orders = $vendor->orders()->with(['items.product', 'user'])->latest()->paginate(10);
        return view('vendor.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $user = auth()->user();
        $vendor = $user->vendor;

        if (!$vendor) {
            abort(403, 'Anda tidak memiliki profil Vendor.');
        }

        // Simpler check: If user owns the vendor ID of the order
        // Or if user is admin, allow viewing official store orders (and legacy nulls)
        $isOwner = (int) $order->vendor_id === (int) $vendor->id;
        $isAdminAuthorized = $user->isAdmin() && ($order->vendor_id === null || $order->vendor_id == $vendor->id);

        if (!$isOwner && !$isAdminAuthorized) {
            // For debugging if it still fails
            abort(403, "Otorisasi Gagal: Order Vendor ID #{$order->vendor_id} vs Profil Anda #{$vendor->id}");
        }

        $order->load(['items.product', 'user']);
        return view('vendor.orders.show', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $user = auth()->user();
        $vendor = $user->vendor;

        if (!$vendor) {
            abort(403, 'Anda tidak memiliki profil Vendor.');
        }

        $isOwner = (int) $order->vendor_id === (int) $vendor->id;
        $isAdminAuthorized = $user->isAdmin() && ($order->vendor_id === null || $order->vendor_id == $vendor->id);

        if (!$isOwner && !$isAdminAuthorized) {
            abort(403, "Update Gagal: Otorisasi tidak valid.");
        }

        $request->validate([
            'status' => 'required|in:processing,shipped,delivered,cancelled',
            'shipping_courier' => 'nullable|string',
            'shipping_service' => 'nullable|string',
            // resi ?
        ]);

        $order->update([
            'status' => $request->status,
        ]);

        if ($request->filled('shipping_courier')) {
            $order->update([
                'shipping_courier' => $request->shipping_courier,
                'shipping_service' => $request->shipping_service
            ]);
        }

        // Logic for wallet credit if delivered? 
        // Typically happens after X days or user confirmation. 
        // For MVP, maybe auto-credit on 'delivered'?
        // The implementation plan says: "When Order is completed... Credit Vendor Wallet".

        if ($request->status === 'delivered') {
            $balance = $order->total_amount - $order->service_fee; // Logic needed here
            // We need a Service class or logic. 
            // For now, let's keep it simple status update.
        }

        return redirect()->route('vendor.orders.show', $order)->with('success', 'Order status updated.');
    }
}
