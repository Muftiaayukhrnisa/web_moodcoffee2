@extends('layouts.app')
@section('title', 'Home')
@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    {{-- Header --}}
    <div class="flex justify-between items-start mb-6">
        <div>
            <p class="text-gray-500 text-sm">Hey,</p>
            <h1 class="text-2xl font-bold text-gray-800">{{ $username ?? 'User' }}</h1>
        </div>
    </div>

    {{-- Subtitle --}}
    <p class="text-gray-600 text-base mb-3">Pilih seduhan favoritmu</p>

    {{-- Search Bar --}}
    <div class="relative mb-6">
        <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
        <input type="text" id="search-input" placeholder="Search for coffee" 
               class="w-full bg-white border border-gray-200 rounded-2xl py-3 pl-11 pr-4 text-sm shadow-sm focus:ring-2 focus:ring-amber-800 outline-none">
    </div>

    {{-- Banner "moodcoffee" --}}
    <div class="bg-amber-800 rounded-2xl p-4 mb-6 flex justify-between items-center">
        <span class="text-white font-semibold text-lg">moodcoffee</span>
        <span class="text-2xl text-white">☕</span>
    </div>

    {{-- Recommended Section --}}
    @if(isset($recommended) && count($recommended) > 0)
    <div class="mb-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-3">Recommended for you</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($recommended as $item)
            <div class="bg-white rounded-2xl p-3 shadow-sm border border-gray-100">
                <div class="w-full h-32 bg-amber-50 rounded-xl flex items-center justify-center text-amber-500">
                    <i class="fas fa-coffee text-4xl"></i>
                </div>
                <h4 class="font-bold text-gray-800 mt-2 text-base">{{ $item->name }}</h4>
                <p class="text-xs text-gray-500 line-clamp-2">{{ $item->description }}</p>
                <div class="flex items-center mt-1">
                    <i class="fas fa-star text-yellow-400 text-xs"></i>
                    <span class="text-xs text-gray-700 ml-1">{{ number_format($item->rating, 1) }}</span>
                </div>
                <p class="font-semibold text-amber-800 text-sm mt-1">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                <a href="{{ route('product.show', $item->id) }}" 
                   class="w-full block text-center bg-amber-800 text-white text-xs py-1 rounded-lg hover:bg-amber-900 transition mt-2">
                    Detail
                </a>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Menu Kopi Section (Semua Produk) --}}
    <div>
        <h3 class="text-lg font-semibold text-gray-800 mb-3">Menu Kopi</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" id="menu-grid">
            @foreach($products as $item)
            <div class="menu-item bg-white rounded-2xl p-3 shadow-sm border border-gray-100" data-name="{{ strtolower($item->name) }}">
                <div class="w-full h-32 bg-amber-50 rounded-xl flex items-center justify-center text-amber-500">
                    <i class="fas fa-coffee text-4xl"></i>
                </div>
                <h4 class="font-bold text-gray-800 mt-2 text-base">{{ $item->name }}</h4>
                <p class="text-xs text-gray-500 line-clamp-2">{{ $item->description }}</p>
                <div class="flex items-center justify-between mt-2">
                    <span class="font-semibold text-amber-800 text-sm">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                </div>
                <a href="{{ route('product.show', $item->id) }}" 
                   class="w-full block text-center bg-amber-800 text-white text-xs py-1 rounded-lg hover:bg-amber-900 transition mt-2">
                    Detail
                </a>
            </div>
            @endforeach
        </div>
        <div id="empty-search" class="text-center py-8 text-gray-400 hidden">Menu tidak ditemukan</div>
    </div>
</div>

<script>
    const searchInput = document.getElementById('search-input');
    const menuItems = document.querySelectorAll('.menu-item');
    const emptyMsg = document.getElementById('empty-search');
    searchInput.addEventListener('input', function() {
        let keyword = this.value.toLowerCase();
        let visible = 0;
        menuItems.forEach(item => {
            let name = item.getAttribute('data-name');
            if (name.includes(keyword)) {
                item.style.display = 'block';
                visible++;
            } else {
                item.style.display = 'none';
            }
        });
        emptyMsg.style.display = visible === 0 ? 'block' : 'none';
    });
</script>
@endsection