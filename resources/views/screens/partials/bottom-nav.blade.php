@php
    $activeHome = request()->routeIs('home');
    $activeFavorites = request()->routeIs('favorites.*');
    $activeCart = request()->routeIs('cart.*');
    $activeHistory = request()->routeIs('order.history'); // halaman riwayat pesanan
    $activeProfile = request()->routeIs('profile.*');
    $cartCount = $cartCount ?? 0;
@endphp

<div class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 py-2 shadow-lg z-50">
    <div class="flex justify-around items-center w-full px-2">
        {{-- Home --}}
        <a href="{{ route('home') }}" class="flex flex-col items-center {{ $activeHome ? 'text-amber-800' : 'text-gray-500' }}">
            <i class="fas fa-home text-xl"></i>
            <span class="text-xs mt-1">Home</span>
        </a>

        {{-- Favorites --}}
        <a href="{{ route('favorites.index') }}" class="flex flex-col items-center {{ $activeFavorites ? 'text-amber-800' : 'text-gray-500' }}">
            <i class="far fa-heart text-xl"></i>
            <span class="text-xs mt-1">Favorites</span>
        </a>

        {{-- Cart (dengan badge jumlah) --}}
        <a href="{{ route('cart.index') }}" class="flex flex-col items-center relative {{ $activeCart ? 'text-amber-800' : 'text-gray-500' }}">
            <i class="fas fa-shopping-bag text-xl"></i>
            @if($cartCount > 0)
                <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">{{ $cartCount }}</span>
            @endif
            <span class="text-xs mt-1">Cart</span>
        </a>

        {{-- Order History --}}
        <a href="{{ route('order.history') }}" class="flex flex-col items-center {{ $activeHistory ? 'text-amber-800' : 'text-gray-500' }}">
            <i class="fas fa-history text-xl"></i>
            <span class="text-xs mt-1">History</span>
        </a>

        {{-- Profile --}}
        <a href="{{ route('profile.edit') }}" class="flex flex-col items-center {{ $activeProfile ? 'text-amber-800' : 'text-gray-500' }}">
            <i class="far fa-user-circle text-xl"></i>
            <span class="text-xs mt-1">Profile</span>
        </a>
    </div>
</div>