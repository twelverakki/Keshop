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
                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
            </div>

            <div>
                <h1 class="text-4xl font-bold text-[#2f442f] mb-2">{{ $product->name }}</h1>
                <div class="flex items-center space-x-4 mb-6">
                    <p class="text-2xl text-[#456845] font-medium">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <div class="flex items-center text-yellow-400 text-sm">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <span class="text-gray-900 font-bold ml-1">{{ $product->average_rating }}</span>
                        <span class="text-gray-500 ml-1">({{ $product->reviews->count() }} Reviews)</span>
                    </div>
                </div>

                <p class="text-gray-600 leading-relaxed mb-8">
                    {{ $product->description }}
                </p>

                @if(Auth::check() && Auth::user()->role !== 'buyer')
                    <div class="bg-gray-100 p-4 rounded text-gray-600 text-sm mb-6">
                        Login as <strong>Buyer</strong> to purchase this item.
                    </div>
                @else
                    <form action="{{ route('cart.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="flex items-center space-x-4 mb-8">
                            <div class="w-32">
                                <label class="text-xs font-bold text-gray-500 uppercase mb-1 block">Quantity</label>
                                <input type="number" name="quantity" value="1" min="1" class="w-full border-gray-300 rounded-lg focus:ring-hiyoucan-500 focus:border-hiyoucan-500 text-center">
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <button type="submit" class="flex-1 bg-[#395339] text-white px-8 py-4 rounded-full font-bold hover:bg-[#2f442f] transition shadow-lg flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                Add to Cart
                            </button>
                        </div>
                    </form>
                @endif

                <div class="mt-8 pt-8 border-t border-gray-200 text-sm text-gray-500 space-y-2">
                    <p><span class="font-bold text-gray-900">Category:</span> {{ $product->category ? $product->category->name : 'Uncategorized' }}</p>
                    <p><span class="font-bold text-gray-900">Stock:</span> {{ $product->stock }} items available</p>
                    <p><span class="font-bold text-gray-900">Seller:</span> {{ $product->seller->name }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 mb-16">
            <h2 class="text-2xl font-bold text-[#2f442f] mb-6">Customer Reviews</h2>

            @auth
                @if(Auth::user()->role === 'buyer')
                <div class="bg-gray-50 p-6 rounded-lg mb-8 border border-gray-200">
                    <h3 class="font-bold text-gray-800 mb-2">Write a Review</h3>
                    <p class="text-xs text-gray-500 mb-4">Share your experience with this product. (Must have purchased & completed order)</p>

                    <form action="{{ route('reviews.store', $product->id) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                            <div class="rating-input justify-end">
                                <input type="radio" id="star5" name="rating" value="5" required><label for="star5" title="5 Stars">★</label>
                                <input type="radio" id="star4" name="rating" value="4"><label for="star4" title="4 Stars">★</label>
                                <input type="radio" id="star3" name="rating" value="3"><label for="star3" title="3 Stars">★</label>
                                <input type="radio" id="star2" name="rating" value="2"><label for="star2" title="2 Stars">★</label>
                                <input type="radio" id="star1" name="rating" value="1"><label for="star1" title="1 Star">★</label>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Comment</label>
                            <textarea name="comment" rows="3" class="w-full border-gray-300 rounded-md text-sm focus:ring-hiyoucan-500 focus:border-hiyoucan-500" placeholder="How was the product?"></textarea>
                        </div>
                        <button type="submit" class="bg-[#456845] text-white px-6 py-2 rounded-md text-sm hover:bg-[#395339]">Submit Review</button>
                    </form>
                </div>
                @endif
            @endauth

            <div class="space-y-6">
                @forelse($product->reviews as $review)
                <div class="border-b border-gray-100 pb-6 last:border-0">
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 rounded-full bg-hiyoucan-100 flex items-center justify-center text-[#456845] font-bold text-sm">
                                {{ substr($review->user->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 text-sm">{{ $review->user->name }}</p>
                                <p class="text-xs text-gray-400">{{ $review->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                        <div class="flex text-yellow-400 text-sm">
                            @for($i=0; $i < $review->rating; $i++) ★ @endfor
                            @for($i=$review->rating; $i < 5; $i++) <span class="text-gray-200">★</span> @endfor
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed pl-13">{{ $review->comment }}</p>
                </div>
                @empty
                <p class="text-gray-500 text-center py-4">No reviews yet. Be the first to review!</p>
                @endforelse
            </div>
        </div>

    </div>

    <div class="py-16 bg-earth-100/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h3 class="text-2xl font-bold text-[#2f442f] mb-8">You May Also Like</h3>
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-6">
                @foreach($relatedProducts as $related)
                <a href="{{ route('shop.show', $related->slug) }}" class="group block bg-white rounded-xl p-4 hover:shadow-md transition">
                    <div class="aspect-square bg-earth-100 rounded-lg overflow-hidden mb-3">
                        <img src="{{ $related->image }}" class="w-full h-full object-cover group-hover:scale-105 transition">
                    </div>
                    <h4 class="font-bold text-gray-900 truncate">{{ $related->name }}</h4>
                    <p class="text-[#456845] text-sm">Rp {{ number_format($related->price, 0, ',', '.') }}</p>
                </a>
                @endforeach
            </div>
        </div>
    </div>

</x-guest-layout>