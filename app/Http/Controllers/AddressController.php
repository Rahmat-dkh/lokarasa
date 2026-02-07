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
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address_line' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
        ]);

        auth()->user()->addresses()->create($request->all());

        if ($request->has('redirect') && $request->redirect === 'checkout') {
            return redirect()->route('checkout')->with('success', 'Alamat berhasil ditambahkan!');
        }

        return redirect()->route('addresses.index')->with('success', 'Address created successfully.');
    }

    public function destroy(Address $address)
    {
        if ($address->user_id !== auth()->id()) {
            abort(403);
        }
        $address->delete();
        return redirect()->route('addresses.index')->with('success', 'Address deleted.');
    }
}
