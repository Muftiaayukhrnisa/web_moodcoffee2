<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Picqer\Barcode\BarcodeGeneratorHTML;

class PaymentController extends Controller
{
    /**
     * Tampilkan halaman pembayaran QRIS.
     */
    public function showQris(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }
        return view('payment-qris', compact('order'));
    }

    /**
     * Tampilkan halaman pembayaran di kasir (barcode).
     */
    public function showCashier(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }
        $generator = new BarcodeGeneratorHTML();
        $barcode = $generator->getBarcode($order->order_number, $generator::TYPE_CODE_128);
        return view('payment-cashier', compact('order', 'barcode'));
    }

    /**
     * Proses konfirmasi pembayaran sukses (simulasi).
     */
    public function success(Order $order, Request $request)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }
        $order->update([
            'payment_status' => 'paid',
            'order_status' => 'processing'
        ]);
        return view('payment-success', compact('order'));
    }
}