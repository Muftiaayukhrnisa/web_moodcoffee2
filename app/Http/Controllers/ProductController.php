<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function show($id) {
        $product = Product::findOrFail($id);
        $cartCount = Auth::check() ? Cart::where('user_id', Auth::id())->count() : 0;
        
        // Cek apakah produk sudah difavoritkan oleh user yang login
        $isFavorited = false;
        if (Auth::check()) {
            $isFavorited = Favorite::where('user_id', Auth::id())
                                    ->where('product_id', $product->id)
                                    ->exists();
        }
        
        return view('product-detail', compact('product', 'cartCount', 'isFavorited'));
    }
}