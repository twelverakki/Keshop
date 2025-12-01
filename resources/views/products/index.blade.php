<x-guest-layout>

    <section class="bg-gray-50 pt-16 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-5xl font-light tracking-wide text-gray-900 border-b-2 border-gray-300 inline-block pb-3 mb-10">
                Product List Page
            </h1>

            <div class="bg-white p-6 rounded-lg shadow-lg text-left mb-10 border border-gray-200">
                <div class="flex flex-col md:flex-row items-center">
                    <div class="md:w-1/2 overflow-hidden rounded-lg mr-6 mb-4 md:mb-0">
                        <img src="https://via.placeholder.com/600x300?text=WINK+Collection+Banner" alt="Collection Banner" class="w-full h-auto object-cover">
                    </div>

                    <div class="md:w-1/2 space-y-3">
                        <p class="text-sm font-semibold uppercase tracking-wider text-gray-500">Collections</p>
                        <h2 class="text-3xl font-bold text-gray-900">Explore The Various Collection of WINK Collection</h2>
                        <p class="text-gray-600">Don't miss out to shopping collection from us! join now as premium.</p>
                        <a href="#" class="inline-block mt-4 text-orange-600 font-medium hover:text-orange-700">Explore More →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <p class="text-sm text-gray-500 mb-6">Home / <span class="text-gray-800 font-medium">Wink Collection</span></p>

        <div class="flex flex-col lg:flex-row gap-10">

            <aside class="w-full lg:w-1/4 space-y-8 p-4 bg-white rounded-lg border border-gray-100 h-full lg:sticky lg:top-20">

                <div class="space-y-4 border-b pb-4">
                    <p class="font-bold text-gray-900">Brand</p>
                    <ul class="text-sm space-y-2">
                        @foreach(['Adidas', 'Zara', 'Dickies', 'Nike', 'Uniqlo'] as $brand)
                        <li class="flex justify-between items-center text-gray-600">
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox h-4 w-4 text-orange-600 border-gray-300 rounded focus:ring-orange-500" {{ $brand === 'Dickies' ? 'checked' : '' }}>
                                <span class="ml-2">{{ $brand }}</span>
                            </label>
                            <span class="text-xs text-gray-400">({{ rand(5, 50) }})</span>
                        </li>
                        @endforeach
                    </ul>
                    <button class="text-xs font-medium text-orange-600 hover:text-orange-700">Show more</button>
                </div>

                <div class="space-y-4 border-b pb-4">
                    <p class="font-bold text-gray-900">Category</p>
                    <ul class="text-sm space-y-2">
                        @foreach(['Sneakers', 'T-shirts', 'Jeans', 'Sweaters', 'Overshirt', 'Boots'] as $category)
                        <li class="flex justify-between items-center text-gray-600">
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox h-4 w-4 text-orange-600 border-gray-300 rounded focus:ring-orange-500">
                                <span class="ml-2">{{ $category }}</span>
                            </label>
                            <span class="text-xs text-gray-400">({{ rand(5, 50) }})</span>
                        </li>
                        @endforeach
                    </ul>
                    <button class="text-xs font-medium text-orange-600 hover:text-orange-700">Show more</button>
                </div>

                <div class="space-y-4">
                    <p class="font-bold text-gray-900">Price</p>
                    <input type="range" min="10000" max="500000" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer range-lg text-orange-500">
                    <div class="flex justify-between text-sm text-gray-600">
                        <span>Min: 10K</span>
                        <span>Max: 500K</span>
                    </div>
                </div>

            </aside>

            <div class="w-full lg:w-3/4">

                <h2 class="text-3xl font-bold mb-6 text-gray-800">Wink Collection</h2>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                    @forelse ($products as $product)
                        <div class="group relative bg-white rounded-lg shadow-sm hover:shadow-lg transition duration-300">

                            <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden bg-gray-100">
                                <img src="{{ $product->image_url ? asset('storage/products/' . $product->image_url) : 'https://via.placeholder.com/400x400?text=' . urlencode($product->name) }}"
                                     alt="{{ $product->name }}"
                                     class="w-full h-full object-cover group-hover:opacity-85 transition duration-300">

                                <div class="absolute bottom-4 right-4 flex space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <button class="bg-white p-2 rounded-full shadow-md text-gray-500 hover:text-orange-500" title="Add to Wishlist">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                    </button>
                                    <button class="bg-white p-2 rounded-full shadow-md text-gray-500 hover:text-orange-500" title="Add to Cart">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    </button>
                                </div>
                            </div>

                            <div class="p-4 text-center">
                                <h3 class="mt-1 text-base font-semibold text-gray-800 hover:text-orange-600 transition duration-150 truncate">
                                    <a href="#">{{ $product->name }}</a>
                                </h3>
                                <p class="text-xs text-gray-500 mb-2">stripes that fits slim</p>

                                <div class="flex justify-center items-baseline mt-1">
                                    @if ($product->discounted_price)
                                        <p class="text-lg font-bold text-gray-900">Rp {{ number_format($product->discounted_price * 1000, 0, ',', '.') }}</p>
                                        <p class="text-sm font-light text-gray-400 line-through ml-2">Rp {{ number_format($product->price * 1000, 0, ',', '.') }}</p>
                                    @else
                                        <p class="text-lg font-bold text-gray-900">Rp {{ number_format($product->price * 1000, 0, ',', '.') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-lg text-gray-600 col-span-3">Produk tidak ditemukan.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>