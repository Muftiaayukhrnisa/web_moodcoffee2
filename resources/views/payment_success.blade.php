@extends('layouts.app')
@section('title', 'Payment Success')
@section('content')
<div class="px-4 pt-6 pb-20 text-center">
    <div class="bg-white rounded-2xl shadow-sm p-6">
        <i class="fas fa-check-circle text-6xl text-green-500 mb-4"></i>
        <h2 class="text-2xl font-bold text-green-600">Payment Successful!</h2>
        <p class="text-gray-600 mt-2">Thank you for your order.</p>
        <p class="text-gray-500">Order #{{ $order->order_number }}</p>
        <div class="mt-6 space-y-3">
            <a href="{{ route('order.history') }}" class="block w-full bg-amber-600 text-white py-2 rounded-xl">View Order History</a>
            <a href="{{ route('home') }}" class="block w-full border border-amber-600 text-amber-600 py-2 rounded-xl">Back to Home</a>
        </div>
    </div>
</div>
@endsection