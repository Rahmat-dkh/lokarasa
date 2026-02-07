<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function show($slug)
    {
        $vendor = Vendor::where('slug', $slug)->firstOrFail();
        $products = $vendor->products()->latest()->paginate(12);

        return view('shop.show', compact('vendor', 'products'));
    }
}
