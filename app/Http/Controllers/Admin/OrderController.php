<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    use \App\Traits\HandlesPaymentSuccess;

    public function index()
    {
        $orders = Order::with(['user', 'vendor'])->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'vendor', 'items.product']);
        return view('admin.orders.show', compact('order'));
    }

    public function confirmPayment(Order $order)
    {
        $alreadyCredited = WalletTransaction::where('reference_id', $order->id)
            ->where('type', 'credit')
            ->exists();

        if ($alreadyCredited) {
            return back()->with('error', 'Pesanan ini sudah dikonfirmasi dan saldo sudah masuk ke vendor.');
        }

        if ($order->status === 'cancelled') {
            return back()->with('error', 'Pesanan yang dibatalkan tidak dapat dikonfirmasi pembayarannya.');
        }

        DB::beginTransaction();
        try {
            $relatedOrders = Order::where('payment_reference', $order->payment_reference)->get();
            $this->processPaymentSuccess($relatedOrders, 'Manual Payment Confirmation');

            DB::commit();
            return back()->with('success', 'Pembayaran berhasil dikonfirmasi secara manual. Saldo vendor telah diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal konfirmasi pembayaran: ' . $e->getMessage());
        }
    }
}
