@extends('layouts.app')
@section('title', 'Profile')
@section('content')
<div class="px-4 pt-6 pb-20">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">My Profile</h1>
    <div class="bg-white rounded-2xl shadow-sm p-5">
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-1">Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border border-gray-300 rounded-xl px-4 py-2">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border border-gray-300 rounded-xl px-4 py-2">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-1">Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full border border-gray-300 rounded-xl px-4 py-2">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-1">Address</label>
                <textarea name="address" rows="3" class="w-full border border-gray-300 rounded-xl px-4 py-2">{{ old('address', $user->address) }}</textarea>
            </div>
            <button type="submit" class="w-full bg-amber-600 text-white py-2 rounded-xl font-bold">Save Changes</button>
        </form>
        <div class="mt-4 pt-4 border-t border-gray-200">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full bg-red-500 text-white py-2 rounded-xl">Logout</button>
            </form>
        </div>
    </div>
</div>
@php $cartCount = $cartCount ?? 0; @endphp
@endsection