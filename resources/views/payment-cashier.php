@extends('layouts.app')
@section('title', 'Cashier Payment')
@section('content')
<div class="px-4 pt-6 pb-20 text-center">
    <div class="bg-white rounded-2xl shadow-sm p-6">
        <i class="fas fa-barcode text-6xl text-amber-600 mb-4"></i>
        <h2 class="text-xl font-bold">Show Barcode to Cashier</h2>
        <p class="text-gray-500 mt-1">Order: {{ $order->order_number }}</p>
        <p class="text-gray-500">Total: Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
        <div class="bg-white border-2 border-dashed border-amber-300 p-4 rounded-xl my-4">
            {!! $barcode !!}
            <p class="text-sm text-gray-500 mt-2">{{ $order->order_number }}</p>
        </div>
        <p class="text-xs text-gray-400">Scan this barcode at the cashier to complete payment.</p>
        <a href="{{ route('order.history') }}" class="inline-block mt-4 text-amber-600">Back to History</a>
    </div>
</div>
@endsection