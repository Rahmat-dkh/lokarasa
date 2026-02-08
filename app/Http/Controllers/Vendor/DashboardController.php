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

        $recentOrders = $vendor->orders()->with(['user', 'items.product'])->latest()->take(5)->get();

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
        ]);

        $vendor->update($request->only('shop_name', 'description', 'flat_shipping_cost', 'bank_name', 'bank_account_number', 'bank_account_name'));

        return back()->with('success', 'Shop settings updated successfully.');
    }
}
