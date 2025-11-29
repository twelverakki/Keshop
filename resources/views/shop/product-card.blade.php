<div class="relative bg-white border border-gray-100 rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-shadow duration-300">

    @if (isset($product->category->name))
        <div class="absolute top-4 right-4 z-10">
            <span class="bg-black text-white text-[10px] font-medium px-2 py-1 rounded-sm uppercase tracking-wider">
                {{ $product->category->name }}
            </span>
        </div>
    @endif 

    <a href="{{ route('shop.show', $product->slug) }}" class="block">

        <div class="relative aspect-square bg-gray-50 overflow-hidden">
            <img
                src="{{ asset($product->image) }}"
                alt="{{ $product->name }}"
                class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
            >
        </div>

        <div class="p-4 pt-3">
            <h3 class="font-semibold text-gray-900 text-lg mb-1 truncate leading-tight">
                {{ $product->name }}
            </h3>

            <div class="flex justify-between items-center mt-2">
                <span class="text-gray-900 font-bold text-lg">
                    ${{ number_format($product->price, 2) }}
                </span>

                </div>
        </div>
    </a>

    <div class="flex p-4 pt-0 space-x-3">
        <button type="button" class="flex-1 border border-gray-300 text-gray-700 py-2 text-sm font-semibold rounded-lg hover:bg-gray-100 transition duration-150">
            Add to Cart
        </button>
        <button type="button" class="flex-1 bg-black text-white py-2 text-sm font-semibold rounded-lg hover:bg-gray-800 transition duration-150">
            Buy Now
        </button>
    </div>
</div>