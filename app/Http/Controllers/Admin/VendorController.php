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

    public function update(Request $request, Vendor $vendor)
    {
        $request->validate([
            'status' => 'required|in:active,pending,suspended',
        ]);

        $vendor->update(['status' => $request->status]);

        return back()->with('success', 'Vendor status updated successfully.');
    }
}
