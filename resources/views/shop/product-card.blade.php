@php $isWishlisted = Auth::user() ? Auth::user()->wishlists->contains('product_id', $product->id) : 0; @endphp

<div>
    <a href="{{ route('shop.show', $product->slug) }}" class="block">
        <div class="relative aspect-square bg-gray-50 rounded-lg flex justify-center items-center overflow-hidden">

            <span class="absolute top-3 right-3 bg-white text-gray-800 text-xs font-medium px-3 py-1 rounded-full shadow-md z-10">
                {{$product->category->shortName ?? 'N/A'}}
            </span>

            <img
                src="{{ $product->image_url }}"
                alt="{{ $product->name }}"
                class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
            >
        </div>
    </a>

    <div class="rounded-xl overflow-hidden pt-4 transition duration-300">
        <h3 class="text-xl font-bold text-gray-900 mb-1">{{$product->shortName}}</h3>

        <div class="flex justify-between mb-2">
            <div class="flex flex-1 items-center align-middle">
                <span class="text-yellow-500 mr-2">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                        <path d="M10 15l-5.878 3.09 1.123-6.545L.487 7.247l6.565-.955L10 0l2.948 6.292 6.565.955-4.758 4.638 1.123 6.545z"/>
                    </svg>
                </span>
                <span class="text-sm leading-normal text-gray-500 font-medium">
                    {{ number_format($product->average_rating ?? 0, 1) }} ({{ $product->reviews_count ?? 0 }})
                </span>
            </div>

                <span class="text-end flex-1 text-xl font-bold text-gray-900">
                Rp {{ number_format($product->price, 0, ',', '.') }}
                </span>
        </div>
    </div>
    <div class="text-sm text-center flex gap-2">

        @auth
        <form action="{{ route('wishlist.toggle', $product->id)}}" method="POST" class="">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <button type="submit"
                class="rounded-full p-3 shadow-md hover:scale-110 transition duration-200 group/btn border border-gray-100"
            >
                <svg class="w-5 h-5 inline {{ $isWishlisted ? 'fill-red-500 text-red-500' : 'fill-none text-gray-400 group-hover/btn:text-red-500' }}" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
            </button>
        </form>
        {{-- <button type="submit" class="bg-white rounded-full p-3 shadow-md hover:scale-110 transition duration-200 group/btn border border-gray-100">
            @php $isWishlisted = Auth::user()->wishlists->contains('product_id', $product->id); @endphp
            <svg class="w-5 h-5 {{ $isWishlisted ? 'fill-red-500 text-red-500' : 'fill-none text-gray-400 group-hover/btn:text-red-500' }}" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
            </svg>
        </button> --}}
        @else
        {{-- <a  class="group/btn flex-1 px-4 py-3 text-gray-900 font-semibold border border-gray-300 rounded-full hover:bg-gray-100 transition duration-150">
            Add to
            <svg class="w-5 h-5 inline fill-none text-gray-400 group-hover/btn:text-red-500" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
            </svg>
        </a> --}}
        <a href="{{ route('register', $product->slug) }}" class="bg-white rounded-full p-3 shadow-md hover:scale-110 transition duration-200 group/btn border border-gray-100">
            <svg class="w-5 h-5 {{ $isWishlisted ? 'fill-red-500 text-red-500' : 'fill-none text-gray-400 group-hover/btn:text-red-500' }}" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
            </svg>
        </a>
        @endauth

        <a href="{{ route('shop.show', $product->slug) }}" class="inline w-full text-center px-4 py-3 bg-black text-white font-semibold rounded-full hover:bg-gray-700 transition duration-150">
            Buy Now
        </a>
    </div>
</div>