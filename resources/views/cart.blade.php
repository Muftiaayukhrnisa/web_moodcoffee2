@extends('layouts.app')
@section('title', 'Cart')
@section('content')
<div class="max-w-4xl mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">My Cart</h1>
    @if(isset($cartItems) && count($cartItems) > 0)
        <div class="flex flex-col gap-4">
            @foreach($cartItems as $item)
            <div class="bg-white rounded-2xl shadow-sm p-4 flex flex-col sm:flex-row gap-4 border border-gray-200 transition hover:shadow-md">
                {{-- Gambar produk --}}
                <div class="w-24 h-24 rounded-xl overflow-hidden bg-amber-50 flex-shrink-0">
                    <img src="{{ $item->product->image_url ?? 'https://placehold.co/400x400?text=No+Image' }}" 
                         alt="{{ $item->product->name }}" 
                         class="w-full h-full object-cover">
                </div>
                <div class="flex-1">
                    <h3 class="font-bold text-gray-800">
                        {{ $item->product->name }} 
                        ({{ $item->size ?? '280' }}ml, {{ $item->milk ?? 'Classic' }})
                    </h3>
                    <p class="text-amber-700 font-semibold">Rp {{ number_format($item->unit_price, 0, ',', '.') }}</p>
                    <p class="text-sm text-gray-500">{{ $item->milk ?? 'Classic' }}</p>
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mt-2">
                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center gap-2">
                            @csrf
                            @method('PATCH')
                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="w-20 border border-gray-300 rounded-lg px-2 py-1 text-center">
                            <button type="submit" class="text-blue-600 text-sm">Update</button>
                        </form>
                        <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 text-sm"><i class="fas fa-trash-alt"></i> Remove</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-6 bg-white rounded-2xl p-4 shadow-sm border border-gray-200 max-w-md mx-auto sm:mx-0">
            <div class="flex justify-between items-center mb-4">
                <span class="text-gray-600">Total Payment</span>
                <span class="text-xl font-bold text-amber-700">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
            <a href="{{ route('checkout.form') }}" class="block w-full bg-amber-600 text-white text-center py-3 rounded-xl hover:bg-amber-700 transition">
                Payment
            </a>
        </div>
    @else
        <div class="text-center py-12 bg-white rounded-2xl shadow-sm border border-gray-200">
            <i class="fas fa-shopping-bag text-6xl text-gray-300 mb-4"></i>
            <p class="text-gray-500">Your cart is empty</p>
            <a href="{{ route('home') }}" class="inline-block mt-4 bg-amber-600 text-white px-6 py-2 rounded-xl">Shop Now</a>
        </div>
    @endif
</div>
@endsection