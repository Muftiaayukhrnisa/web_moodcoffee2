@extends('layouts.app')
@section('title', 'Checkout')
@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold bg-gradient-to-r from-amber-800 to-amber-600 bg-clip-text text-transparent mb-6">Checkout</h1>

    {{-- Order Summary with gradient border --}}
    <div class="relative bg-white rounded-2xl shadow-lg overflow-hidden mb-8 border border-amber-100">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-amber-800 to-amber-600"></div>
        <div class="p-5">
            <h3 class="text-xl font-semibold text-gray-800 flex items-center gap-2 mb-4">
                <i class="fas fa-receipt text-amber-700"></i> Pesanan Anda
            </h3>
            <div class="space-y-4">
                @foreach($cartItems as $item)
                <div class="border-l-4 border-amber-500 pl-3 py-1 bg-gradient-to-r from-amber-50 to-transparent rounded-r-lg">
                    <div class="flex justify-between items-start flex-wrap gap-2">
                        <div>
                            <div class="font-bold text-gray-800">{{ $item->product->name }}</div>
                            <div class="text-xs text-gray-500">
                                {{ $item->size ?? '280' }}ml · {{ $item->milk ?? 'Classic' }}
                            </div>
                        </div>
                        <div class="text-amber-800 font-semibold">Rp {{ number_format($item->unit_price * $item->quantity, 0, ',', '.') }}</div>
                    </div>
                    <div class="flex justify-between text-sm text-gray-600 mt-1">
                        <span>Jumlah: {{ $item->quantity }}</span>
                        <span>@ {{ number_format($item->unit_price, 0, ',', '.') }}</span>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-5 pt-3 border-t-2 border-dashed border-amber-200 flex justify-between items-center">
                <span class="text-gray-700 font-semibold">Total</span>
                <span class="text-2xl font-bold text-amber-800">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf

        {{-- Tipe Pemesanan --}}
        <div class="bg-white rounded-2xl shadow-lg p-5 mb-8 border border-amber-100">
            <h3 class="text-xl font-semibold text-gray-800 flex items-center gap-2 mb-4">
                <i class="fas fa-store text-amber-700"></i> Tipe Pemesanan
            </h3>
            <div class="flex flex-col sm:flex-row gap-4">
                <label class="flex-1 cursor-pointer group">
                    <input type="radio" name="order_type" value="dine_in" class="hidden peer" required>
                    <div class="border-2 rounded-xl p-4 text-center transition-all duration-200 peer-checked:bg-amber-800 peer-checked:text-white peer-checked:shadow-md bg-white text-gray-700 border-amber-200 hover:shadow">
                        <i class="fas fa-utensils text-2xl mb-2 block peer-checked:text-white text-amber-700 group-hover:scale-105 transition"></i>
                        <span class="font-semibold">DINE IN</span>
                    </div>
                </label>
                <label class="flex-1 cursor-pointer group">
                    <input type="radio" name="order_type" value="take_away" class="hidden peer" required>
                    <div class="border-2 rounded-xl p-4 text-center transition-all duration-200 peer-checked:bg-amber-800 peer-checked:text-white peer-checked:shadow-md bg-white text-gray-700 border-amber-200 hover:shadow">
                        <i class="fas fa-bag-shopping text-2xl mb-2 block peer-checked:text-white text-amber-700 group-hover:scale-105 transition"></i>
                        <span class="font-semibold">TAKE AWAY</span>
                    </div>
                </label>
            </div>
        </div>

        {{-- Metode Pembayaran --}}
        <div class="bg-white rounded-2xl shadow-lg p-5 mb-8 border border-amber-100">
            <h3 class="text-xl font-semibold text-gray-800 flex items-center gap-2 mb-4">
                <i class="fas fa-credit-card text-amber-700"></i> Metode Pembayaran
            </h3>
            <div class="flex flex-col sm:flex-row gap-4">
                <label class="flex-1 cursor-pointer group">
                    <input type="radio" name="payment_method" value="cashier" class="hidden peer" required>
                    <div class="border-2 rounded-xl p-4 text-center transition-all duration-200 peer-checked:bg-amber-800 peer-checked:text-white peer-checked:shadow-md bg-white text-gray-700 border-amber-200 hover:shadow">
                        <i class="fas fa-cash-register text-2xl mb-2 block peer-checked:text-white text-amber-700 group-hover:scale-105 transition"></i>
                        <span class="font-semibold">BAYAR DI KASIR</span>
                    </div>
                </label>
                <label class="flex-1 cursor-pointer group">
                    <input type="radio" name="payment_method" value="qris" class="hidden peer" required>
                    <div class="border-2 rounded-xl p-4 text-center transition-all duration-200 peer-checked:bg-amber-800 peer-checked:text-white peer-checked:shadow-md bg-white text-gray-700 border-amber-200 hover:shadow">
                        <i class="fas fa-qrcode text-2xl mb-2 block peer-checked:text-white text-amber-700 group-hover:scale-105 transition"></i>
                        <span class="font-semibold">QRIS</span>
                    </div>
                </label>
            </div>
        </div>

        {{-- Submit Button with gradient --}}
        <div class="text-center">
            <button type="submit" class="bg-gradient-to-r from-amber-700 to-amber-800 hover:from-amber-800 hover:to-amber-900 text-white font-bold py-3 px-10 rounded-full shadow-lg transition duration-300 transform hover:scale-105">
                <i class="fas fa-check-circle mr-2"></i> Place Order
            </button>
        </div>
    </form>
</div>
@endsection