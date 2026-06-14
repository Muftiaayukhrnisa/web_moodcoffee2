@php
    $activeHome = request()->routeIs('home');
    $activeFavorites = request()->routeIs('favorites.index');
    $activeCart = request()->routeIs('cart.*');
    $activeProfile = request()->routeIs('profile.edit');
    $cartCount = $cartCount ?? 0;
@endphp

<div class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 py-2 shadow-lg z-50">
    <div class="flex justify-around items-center w-full px-4">
        <a href="{{ route('home') }}" class="flex flex-col items-center {{ $activeHome ? 'text-amber-800' : 'text-gray-500' }}">
            <i class="fas fa-home text-xl"></i>
            <span class="text-xs mt-1">Home</span>
        </a>
        <a href="{{ route('favorites.index') }}" class="flex flex-col items-center {{ $activeFavorites ? 'text-amber-800' : 'text-gray-500' }}">
            <i class="far fa-heart text-xl"></i>
            <span class="text-xs mt-1">Favorites</span>
        </a>
        <a href="{{ route('cart.index') }}" class="flex flex-col items-center relative {{ $activeCart ? 'text-amber-800' : 'text-gray-500' }}">
            <i class="fas fa-shopping-bag text-xl"></i>
            <span class="cart-count-badge absolute -top-2 -right-2 bg-amber-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center" style="{{ $cartCount > 0 ? '' : 'display:none' }}">{{ $cartCount }}</span>
            <span class="text-xs mt-1">Cart</span>
        </a>
        <a href="{{ route('profile.edit') }}" class="flex flex-col items-center {{ $activeProfile ? 'text-amber-800' : 'text-gray-500' }}">
            <i class="far fa-user-circle text-xl"></i>
            <span class="text-xs mt-1">Profile</span>
        </a>
    </div>
</div>