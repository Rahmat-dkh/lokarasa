<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = auth()->user()->addresses;
        return view('addresses.index', compact('addresses'));
    }

    public function create()
    {
        return view('addresses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'phone' => 'required|string|min:10|max:20',
            'address_line' => 'required|string|min:10|max:255',
            'city' => 'required|string|min:2|max:100',
            'province' => 'required|string|min:2|max:100',
            'postal_code' => 'required|string|min:5|max:10',
        ]);

        auth()->user()->addresses()->create($request->all());

        // Also sync phone to user if user phone is empty
        if (!auth()->user()->phone) {
            auth()->user()->update(['phone' => $request->phone]);
        }

        if ($request->has('redirect') && $request->redirect === 'checkout') {
            return redirect()->route('checkout')->with('success', 'Alamat berhasil ditambahkan!');
        }

        return redirect()->route('addresses.index')->with('success', 'Address created successfully.');
    }

    public function destroy(Address $address)
    {
        if ($address->user_id != auth()->id()) {
            abort(403);
        }
        $address->delete();
        return redirect()->back()->with('success', 'Alamat berhasil dihapus.');
    }
}
