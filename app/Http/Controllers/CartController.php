<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Menampilkan halaman keranjang belanja.
     */
    public function index()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        // Hitung total berdasarkan unit_price * quantity
        $total = $cartItems->sum(function ($item) {
            return $item->unit_price * $item->quantity;
        });

        $cartCount = $cartItems->count();

        return view('cart', compact('cartItems', 'total', 'cartCount'));
    }

    /**
     * Menambahkan produk ke keranjang (via AJAX atau form biasa).
     * Menyimpan size, milk, dan unit_price.
     */
    public function add(Product $product, Request $request)
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Silakan login terlebih dahulu.'
                ], 401);
            }
            return redirect()->route('login');
        }

        // Ambil data pilihan dari request (dari product-detail)
        $size = $request->input('size', '280');
        $milk = $request->input('milk', 'Classic');
        $unitPrice = $request->input('final_price', $product->price);

        // Cari item yang sama (produk, size, milk) di keranjang user
        $cart = Cart::where('user_id', Auth::id())
                    ->where('product_id', $product->id)
                    ->where('size', $size)
                    ->where('milk', $milk)
                    ->first();

        if ($cart) {
            // Jika sudah ada, tambah quantity
            $cart->increment('quantity');
        } else {
            // Buat item baru dengan size, milk, unit_price
            Cart::create([
                'user_id'    => Auth::id(),
                'product_id' => $product->id,
                'quantity'   => 1,
                'size'       => $size,
                'milk'       => $milk,
                'unit_price' => $unitPrice,
            ]);
        }

        // Hitung ulang total item di keranjang
        $cartCount = Cart::where('user_id', Auth::id())->count();

        // Jika request dari AJAX, kembalikan JSON
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success'    => true,
                'message'    => 'Produk berhasil ditambahkan ke keranjang',
                'cart_count' => $cartCount,
            ]);
        }

        // Jika bukan AJAX, redirect kembali dengan pesan sukses
        return back()->with('success', 'Produk ditambahkan ke keranjang');
    }

    /**
     * Mengupdate jumlah item di keranjang.
     */
    public function update(Cart $cart, Request $request)
    {
        // Pastikan cart milik user yang login
        if ($cart->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart->update(['quantity' => $request->quantity]);

        return back()->with('success', 'Keranjang berhasil diperbarui');
    }

    /**
     * Menghapus item dari keranjang.
     */
    public function destroy(Cart $cart)
    {
        if ($cart->user_id !== Auth::id()) {
            abort(403);
        }

        $cart->delete();

        return back()->with('success', 'Item dihapus dari keranjang');
    }
}