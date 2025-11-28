@props(['product'])

<div class="group relative bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-lg transition duration-300">
    {{-- Label Diskon --}}
    @if ($product->discounted_price)
        <div class="absolute top-0 right-0 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-bl-lg z-10">
            -{{ round((($product->price - $product->discounted_price) / $product->price) * 100) }}%
        </div>
    @endif

    {{-- Gambar Produk --}}
    <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden bg-gray-200">
        {{-- Menggunakan placeholder jika tidak ada image_url --}}
        <img src="{{ $product->image_url ? asset('storage/products/' . $product->image_url) : 'https://via.placeholder.com/400x300?text=' . urlencode($product->name) }}"
             alt="{{ $product->name }}"
             class="w-full h-full object-cover group-hover:opacity-75 transition duration-300">
    </div>

    {{-- Detail Produk --}}
    <div class="p-4">
        <h3 class="mt-1 text-sm text-gray-700 hover:text-orange-600 transition duration-150 font-medium truncate">
            <a href="#">{{ $product->name }}</a>
        </h3>

        <div class="flex items-baseline mt-1">
            @if ($product->discounted_price)
                {{-- Harga Diskon --}}
                <p class="text-lg font-bold text-orange-600">${{ number_format($product->discounted_price, 2) }}</p>
                {{-- Harga Asli (Dicoret) --}}
                <p class="text-sm font-light text-gray-400 line-through ml-2">${{ number_format($product->price, 2) }}</p>
            @else
                {{-- Harga Normal --}}
                <p class="text-lg font-medium text-gray-900">${{ number_format($product->price, 2) }}</p>
            @endif
        </div>

        {{-- Ikon Cepat (Opsional) --}}
        {{-- <div class="opacity-0 group-hover:opacity-100 absolute top-4 right-4 transition-all duration-300 space-y-2">
            <button class="bg-white p-2 rounded-full shadow-md text-gray-500 hover:text-orange-500"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg></button>
        </div> --}}
    </div>
</div>