@extends('layouts.app')
@section('title', 'Favorites')
@section('content')
<div class="w-full px-4 sm:px-6 lg:px-8 py-6 bg-amber-50 min-h-screen">
    <div class="max-w-7xl mx-auto">
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
            <input type="text" id="search-fav" placeholder="Cari favorit..." 
                   class="w-full bg-white border border-gray-200 rounded-2xl py-3 pl-11 pr-4 text-sm shadow-sm focus:ring-2 focus:ring-amber-800 outline-none">
        </div>

        {{-- Favorites Grid (3 kolom) dengan background gambar --}}
        @if(isset($favorites) && count($favorites) > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="fav-grid">
                @foreach($favorites as $fav)
                <div class="fav-item relative rounded-2xl overflow-hidden shadow-lg h-64 bg-cover bg-center group" 
                     style="background-image: url('{{ $fav->product->image_url ?? 'https://placehold.co/600x400?text=No+Image' }}');"
                     data-name="{{ strtolower($fav->product->name) }}">
                    {{-- Overlay gelap --}}
                    <div class="absolute inset-0 bg-black/40 group-hover:bg-black/30 transition"></div>
                    
                    {{-- Konten di atas background --}}
                    <div class="absolute inset-0 flex flex-col justify-between p-5 text-white">
                        <div>
                            <h3 class="font-bold text-xl drop-shadow-md">{{ $fav->product->name }}</h3>
                        </div>
                        <div class="flex gap-3">
                            <a href="{{ route('product.show', $fav->product->id) }}" 
                               class="flex-1 bg-amber-700 hover:bg-amber-800 text-white text-center text-sm font-medium py-2 rounded-xl transition shadow-md">
                                Beli Sekarang
                            </a>
                            <form action="{{ route('favorite.toggle', $fav->product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-white/20 backdrop-blur-sm hover:bg-red-600 text-white p-2 rounded-xl transition" title="Hapus dari favorit">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div id="empty-search-fav" class="text-center py-8 text-gray-400 hidden">Tidak ada favorit yang ditemukan</div>
        @else
            <div class="text-center py-12 bg-white rounded-2xl shadow">
                <i class="far fa-heart text-6xl text-gray-300 mb-4"></i>
                <p class="text-gray-500">Belum ada favorit</p>
                <a href="{{ route('home') }}" class="inline-block mt-4 bg-amber-800 text-white px-6 py-2 rounded-xl">Jelajahi Menu</a>
            </div>
        @endif
    </div>
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
                    item.style.display = 'flex'; // grid item
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