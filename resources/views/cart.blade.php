@extends('layouts.app')
@section('title', 'Cart')
@section('content')
<div class="min-h-screen bg-amber-50 py-8">
    <div class="w-full px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">My Cart</h1>
        @if(isset($cartItems) && count($cartItems) > 0)
            <div class="flex flex-col gap-5">
                @foreach($cartItems as $item)
                <div class="bg-white rounded-2xl shadow-md p-5 flex flex-col sm:flex-row gap-5 border border-gray-200 transition hover:shadow-lg">
                    {{-- Gambar produk --}}
                    <div class="w-28 h-28 rounded-xl overflow-hidden bg-amber-50 flex-shrink-0">
                        <img src="{{ $item->product->image_url ?? 'https://placehold.co/400x400?text=No+Image' }}" 
                             alt="{{ $item->product->name }}" 
                             class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1">
                        <h3 class="font-bold text-gray-800 text-lg">
                            {{ $item->product->name }} 
                            ({{ $item->size ?? '280' }}ml, {{ $item->milk ?? 'Classic' }})
                        </h3>
                        <p class="text-amber-700 font-semibold text-xl mt-1">Rp {{ number_format($item->unit_price, 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-500">{{ $item->milk ?? 'Classic' }}</p>
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mt-3">
                            <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center gap-3">
                                @csrf
                                @method('PATCH')
                                <label class="text-gray-600 text-sm">Jumlah:</label>
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="w-20 border border-gray-300 rounded-lg px-2 py-1 text-center">
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-1 rounded-lg transition">Update</button>
                            </form>
                            <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 text-sm flex items-center gap-1 transition">
                                    <i class="fas fa-trash-alt"></i> Remove
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-8 bg-white rounded-2xl p-6 shadow-md border border-gray-200 max-w-md sm:max-w-full">
                <div class="flex justify-between items-center mb-5">
                    <span class="text-gray-700 text-lg font-semibold">Total Payment</span>
                    <span class="text-2xl font-bold text-amber-700">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                <a href="{{ route('checkout.form') }}" class="block w-full bg-amber-700 hover:bg-amber-800 text-white text-center py-3 rounded-xl transition font-semibold text-lg">
                    Proceed to Payment
                </a>
            </div>
        @else
            <div class="text-center py-16 bg-white rounded-2xl shadow-md border border-gray-200">
                <i class="fas fa-shopping-bag text-7xl text-gray-300 mb-4"></i>
                <p class="text-gray-500 text-lg">Your cart is empty</p>
                <a href="{{ route('home') }}" class="inline-block mt-5 bg-amber-700 hover:bg-amber-800 text-white px-8 py-3 rounded-xl transition font-semibold">
                    Shop Now
                </a>
            </div>
        @endif
    </div>
</div>
@endsection