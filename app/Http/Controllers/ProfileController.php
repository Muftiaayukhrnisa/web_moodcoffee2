<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class ProfileController extends Controller
{
    public function edit() {
        $user = Auth::user();
        $cartCount = Cart::where('user_id', Auth::id())->count();
        return view('profile', compact('user', 'cartCount'));
    }
    public function update(Request $request) {
        $request->validate(['name' => 'required|string', 'email' => 'required|email|unique:users,email,'.Auth::id(), 'phone' => 'nullable|string', 'address' => 'nullable|string']);
        Auth::user()->update($request->only('name', 'email', 'phone', 'address'));
        return back()->with('success', 'Profile updated');
    }
}