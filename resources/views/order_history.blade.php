@extends('layouts.app')
@section('title', 'Order History')
@section('content')
<div class="px-4 pt-6 pb-20">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Order History</h1>
    @if(isset($orders) && count($orders) > 0)
        <div class="space-y-4">
            @foreach($orders as $order)
            <div class="bg-white rounded-2xl shadow-sm p-4">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="font-bold text-gray-800">#{{ $order->order_number }}</p>
                        <p class="text-xs text-gray-500">{{ $order->created_at->format('d M Y H:i') }}</p>
                    </div>
                    <span class="px-2 py-1 rounded-full text-xs font-semibold 
                        @if($order->payment_status == 'paid') bg-green-100 text-green-700
                        @elseif($order->payment_status == 'pending') bg-yellow-100 text-yellow-700
                        @else bg-red-100 text-red-700 @endif">
                        {{ ucfirst($order->payment_status) }}
                    </span>
                </div>
                <div class="mt-2 flex justify-between items-center">
                    <span class="text-amber-700 font-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    <a href="{{ route('order.show', $order) }}" class="text-sm text-amber-600">Detail</a>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-12">
            <i class="fas fa-receipt text-6xl text-gray-300 mb-4"></i>
            <p class="text-gray-500">No orders yet</p>
            <a href="{{ route('home') }}" class="inline-block mt-4 bg-amber-600 text-white px-6 py-2 rounded-xl">Start Shopping</a>
        </div>
    @endif
</div>
@php $cartCount = $cartCount ?? 0; @endphp
@endsection