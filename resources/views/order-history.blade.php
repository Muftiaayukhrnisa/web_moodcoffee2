@extends('layouts.app')
@section('title', 'Order History')
@section('content')
<div class="w-full px-4 sm:px-6 lg:px-8 py-6 bg-amber-50 min-h-screen">
    {{-- Header Total Pengeluaran (full width card) --}}
    <div class="w-full max-w-7xl mx-auto mb-8">
        <div class="bg-gradient-to-r from-amber-800 to-amber-700 rounded-2xl p-6 shadow-lg">
            <div class="text-center">
                <p class="text-amber-100 text-sm uppercase tracking-wider">Total Pengeluaran</p>
                <p class="text-white text-4xl font-bold mt-1">Rp {{ number_format($totalSpending, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    {{-- Daftar Pesanan --}}
    <div class="w-full max-w-7xl mx-auto space-y-6">
        @forelse($orders as $order)
        @php
            // Konversi ke waktu lokal (Asia/Jakarta)
            $localDate = $order->created_at->setTimezone('Asia/Jakarta');
        @endphp
        <div class="bg-white rounded-2xl shadow-md border border-amber-100 overflow-hidden transition hover:shadow-lg">
            {{-- Header Order: tanggal, jam, metode, tipe --}}
            <div class="bg-amber-50 px-5 py-3 border-b border-amber-100 flex flex-wrap justify-between items-center gap-3">
                <div class="flex items-center gap-2 text-sm text-gray-600">
                    <i class="far fa-calendar-alt text-amber-700"></i>
                    <span>{{ $localDate->translatedFormat('d M Y') }}</span>
                    <span class="text-gray-400">|</span>
                    <i class="far fa-clock text-amber-700"></i>
                    <span>{{ $localDate->format('H:i') }}</span>
                </div>
                <div class="flex gap-2">
                    <span class="inline-flex items-center gap-1 text-xs bg-amber-100 text-amber-800 px-2 py-1 rounded-full">
                        <i class="fas fa-credit-card"></i> {{ ucfirst($order->payment_method) }}
                    </span>
                    <span class="inline-flex items-center gap-1 text-xs bg-amber-100 text-amber-800 px-2 py-1 rounded-full">
                        <i class="fas fa-store"></i> {{ str_replace('_', ' ', ucfirst($order->order_type)) }}
                    </span>
                </div>
            </div>

            {{-- Daftar item --}}
            <div class="p-5 space-y-4">
                @foreach($order->items as $item)
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start border-b border-gray-100 pb-3 last:border-0 last:pb-0">
                    <div class="flex-1">
                        <div class="font-semibold text-gray-800">
                            {{ $item->product->name }}
                            <span class="text-sm text-gray-500">({{ $item->size ?? '280' }}ml, {{ $item->milk ?? 'Classic' }})</span>
                        </div>
                        <div class="text-xs text-gray-500 mt-1">
                            {{ $item->size ?? '280' }}ml • {{ $item->milk ?? 'Classic' }} • {{ $item->quantity }}x
                        </div>
                    </div>
                    <div class="text-right mt-2 sm:mt-0">
                        <div class="font-semibold text-amber-800">Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                        <div class="text-xs text-gray-400">@ Rp {{ number_format($item->price / $item->quantity, 0, ',', '.') }}</div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Total pesanan --}}
            <div class="bg-gray-50 px-5 py-3 border-t border-amber-100 flex justify-between items-center">
                <span class="text-gray-700 font-medium">Total Pesanan</span>
                <span class="text-amber-800 font-bold text-xl">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-2xl shadow p-12 text-center">
            <i class="fas fa-receipt text-6xl text-gray-300 mb-4"></i>
            <p class="text-gray-500 text-lg">Belum ada pesanan</p>
            <a href="{{ route('home') }}" class="inline-block mt-6 bg-amber-800 hover:bg-amber-900 text-white font-semibold px-8 py-3 rounded-full transition">
                Mulai Belanja
            </a>
        </div>
        @endforelse
    </div>
</div>
@endsection