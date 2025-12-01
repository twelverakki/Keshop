<a href="{{ route('shop.show', $product->slug) }}" class="group block bg-white rounded-xl p-4 hover:shadow-lg transition duration-200 border border-gray-100 relative overflow-hidden">

    <div class="aspect-square bg-gray-100 rounded-lg overflow-hidden mb-3">
        <img
            src="{{ $product->image_url }}"
            alt="{{ $product->name }}"
            class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
        >
    </div>

    <h4 class="font-semibold text-gray-900 truncate mb-1 text-base">{{ $product->name }}</h4>

    <div class="flex flex-col space-y-1">

        <div class="flex justify-between items-center">
            <span class="text-xl font-extrabold text-gray-900">
                Rp {{ number_format($product->price, 0, ',', '.') }}
            </span>

            @if($product->is_new ?? false)
            <span class="bg-orange-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full uppercase">
                New
            </span>
            @endif
        </div>

        <div class="flex items-center">
            @php
                $avgRating = $product->reviews_avg_rating ?? 0;
                $reviewCount = $product->reviews_count ?? 0;
            @endphp

            <div class="flex items-center text-yellow-500 text-xs mr-2">
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

    </div>
</a>