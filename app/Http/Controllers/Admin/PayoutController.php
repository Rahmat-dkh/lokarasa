<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payout;
use Illuminate\Http\Request;

class PayoutController extends Controller
{
    public function index()
    {
        $payouts = Payout::with('vendor.user')->latest()->get();
        return view('admin.payouts.index', compact('payouts'));
    }

    public function update(Request $request, Payout $payout)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,rejected',
        ]);

        if ($payout->status !== 'pending') {
            return back()->with('error', 'Payout status already finalized.');
        }

        $payout->update(['status' => $request->status]);

        if ($request->status === 'rejected') {
            // Credit back to vendor wallet
            $wallet = $payout->vendor->wallet;
            if ($wallet) {
                $wallet->increment('balance', $payout->amount);

                \App\Models\WalletTransaction::create([
                    'vendor_wallet_id' => $wallet->id,
                    'amount' => $payout->amount,
                    'type' => 'credit',
                    'description' => 'Refund for rejected payout #' . $payout->id,
                    'reference_id' => $payout->id,
                ]);
            }
        }

        return back()->with('success', 'Payout status updated to ' . $request->status);
    }
}
