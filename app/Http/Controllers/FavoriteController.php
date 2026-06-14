<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggle(Product $product, Request $request)
    {
        if (!Auth::check()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Please login first'], 401);
            }
            return redirect()->route('login');
        }

        $favorite = Favorite::where('user_id', Auth::id())
                            ->where('product_id', $product->id)
                            ->first();

        if ($favorite) {
            $favorite->delete();
            $favorited = false;
        } else {
            Favorite::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id
            ]);
            $favorited = true;
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'favorited' => $favorited,
                'message' => $favorited ? 'Added to favorites' : 'Removed from favorites'
            ]);
        }

        return back()->with('success', $favorited ? 'Added to favorites' : 'Removed from favorites');
    }

    public function index()
    {
        $favorites = Favorite::with('product')
                            ->where('user_id', Auth::id())
                            ->get();
        $cartCount = Cart::where('user_id', Auth::id())->count();
        $username = Auth::user()->name;

        return view('favorites', compact('favorites', 'cartCount', 'username'));
    }
}