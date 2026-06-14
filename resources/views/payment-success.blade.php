@extends('layouts.app')
@section('title', 'Payment Success')
@section('content')
<div class="min-h-screen w-full bg-gradient-to-br from-amber-50 to-amber-100 flex items-center justify-center px-4 py-8">
    <div class="max-w-md w-full bg-white rounded-2xl shadow-2xl overflow-hidden transform transition-all duration-300 hover:scale-105">
        <!-- Dark brown header gradient -->
        <div class="bg-gradient-to-r from-amber-800 to-amber-700 px-6 py-10 text-center">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-white rounded-full shadow-lg mb-4">
                <i class="fas fa-check-circle text-6xl text-amber-700"></i>
            </div>
            <h2 class="text-3xl font-bold text-white">Payment Successful!</h2>
            <p class="text-amber-100 mt-2">Thank you for your order.</p>
        </div>

        <!-- Card body -->
        <div class="p-6 text-center">
            <div class="bg-amber-50 rounded-lg p-4 mb-6">
                <p class="text-gray-500 text-sm uppercase tracking-wide">Order Number</p>
                <p class="text-2xl font-mono font-bold text-amber-800">{{ $order->order_number }}</p>
            </div>

            <div class="space-y-3">
                <a href="{{ route('order.history') }}" 
                   class="block w-full bg-amber-800 hover:bg-amber-900 text-white font-semibold py-3 rounded-xl transition shadow-md flex items-center justify-center gap-2">
                    <i class="fas fa-receipt"></i> View Order History
                </a>
                <a href="{{ route('home') }}" 
                   class="block w-full border-2 border-amber-800 text-amber-800 hover:bg-amber-50 font-semibold py-3 rounded-xl transition flex items-center justify-center gap-2">
                    <i class="fas fa-home"></i> Back to Home
                </a>
            </div>

            <p class="text-xs text-gray-400 mt-6">A confirmation email has been sent to your registered email address.</p>
        </div>
    </div>
</div>
@endsection