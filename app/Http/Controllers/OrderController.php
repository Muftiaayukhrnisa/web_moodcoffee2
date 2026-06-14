<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Picqer\Barcode\BarcodeGeneratorHTML;

class OrderController extends Controller
{
    /**
     * Menampilkan halaman checkout dari keranjang.
     */
    public function checkoutForm()
    {
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->withErrors('Keranjang kosong');
        }
        $total = $cartItems->sum(fn($item) => $item->unit_price * $item->quantity);
        return view('checkout', compact('cartItems', 'total'));
    }

    /**
     * Checkout langsung (Order Now) tanpa melalui keranjang.
     * Menyimpan item ke session untuk diproses saat submit.
     */
    public function directCheckout(Product $product)
    {
        // Simpan data produk ke session untuk sementara
        $directItem = [
            'product_id' => $product->id,
            'quantity'   => 1,
            'size'       => '280',        // default size
            'milk'       => 'Classic',    // default milk
            'unit_price' => $product->price,
        ];
        session()->put('direct_checkout_items', [$directItem]);

        // Buat koleksi item untuk ditampilkan di view checkout
        $cartItems = collect([
            (object) array_merge($directItem, ['product' => $product])
        ]);
        $total = $product->price;

        return view('checkout', compact('cartItems', 'total'));
    }

    /**
     * Menyimpan pesanan (baik dari keranjang atau direct checkout).
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_type'     => 'required|in:dine_in,take_away',
            'payment_method' => 'required|in:qris,cashier'
        ]);

        // Cek apakah ini direct checkout (ada session)
        $directItems = session()->pull('direct_checkout_items', null);
        
        if ($directItems) {
            // Direct checkout: buat koleksi item dari session
            $cartItems = collect($directItems)->map(function ($item) {
                return (object) $item;
            });
            $total = collect($directItems)->sum(fn($item) => $item['unit_price'] * $item['quantity']);
        } else {
            // Dari keranjang biasa
            $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
            if ($cartItems->isEmpty()) {
                return back()->withErrors('Keranjang kosong');
            }
            $total = $cartItems->sum(fn($item) => $item->unit_price * $item->quantity);
        }

        // Simpan order
        $order = Order::create([
            'user_id'              => Auth::id(),
            'order_number'         => 'ORD-' . Str::random(6) . time(),
            'order_type'           => $request->order_type,
            'payment_method'       => $request->payment_method,
            'payment_status'       => 'pending',
            'total_amount'         => $total,
            'qrcode_payment_token' => $request->payment_method == 'qris' ? Str::random(32) : null,
        ]);

        // Simpan order items
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item->product_id,
                'quantity'   => $item->quantity,
                'price'      => $item->unit_price,
                'size'       => $item->size ?? null,
                'milk'       => $item->milk ?? null,
            ]);
        }

        // Hapus keranjang jika berasal dari keranjang biasa
        if (!$directItems) {
            Cart::where('user_id', Auth::id())->delete();
        }

        // Redirect sesuai metode pembayaran
        if ($order->payment_method == 'qris') {
            return redirect()->route('payment.qris', $order);
        } else {
            return redirect()->route('payment.cashier', $order);
        }
    }

    /**
     * Riwayat pesanan user.
     */
    public function history()
    {
        $orders = Order::where('user_id', Auth::id())
                       ->orderBy('created_at', 'desc')
                       ->get();
        $cartCount = Cart::where('user_id', Auth::id())->count();
        return view('order-history', compact('orders', 'cartCount'));
    }

    /**
     * Detail pesanan.
     */
    public function show(Order $order)
    {
        if ($order->user_id != Auth::id()) abort(403);
        $order->load('items.product');
        return view('order-detail', compact('order'));
    }

    /**
     * Tampilkan barcode untuk pembayaran di kasir.
     */
    public function showBarcode(Order $order)
    {
        if ($order->user_id != Auth::id()) abort(403);
        if ($order->payment_method != 'cashier') {
            return redirect()->route('order.history')->withErrors('Barcode hanya untuk pembayaran di kasir');
        }
        $generator = new BarcodeGeneratorHTML();
        $barcode = $generator->getBarcode($order->order_number, $generator::TYPE_CODE_128);
        return view('payment-cashier', compact('order', 'barcode'));
    }
}