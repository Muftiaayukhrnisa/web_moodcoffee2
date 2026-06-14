@extends('layouts.app')
@section('title', 'Order Detail')
@section('content')
<div class="px-4 pt-6 pb-20">
    <div class="bg-white rounded-2xl shadow-sm p-4 mb-4">
        <h1 class="text-xl font-bold">Order #{{ $order->order_number }}</h1>
        <p class="text-gray-500 text-sm">{{ $order->created_at->format('d M Y H:i') }}</p>
        <div class="mt-2 grid grid-cols-2 gap-2 text-sm">
            <div><span class="font-semibold">Type:</span> {{ ucfirst(str_replace('_', ' ', $order->order_type)) }}</div>
            <div><span class="font-semibold">Payment:</span> {{ ucfirst($order->payment_method) }}</div>
            <div><span class="font-semibold">Status:</span> 
                <span class="text-amber-600">{{ ucfirst($order->payment_status) }}</span>
            </div>
            <div><span class="font-semibold">Order Status:</span> {{ ucfirst($order->order_status) }}</div>
        </div>
    </div>
    <div class="bg-white rounded-2xl shadow-sm p-4">
        <h3 class="font-semibold text-gray-700 mb-2">Items</h3>
        @foreach($order->items as $item)
        <div class="flex justify-between text-sm py-2 border-b border-gray-100">
            <span>{{ $item->product->name }} x{{ $item->quantity }}</span>
            <span>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
        </div>
        @endforeach
        <div class="flex justify-between font-bold mt-2 pt-2 border-t border-gray-200">
            <span>Total</span>
            <span>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
        </div>
    </div>
    @if($order->payment_method == 'cashier' && $order->payment_status == 'pending')
        <div class="mt-4">
            <a href="{{ route('order.barcode', $order) }}" class="block w-full bg-blue-600 text-white text-center py-2 rounded-xl">Show Barcode</a>
        </div>
    @endif
</div>
@endsection