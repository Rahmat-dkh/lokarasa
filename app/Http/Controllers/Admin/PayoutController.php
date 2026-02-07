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

        $payout->update(['status' => $request->status]);

        // Logic to refund wallet if rejected could go here
        if ($request->status === 'rejected') {
            // Credit back logic (optional for MVP)
            // $payout->vendor->wallet->increment('balance', $payout->amount);
        }

        return back()->with('success', 'Payout status updated successfully.');
    }
}
