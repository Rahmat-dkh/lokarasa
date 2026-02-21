<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $vendor = auth()->user()->vendor;
        $ordersCount = $vendor->orders()->count();
        $productsCount = $vendor->products()->count();
        $balance = $vendor->wallet ? $vendor->wallet->balance : 0;

        $recentOrders = $vendor->orders()->with(['user', 'items.product'])->latest()->take(3)->get();

        return view('vendor.dashboard', compact('vendor', 'ordersCount', 'productsCount', 'balance', 'recentOrders'));
    }
    public function update(Request $request)
    {
        $vendor = auth()->user()->vendor;

        $request->validate([
            'shop_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'flat_shipping_cost' => 'required|numeric|min:0',
            'bank_name' => 'nullable|string|max:255',
            'bank_account_number' => 'nullable|string|max:255',
            'bank_account_name' => 'nullable|string|max:255',
            'address' => 'required|string',
            'postal_code' => 'required|string|max:10',
            'phone' => 'required|string|max:20',
            'available_couriers' => 'nullable|array',
        ]);

        $data = $request->only('shop_name', 'description', 'flat_shipping_cost', 'bank_name', 'bank_account_number', 'bank_account_name', 'address', 'postal_code', 'phone');
        $data['available_couriers'] = $request->input('available_couriers');

        $vendor->update($data);

        return back()->with('success', 'Shop settings updated successfully.');
    }
}
