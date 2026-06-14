<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm() { return view('auth.login'); }
    public function login(Request $request) {
        $request->validate(['email' => 'required|email']);
        $user = User::firstOrCreate(
            ['email' => $request->email],
            ['name' => explode('@', $request->email)[0], 'password' => bcrypt('password')]
        );
        Auth::login($user);
        return redirect('/');
    }
    public function showRegisterForm() { return view('auth.register'); }
    public function register(Request $request) {
        $request->validate(['name' => 'required|string', 'email' => 'required|email|unique:users']);
        $user = User::create(['name' => $request->name, 'email' => $request->email, 'password' => bcrypt('password')]);
        Auth::login($user);
        return redirect('/');
    }
    public function logout() { Auth::logout(); return redirect('/'); }
}