<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index()
    {
        $vendors = Vendor::with('user')->latest()->get();
        return view('admin.vendors.index', compact('vendors'));
    }

    public function edit(Vendor $vendor)
    {
        $users = \App\Models\User::where('role', 'vendor')->get();
        return view('admin.vendors.edit', compact('vendor', 'users'));
    }

    public function update(Request $request, Vendor $vendor)
    {
        $request->validate([
            'shop_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,pending,suspended',
            'user_id' => 'required|exists:users,id',
        ]);

        $vendor->update($request->only('shop_name', 'description', 'status', 'user_id'));

        return redirect()->route('admin.vendors.index')->with('success', 'Vendor updated successfully.');
    }
}
