<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil semua produk yang tersedia
        $products = Product::where('is_available', true)->get();
        
        // Ambil 4 produk untuk rekomendasi
        $recommended = $products->take(4);
        
        // Hitung jumlah item di keranjang (0 jika tidak login)
        $cartCount = Auth::check() ? Cart::where('user_id', Auth::id())->count() : 0;
        
        // Nama user (fallback ke 'User' jika tidak login)
        $username = Auth::check() ? Auth::user()->name : 'User';
        
        return view('home', compact('products', 'recommended', 'cartCount', 'username'));
    }
}