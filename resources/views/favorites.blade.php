@extends('layouts.app')
@section('title', 'Favorites')
@section('content')
<div class="max-w-4xl mx-auto px-4 py-6">
    {{-- Header --}}
    <div class="flex justify-between items-start mb-6">
        <div>
            <p class="text-gray-500 text-sm">Hey,</p>
            <h1 class="text-2xl font-bold text-gray-800">{{ $username ?? 'User' }}</h1>
        </div>
        <div class="w-10 h-10 bg-amber-100 rounded-full flex items-center justify-center text-amber-800">
            <i class="fas fa-heart text-lg"></i>
        </div>
    </div>

    {{-- Title --}}
    <h2 class="text-xl font-semibold text-gray-800 mb-3">Seduhan Favoritmu</h2>

    {{-- Search Bar --}}
    <div class="relative mb-6">
        <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
        <input type="text" id="search-fav" placeholder="Search" 
               class="w-full bg-white border border-gray-200 rounded-2xl py-3 pl-11 pr-4 text-sm shadow-sm focus:ring-2 focus:ring-amber-800 outline-none">
    </div>

    {{-- Favorites List (vertical) --}}
    @if(isset($favorites) && count($favorites) > 0)
        <div class="space-y-4" id="fav-list">
            @foreach($favorites as $fav)
            <div class="fav-item bg-white rounded-2xl p-4 shadow-sm border border-gray-100" data-name="{{ strtolower($fav->product->name) }}">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 bg-amber-50 rounded-xl flex items-center justify-center text-amber-500 flex-shrink-0">
                        <i class="fas fa-coffee text-2xl"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-bold text-gray-800">{{ $fav->product->name }}</h3>
                        {{-- Harga tidak ditampilkan --}}
                    </div>
                    <div>
                        <a href="{{ route('product.show', $fav->product->id) }}" 
                           class="bg-amber-800 hover:bg-amber-900 text-white text-sm px-4 py-2 rounded-xl transition inline-block">
                            Beli Sekarang
                        </a>
                    </div>
                </div>
                <div class="mt-2 flex justify-end">
                    <form action="{{ route('favorite.toggle', $fav->product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="text-red-500 text-sm flex items-center gap-1">
                            <i class="fas fa-trash-alt"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        <div id="empty-search-fav" class="text-center py-8 text-gray-400 hidden">Tidak ada favorit yang ditemukan</div>
    @else
        <div class="text-center py-12">
            <i class="far fa-heart text-6xl text-gray-300 mb-4"></i>
            <p class="text-gray-500">Belum ada favorit</p>
            <a href="{{ route('home') }}" class="inline-block mt-4 bg-amber-800 text-white px-6 py-2 rounded-xl">Jelajahi Menu</a>
        </div>
    @endif
</div>

<script>
    const searchInput = document.getElementById('search-fav');
    const favItems = document.querySelectorAll('.fav-item');
    const emptyMsg = document.getElementById('empty-search-fav');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            let keyword = this.value.toLowerCase();
            let visible = 0;
            favItems.forEach(item => {
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
    }
</script>
@endsection