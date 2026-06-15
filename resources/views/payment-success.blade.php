@extends('layouts.app')
@section('title', 'Payment Success')
@section('content')
<div class="min-h-screen w-full bg-gradient-to-br from-amber-50 to-amber-100 flex items-center justify-center px-4 py-8">
    <div class="w-full max-w-4xl lg:max-w-2xl xl:max-w-3xl bg-white rounded-2xl shadow-2xl overflow-hidden transform transition-all duration-300 hover:scale-105">
        <!-- Dark brown header gradient -->
        <div class="bg-gradient-to-r from-amber-800 to-amber-700 px-6 py-12 text-center">
            <div class="inline-flex items-center justify-center w-28 h-28 bg-white rounded-full shadow-lg mb-4">
                <i class="fas fa-check-circle text-7xl text-amber-700"></i>
            </div>
            <h2 class="text-4xl font-bold text-white">Payment Successful!</h2>
            <p class="text-amber-100 mt-2 text-lg">Thank you for your order.</p>
        </div>

        <!-- Card body -->
        <div class="p-8 text-center">
            <div class="bg-amber-50 rounded-lg p-5 mb-6">
                <p class="text-gray-500 text-sm uppercase tracking-wide">Order Number</p>
                <p class="text-3xl font-mono font-bold text-amber-800">{{ $order->order_number }}</p>
            </div>

            <div class="space-y-4">
                <a href="{{ route('order.history') }}" 
                   class="block w-full bg-amber-800 hover:bg-amber-900 text-white font-semibold py-3 rounded-xl transition shadow-md flex items-center justify-center gap-2 text-lg">
                    <i class="fas fa-receipt"></i> View Order History
                </a>
                <a href="{{ route('home') }}" 
                   class="block w-full border-2 border-amber-800 text-amber-800 hover:bg-amber-50 font-semibold py-3 rounded-xl transition flex items-center justify-center gap-2 text-lg">
                    <i class="fas fa-home"></i> Back to Home
                </a>
            </div>

            <p class="text-sm text-gray-400 mt-6">A confirmation email has been sent to your registered email address.</p>
        </div>
    </div>
</div>
@endsection