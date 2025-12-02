@php
    $avgRating = round($product->reviews_avg_rating ?? 0, 1);
    $reviewCount = $product->reviews_count ?? 0;
    $isWishlisted = Auth::check() ? Auth::user()->wishlists->contains('product_id', $product->id) : false;
@endphp

<div class="group/card bg-white rounded-xl shadow-lg hover:shadow-xl transition duration-300 overflow-hidden">

    <a href="{{ route('shop.show', $product->slug) }}" class="block">
        <div class="relative aspect-square bg-gray-100 flex justify-center items-center overflow-hidden">

            <span class="absolute top-3 right-3 bg-white text-gray-800 text-xs font-medium px-3 py-1 rounded-full shadow-md z-10">
                {{ $product->category->name ?? 'N/A'}}
            </span>

            <img
                src="{{ $product->image_url }}"
                alt="{{ $product->name }}"
                class="w-full h-full object-cover transition duration-500 group-hover/card:scale-105"
            >
        </div>
    </a>

    <div class="p-4 pt-3">
        <a href="{{ route('shop.show', $product->slug) }}" class="block">
            <h3 class="text-lg font-bold text-gray-900 mb-1 truncate">{{ $product->name }}</h3>
        </a>

        <div class="flex  xl:flex-row items-baseline flex-col xl:justify-between xl:items-center mb-3">

            <div class="flex items-center">

                <div class="flex text-yellow-500 text-sm mr-2">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= round($avgRating))
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.487 7.247l6.565-.955L10 0l2.948 6.292 6.565.955-4.758 4.638 1.123 6.545z"/></svg>
                        @else
                            <svg class="w-4 h-4 fill-current text-gray-300" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.487 7.247l6.565-.955L10 0l2.948 6.292 6.565.955-4.758 4.638 1.123 6.545z"/></svg>
                        @endif
                    @endfor
                </div>

                <span class="text-xs leading-normal text-gray-500 font-medium">
                    {{ number_format($avgRating, 1) }} ({{ $reviewCount }})
                </span>
            </div>

            <span class="text-lg font-bold text-gray-900 whitespace-nowrap">
                Rp {{ number_format($product->price, 0, ',', '.') }}
            </span>
        </div>
    </div>

    <div class="p-4 pt-0 text-center flex gap-3">

        @auth
        <form action="{{ route('wishlist.toggle', $product->id)}}" method="POST" class="">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <button type="submit"
                class="rounded-full p-3 shadow-md hover:scale-110 transition duration-200 group/btn border border-gray-100"
            >
                <svg class="w-5 h-5 inline {{ $isWishlisted ? 'fill-red-500 text-red-500' : 'fill-none text-gray-400 group-hover/btn:text-red-500 group-hover/btn:fill-red-500' }}" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
            </button>
        </form>
        @else
        <a href="{{ route('register', $product->slug) }}" class="bg-white rounded-full p-3 shadow-md hover:scale-110 transition duration-200 group/btn border border-gray-100">
            <svg class="w-5 h-5 {{ $isWishlisted ? 'fill-red-500 text-red-500' : 'fill-none text-gray-400 group-hover/btn:text-red-500' }}" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
            </svg>
        </a>
        @endauth

        <a href="{{ route('shop.show', $product->slug) }}" class="flex-1 sm:text-lg text-sm text-center px-4 py-3 bg-black text-white font-semibold rounded-full hover:bg-gray-700 transition duration-150 shadow-md">
            Buy Now
        </a>
    </div>
</div>