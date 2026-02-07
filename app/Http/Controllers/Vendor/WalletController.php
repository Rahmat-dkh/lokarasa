<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Payout;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function index()
    {
        $vendor = auth()->user()->vendor;
        $wallet = $vendor->wallet;
        $transactions = $wallet ? $wallet->transactions()->latest()->get() : collect();
        $payouts = $vendor->payouts()->latest()->get();

        return view('vendor.wallet.index', compact('wallet', 'transactions', 'payouts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:10000',
        ]);

        $vendor = auth()->user()->vendor;
        $wallet = $vendor->wallet;

        if (!$wallet || $wallet->balance < $request->amount) {
            return back()->with('error', 'Insufficient balance.');
        }

        // Payout to Midtrans logic could go here.
        // For now, manual payout request.

        \Illuminate\Support\Facades\DB::transaction(function () use ($vendor, $wallet, $request) {
            // Debit Wallet
            $wallet->decrement('balance', $request->amount);

            // Record Transaction
            WalletTransaction::create([
                'vendor_wallet_id' => $wallet->id,
                'amount' => -$request->amount,
                'type' => 'debit',
                'description' => 'Payout Request',
                'reference_id' => null, // Will be filled after payout creation usually
            ]);

            // Create Payout Record
            Payout::create([
                'vendor_id' => $vendor->id,
                'amount' => $request->amount,
                'status' => 'pending',
            ]);
        });

        return back()->with('success', 'Payout request submitted successfully.');
    }
}
