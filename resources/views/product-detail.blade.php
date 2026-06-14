@extends('layouts.app')
@section('title', $product->name)
@section('content')
<div class="max-w-4xl mx-auto px-4 py-6">
    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
        {{-- Product Image --}}
        <div class="w-full h-80 bg-amber-50 relative overflow-hidden">
            <img src="{{ $product->image_url ?? 'https://placehold.co/800x600?text=No+Image' }}" 
                 alt="{{ $product->name }}" 
                 class="w-full h-full object-cover">
            {{-- Tombol Favorite --}}
            <form action="{{ route('favorite.toggle', $product->id) }}" method="POST" id="favorite-form" class="absolute top-4 right-4">
                @csrf
                <button type="submit" id="favorite-btn" class="bg-white rounded-full p-2 shadow-md hover:scale-105 transition">
                    <i id="favorite-icon" class="{{ ($isFavorited ?? false) ? 'fas fa-heart text-red-500' : 'far fa-heart text-gray-500' }} text-2xl"></i>
                </button>
            </form>
        </div>

        <div class="p-6">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">{{ $product->name }}</h1>
                    <p class="text-gray-600 mt-1">{{ $product->description }}</p>
                </div>
                <div class="bg-amber-100 rounded-full px-3 py-1">
                    <span class="text-amber-800 font-semibold">⭐ {{ number_format($product->rating, 1) }}</span>
                </div>
            </div>

            {{-- Options Milk & Size --}}
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="font-semibold text-gray-700 mb-2">Milk</h3>
                    <div class="flex flex-wrap gap-3">
                        @foreach(['Classic', 'Coconut', 'Almond'] as $milkOption)
                            <button type="button" 
                                    class="milk-option px-4 py-2 rounded-full border border-amber-800 font-medium transition
                                           {{ $loop->first ? 'bg-amber-800 text-white' : 'bg-white text-amber-800' }}"
                                    data-milk="{{ $milkOption }}">
                                {{ $milkOption }}
                            </button>
                        @endforeach
                    </div>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-700 mb-2">Size</h3>
                    <div class="flex flex-wrap gap-3">
                        @php
                            $sizes = [
                                ['value' => 280, 'label' => '280ml', 'add' => 0],
                                ['value' => 370, 'label' => '370ml', 'add' => 5000],
                                ['value' => 450, 'label' => '450ml', 'add' => 10000],
                            ];
                        @endphp
                        @foreach($sizes as $size)
                            <button type="button"
                                    class="size-option px-4 py-2 rounded-full border border-amber-800 font-medium transition
                                           {{ $loop->first ? 'bg-amber-800 text-white' : 'bg-white text-amber-800' }}"
                                    data-price-add="{{ $size['add'] }}"
                                    data-size="{{ $size['value'] }}">
                                {{ $size['label'] }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Harga dinamis --}}
            <div class="mt-6">
                <p class="text-gray-700 font-semibold">Harga:</p>
                <p class="text-2xl font-bold text-amber-800" id="dynamic-price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            </div>

            {{-- Action Buttons --}}
            <div class="mt-6 flex flex-col sm:flex-row gap-4">
                <form id="addToCartForm" action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-1">
                    @csrf
                    <input type="hidden" name="milk" id="selected_milk" value="Classic">
                    <input type="hidden" name="size" id="selected_size" value="280">
                    <input type="hidden" name="final_price" id="final_price" value="{{ $product->price }}">
                    <button type="submit" class="w-full bg-amber-800 hover:bg-amber-900 text-white font-semibold py-3 rounded-xl transition flex items-center justify-center gap-2">
                        <i class="fas fa-shopping-cart"></i> Add to Cart
                    </button>
                </form>
                <form action="{{ route('checkout.direct', $product->id) }}" method="POST" class="flex-1">
                    @csrf
                    <input type="hidden" name="milk" id="direct_milk" value="Classic">
                    <input type="hidden" name="size" id="direct_size" value="280">
                    <input type="hidden" name="final_price" id="direct_final_price" value="{{ $product->price }}">
                    <button type="submit" class="w-full bg-amber-600 hover:bg-amber-700 text-white font-semibold py-3 rounded-xl transition flex items-center justify-center gap-2">
                        <i class="fas fa-bolt"></i> Order Now
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const basePrice = {{ $product->price }};
    const priceElem = document.getElementById('dynamic-price');
    const finalPriceInput = document.getElementById('final_price');
    const selectedMilkInput = document.getElementById('selected_milk');
    const selectedSizeInput = document.getElementById('selected_size');
    const directMilkInput = document.getElementById('direct_milk');
    const directSizeInput = document.getElementById('direct_size');
    const directFinalPriceInput = document.getElementById('direct_final_price');

    function updatePrice() {
        let activeSize = document.querySelector('.size-option.bg-amber-800');
        if (!activeSize) return;
        let priceAdd = parseInt(activeSize.dataset.priceAdd) || 0;
        let newPrice = basePrice + priceAdd;
        priceElem.innerText = 'Rp ' + newPrice.toLocaleString('id-ID');
        finalPriceInput.value = newPrice;
        selectedSizeInput.value = activeSize.dataset.size;
        directSizeInput.value = activeSize.dataset.size;
        directFinalPriceInput.value = newPrice;
    }

    document.querySelectorAll('.size-option').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.size-option').forEach(opt => {
                opt.classList.remove('bg-amber-800', 'text-white');
                opt.classList.add('bg-white', 'text-amber-800');
            });
            this.classList.add('bg-amber-800', 'text-white');
            this.classList.remove('bg-white', 'text-amber-800');
            updatePrice();
        });
    });

    document.querySelectorAll('.milk-option').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.milk-option').forEach(opt => {
                opt.classList.remove('bg-amber-800', 'text-white');
                opt.classList.add('bg-white', 'text-amber-800');
            });
            this.classList.add('bg-amber-800', 'text-white');
            this.classList.remove('bg-white', 'text-amber-800');
            const milkValue = this.dataset.milk;
            selectedMilkInput.value = milkValue;
            directMilkInput.value = milkValue;
        });
    });

    updatePrice();

    // AJAX untuk favorite toggle
    const favForm = document.getElementById('favorite-form');
    if (favForm) {
        favForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const url = this.action;
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const icon = document.getElementById('favorite-icon');
                    if (data.favorited) {
                        icon.classList.remove('far', 'fa-heart', 'text-gray-500');
                        icon.classList.add('fas', 'fa-heart', 'text-red-500');
                    } else {
                        icon.classList.remove('fas', 'fa-heart', 'text-red-500');
                        icon.classList.add('far', 'fa-heart', 'text-gray-500');
                    }
                }
            })
            .catch(error => console.error('Error:', error));
        });
    }
</script>
@endsection