<x-guest-layout>

    <div class="pt-6 pb-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-4 rounded mb-6 border border-red-200">{{ session('error') }}</div>
        @endif

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-6 border border-green-200">{{ session('success') }}</div>
        @endif

        <nav class="text-sm mb-8 text-gray-500
            <a href="/" class="hover:text-[#456845] hover:underline">Home</a> <span class="mx-2">/</span>
            <a href="{{ route('shop.index') }}" class="hover:text-[#456845] hover:underline">Shop</a> <span class="mx-2">/</span>
            <span class="text-gray-900">{{ $product->name }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">

            <div class="bg-earth-100 rounded-2xl overflow-hidden aspect-square">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
            </div>

            <div x-data="{ quantity: 1 }">

                <h1 class="text-4xl font-extrabold text-gray-900 mb-2 leading-tight">{{ $product->name }}</h1>

                <p class="text-gray-700 text-lg leading-relaxed mb-8">
                    {{ $product->description }}
                </p>

                <div class="flex items-center justify-between space-x-6 mb-6 pb-4 border-b border-gray-100">

                    <p class="text-2xl text-gray-900 font-extrabold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

                    @php
                        $avgRating = round($product->reviews_avg_rating ?? ($product->average_rating ?? 0), 1);
                        $reviewCount = $product->reviews_count ?? ($product->reviews->count() ?? 0);
                    @endphp

                    <div class="flex items-center text-yellow-500 text-base">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= round($avgRating))
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.487 7.247l6.565-.955L10 0l2.948 6.292 6.565.955-4.758 4.638 1.123 6.545z"/></svg>
                            @else
                                <svg class="w-5 h-5 fill-current text-gray-300" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.487 7.247l6.565-.955L10 0l2.948 6.292 6.565.955-4.758 4.638 1.123 6.545z"/></svg>
                            @endif
                        @endfor

                        <span class="text-gray-900 font-bold ml-2">{{ number_format($avgRating, 1) }}</span>
                        <span class="text-gray-500 ml-1">({{ $reviewCount }} Reviews)</span>
                    </div>
                </div>

                @if(Auth::check() && Auth::user()->role !== 'buyer')
                    <div class="bg-yellow-50 p-4 rounded-lg text-gray-800 text-sm mb-6 border border-yellow-200">
                        Login sebagai **Buyer** untuk menambahkan ke keranjang dan membeli item ini.
                    </div>
                @else
                    <form action="{{ route('cart.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="flex flex-col md:flex-row items-start md:items-center space-y-4 md:space-y-0 md:space-x-6 mb-8">

                            <div class="w-full md:w-36 flex-shrink-0">
                                <label class="text-xs font-bold text-gray-500 uppercase mb-1 block md:hidden">Quantity</label>

                                <div class="flex items-center border border-gray-300 rounded-full overflow-hidden shadow-sm">
                                    <button type="button" @click="quantity = Math.max(1, quantity - 1)" class="p-3 text-gray-600 hover:bg-gray-100 transition duration-150">-</button>
                                    <input type="number" name="quantity" x-model="quantity" min="1" max="{{ $product->stock }}" class="w-full text-lg border-none focus:ring-0 text-center py-2 px-1 appearance-none hide-spin-buttons">
                                    <button type="button" @click="quantity = Math.min({{ $product->stock }}, quantity + 1)" class="p-3 text-gray-600 hover:bg-gray-100 transition duration-150">+</button>
                                </div>
                            </div>

                            <div class="w-full md:flex-1 flex gap-4">

                                <button type="submit" :disabled="quantity === 0 || {{ $product->stock }} === 0"
                                        class="flex-1 w-full bg-[#456845] text-white px-6 py-3 md:py-4 rounded-full font-bold hover:bg-[#395339] transition shadow-xl flex items-center justify-center gap-2 disabled:bg-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                    <span class="text-base md:text-lg">Add to Cart</span>
                                </button>

                                <button type="button"
                                        class="w-12 h-12 md:w-16 md:h-auto bg-gray-100 text-gray-700 py-3 rounded-full font-bold hover:bg-red-50 transition border border-gray-300 shadow-md flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                </button>
                            </div>
                        </div>

                    </form>
                @endif

                <div class="mt-8 pt-8 border-t border-gray-200 text-sm text-gray-500 space-y-2">
                    <p><span class="font-bold text-gray-900">Category:</span> {{ $product->category ? $product->category->name : 'Uncategorized' }}</p>
                    <p><span class="font-bold text-gray-900">Stock:</span> <span class="font-medium {{ $product->stock < 10 ? 'text-red-500' : 'text-green-600' }}">{{ $product->stock }} items available</span></p>
                    <p><span class="font-bold text-gray-900">Seller:</span> {{ $product->seller->name }}</p>
                    <p><span class="font-bold text-gray-900">Description:</span> {{ $product->description }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-2xl border border-gray-100 p-8 mb-6">
            <h2 class="text-2xl font-extrabold text-gray-800 mb-6 border-b pb-3">Customer Reviews</h2>

            @auth
                @if(Auth::user()->role === 'buyer')
                <div class="bg-gray-50 p-6 rounded-xl mb-8 border border-gray-200 shadow-inner">
                    <h3 class="font-bold text-lg text-gray-800 mb-2">Write a Review</h3>
                    <p class="text-xs text-gray-500 mb-4">Share your experience. (Must have purchased & completed order)</p>

                    <form action="{{ route('reviews.store', $product->id) }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Rating</label>
                            <div class="star-rating-input">
                                <input type="radio" id="star5" name="rating" value="5" required><label for="star5" title="5 Stars">★</label>
                                <input type="radio" id="star4" name="rating" value="4"><label for="star4" title="4 Stars">★</label>
                                <input type="radio" id="star3" name="rating" value="3"><label for="star3" title="3 Stars">★</label>
                                <input type="radio" id="star2" name="rating" value="2"><label for="star2" title="2 Stars">★</label>
                                <input type="radio" id="star1" name="rating" value="1"><label for="star1" title="1 Star">★</label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Comment</label>
                            <textarea name="comment" rows="3"
                                class="w-full border-gray-300 rounded-lg focus:ring-[#456845] focus:border-[#456845] transition"
                                placeholder="How was the product?"></textarea>
                        </div>

                        <button type="submit" class="bg-[#456845] text-white px-6 py-2 rounded-lg text-sm font-bold hover:bg-[#395339] transition shadow-md">Submit Review</button>
                    </form>
                </div>
                @endif
            @endauth

            <div class="space-y-8">
                @forelse($product->reviews as $review)
                <div class="border-b border-gray-200 pb-8 last:border-0">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-center gap-4">
                            <div class="h-12 w-12 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 font-bold text-base flex-shrink-0">
                                {{ substr($review->user->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 text-base">{{ $review->user->name }}</p>

                                <div class="flex text-yellow-500 text-sm mt-1">
                                    @for($i=0; $i < $review->rating; $i++) ★ @endfor
                                    @for($i=$review->rating; $i < 5; $i++) <span class="text-gray-300">★</span> @endfor
                                </div>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400 mt-1">{{ $review->created_at->format('d M Y') }}</p>
                    </div>
                    <p class="text-gray-700 text-base leading-relaxed pl-16">"{{ $review->comment }}"</p>
                </div>
                @empty
                <div class="bg-gray-50 p-6 rounded-xl text-center text-gray-600">
                    <p>No reviews yet. Be the first to share your experience!</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="pb-16 bg-earth-100/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h3 class="text-2xl font-bold text-[#2f442f] mb-8">You May Also Like</h3>
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-6">
                @foreach($relatedProducts as $product)
                @include('components.simple-card-product', $product)
                @endforeach
            </div>
        </div>
    </div>

</x-guest-layout>