@extends('layouts.app')
@section('title', 'QRIS Payment')
@section('content')
<div class="px-4 pt-6 pb-20 text-center">
    <div class="bg-white rounded-2xl shadow-sm p-6">
        <i class="fas fa-qrcode text-6xl text-amber-600 mb-4"></i>
        <h2 class="text-xl font-bold">Scan QRIS to Pay</h2>
        <p class="text-gray-500 mt-1">Order: {{ $order->order_number }}</p>
        <p class="text-gray-500">Amount: Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
        <div class="bg-gray-100 p-4 rounded-xl my-4">
            <p class="text-sm text-gray-600">Demo QR Code - In real app, generate QR code here.</p>
        </div>
        <form action="{{ route('payment.qris', $order) }}" method="POST">
            @csrf
            <button type="submit" class="w-full bg-amber-600 text-white py-3 rounded-xl font-bold">Simulate Payment Success</button>
        </form>
    </div>
</div>
@endsection