<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vendor;
use App\Models\VendorWallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('vendor.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'shop_name' => ['required', 'string', 'max:255'],
            'shop_slug' => ['required', 'string', 'max:255', 'unique:vendors,slug'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => User::ROLE_SELLER,
        ]);

        $vendor = Vendor::create([
            'user_id' => $user->id,
            'shop_name' => $request->shop_name,
            'slug' => $request->shop_slug,
            'status' => 'pending', // Waiting for admin approval
        ]);

        // Create Wallet
        VendorWallet::create([
            'vendor_id' => $vendor->id,
            'balance' => 0,
        ]);

        Auth::login($user);

        return redirect()->route('vendor.dashboard');
    }
}
