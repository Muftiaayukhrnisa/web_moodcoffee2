@extends('layouts.app')
@section('title', 'Register')
@section('content')
<div class="flex items-center justify-center min-h-screen px-4 py-8">
    <div class="bg-white rounded-2xl shadow-lg p-6 w-full">
        <h1 class="text-2xl font-bold text-center text-amber-800">MoodCoffee</h1>
        <p class="text-center text-gray-500 mb-6">Daftar akun baru</p>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-3">
                <label class="block text-gray-700 text-sm font-medium mb-1">Nama</label>
                <input type="text" name="name" class="w-full border border-gray-300 rounded-xl px-4 py-2" required>
            </div>
            <div class="mb-3">
                <label class="block text-gray-700 text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" class="w-full border border-gray-300 rounded-xl px-4 py-2" required>
            </div>
            <div class="mb-3">
                <label class="block text-gray-700 text-sm font-medium mb-1">Password</label>
                <input type="password" name="password" class="w-full border border-gray-300 rounded-xl px-4 py-2" placeholder="Minimal 8 karakter">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-1">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="w-full border border-gray-300 rounded-xl px-4 py-2">
            </div>
            <button type="submit" class="w-full bg-amber-600 text-white py-2 rounded-xl hover:bg-amber-700 transition">Register</button>
        </form>
        <p class="text-center text-sm text-gray-500 mt-4">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-amber-600">Login</a>
        </p>
    </div>
</div>
@endsection