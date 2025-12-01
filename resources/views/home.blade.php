<x-guest-layout>
    @php
        $slides = [
            [
                'id' => 1,
                'title' => 'Spring Collection',
                'tag' => 'New Arrivals',
                'subtitle' => 'Davici Home Collection 2024',
                'image' => asset('images/hero-iamge-1.png'),
                'cta' => route('shop.index')
            ],
            [
                'id' => 2,
                'title' => 'Minimalist Oasis',
                'tag' => 'Limited Edition',
                'subtitle' => 'Summer Collection 2024',
                'image' => asset('images/kursi-modern-1.jpeg'),
                'cta' => route('shop.index')
            ],
            [
                'id' => 3,
                'title' => 'Warm Wood Vibes',
                'tag' => 'Best Seller',
                'subtitle' => 'Winter Clearance Sale',
                'image' => asset('images/interior-wood.jpeg'),
                'cta' => route('shop.index')
            ]
        ];
    @endphp

    <section
        x-data="{
            slides: @js($slides),
            activeSlide: 0,
            intervalTime: 5000,
            currentSlide() { return this.slides[this.activeSlide]; },
            nextSlide() {
                this.activeSlide = (this.activeSlide + 1) % this.slides.length;
            },
            startAutoSlide() {
                this._timer = setInterval(() => {
                    this.nextSlide();
                }, this.intervalTime);
            },
            stopAutoSlide() {
                clearInterval(this._timer);
            }
        }"
        x-init="startAutoSlide()"
        @mouseenter="stopAutoSlide()"
        @mouseleave="startAutoSlide()"
        class="relative md:h-[calc(100vh-64px)] bg-white pt-6 overflow-hidden border-b border-gray-100"
    >

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 z-10 space-y-4 md:space-y-6 md:pr-12 text-center md:text-left transition-opacity duration-700 ease-in-out">
                <p class="text-sm font-semibold uppercase tracking-widest text-gray-500" x-text="currentSlide().subtitle"></p>
                <p class="text-xs font-bold uppercase tracking-widest text-orange-600 bg-orange-50 border border-orange-200 inline-block px-3 py-1.5 rounded-full shadow-sm" x-text="currentSlide().tag"></p>
                <h1 class="text-4xl md:text-6xl lg:text-[80px] font-extrabold font-serif leading-tight text-gray-900" x-html="currentSlide().title.replace(' ', '<br>')"></h1>
                <a :href="currentSlide().cta" class="inline-flex items-center px-8 py-4 bg-gray-900 text-white font-semibold text-lg rounded-xl hover:bg-orange-600 transition duration-300 shadow-xl shadow-gray-300 hover:shadow-orange-400/50">
                    Shop Now
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
                <p class="text-sm text-gray-600 pt-2">Free shipping on orders over $150.</p>
            </div>

            <div class="md:w-1/2 mt-12 md:mt-0 relative flex justify-center md:justify-end">
                <img
                    :src="currentSlide().image"
                    :alt="currentSlide().title"
                    class="relative z-10 w-full max-w-lg lg:max-w-[500px] aspect-square object-cover rounded-2xl shadow-2xl transition-all duration-700 ease-in-out"
                >

                <span class="absolute inset-0 flex items-center justify-center text-[250px] font-bold text-gray-200 opacity-60 pointer-events-none -mt-16 md:-mr-16 md:text-[300px]" x-text="'0' + (currentSlide().id)"></span>
            </div>
        </div>

        <div class="absolute bottom-5 left-1/2 transform -translate-x-1/2 flex items-center space-x-3 mt-10">
            <button
                @click="stopAutoSlide(); activeSlide = (activeSlide - 1 + slides.length) % slides.length; startAutoSlide()"
                class="p-2 text-gray-700 hover:text-gray-900 bg-gray-100 rounded-full hover:bg-gray-200 transition duration-150"
                aria-label="Previous Slide"
                title="Previous"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg>
            </button>

            <template x-for="(slide, index) in slides" :key="slide.id">
                <button
                    @click="stopAutoSlide(); activeSlide = index; startAutoSlide()"
                    :class="activeSlide === index ? 'w-8 bg-gray-900' : 'w-2 bg-gray-400'"
                    class="h-1 rounded-full transition-all duration-300 hover:bg-gray-600"
                    :aria-label="'Go to slide ' + slide.id"
                ></button>
            </template>

            <button
                @click="stopAutoSlide(); activeSlide = (activeSlide + 1) % slides.length; startAutoSlide()"
                class="p-2 text-gray-700 hover:text-gray-900 bg-gray-100 rounded-full hover:bg-gray-200 transition duration-150"
                aria-label="Next Slide"
                title="Next"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
            </button>
        </div>
    </section>

    <section class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="relative bg-cover bg-center h-96 rounded-lg shadow-xl overflow-hidden" style="background-image: url('{{asset('images/alat-hiking.jpeg')}}');">
                    <div class="absolute inset-0 bg-black bg-opacity-30"></div>
                    <div class="relative p-10 flex flex-col justify-between h-full">
                        <p class="text-sm font-semibold text-white bg-orange-500 inline-block px-2 py-1 rounded-full">35 % OFF ALL ITEM</p>
                        <div>
                            <h3 class="text-4xl font-bold text-white mb-2">Summit Collection</h3>
                            <a href="{{route('shop.index')}}" class="inline-block px-6 py-2 bg-white text-gray-800 font-medium rounded-md hover:bg-gray-200 transition duration-150">Shop Now</a>
                        </div>
                    </div>
                </div>

                <div class="relative bg-cover bg-center h-96 rounded-lg shadow-xl overflow-hidden" style="background-image: url('{{asset('images/photo-1609081219090-a6d81d3085bf.avif')}}');">
                    <div class="absolute inset-0 bg-black bg-opacity-30"></div>
                    <div class="relative p-10 flex flex-col justify-between h-full">
                        <p class="text-sm font-semibold text-white bg-orange-500 inline-block px-2 py-1 rounded-full">12 % OFF ALL ITEM</p>
                        <div>
                            <h3 class="text-4xl font-bold text-white mb-2">Gadget Collection</h3>
                            <a href="{{route('shop.index')}}" class="inline-block px-6 py-2 bg-white text-gray-800 font-medium rounded-md hover:bg-gray-200 transition duration-150">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-8 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-gray-900 mb-10">Shop by Categories</h2>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

                <a href="{{ route('shop.index') }}" class="bg-gray-900 group text-white p-6 flex flex-col justify-between rounded-xl shadow-lg hover:shadow-xl transition transform duration-300 md:col-span-1">
                    <div class="space-y-3">
                        <svg class="w-10 h-10 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2h2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v2M7 7h10"></path></svg>
                        <p class="text-2xl font-extrabold">All Categories</p>
                        <p class="text-sm text-gray-300">
                            {{ $categories->sum('products_count') ?? '200+' }} products
                        </p>
                    </div>
                    <div class="text-orange-400 font-bold mt-4 flex items-center gap-1 transition duration-500 group-hover:text-yellow-400 text-xl">
                        Explore Now
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </div>
                </a>

                @foreach($categories as $cat)
                @if($cat->image)
                <a href="{{ route('shop.index', ['category' => $cat->slug]) }}" class="relative group overflow-hidden rounded-xl shadow-md transition transform duration-300 aspect-square">

                    <img
                        src="{{ $cat->image_url }}"
                        alt="{{ $cat->name }}"
                        class="w-full h-full object-cover transition duration-500 group-hover:scale-110 brightness-90"
                    >

                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-4">
                        <div class="space-y-0.5">
                            <p class="text-white font-extrabold text-xl">{{ $cat->name }}</p>
                            <p class="text-white/80 text-xs font-medium">{{ $cat->products_count }} Products</p>
                        </div>
                    </div>

                    <div class="absolute top-4 right-4 text-white p-2 rounded-full bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </div>

                </a>
                @endif
                @endforeach

            </div>
        </div>
    </section>



    <section
        x-data="{
            activeTab: 'new',

            newProducts: JSON.parse('{{ $newProducts }}'),
            topRatingProducts: JSON.parse('{{ $topRatingProducts }}'),
            bestSellerProducts: JSON.parse('{{ $bestSellerProducts }}'),

            get activeProducts() {
                if (this.activeTab === 'new') return this.newProducts;
                if (this.activeTab === 'rating') return this.topRatingProducts;
                if (this.activeTab === 'best') return this.bestSellerProducts;
                return [];
            }
        }"
        class="py-8 bg-white"
    >
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-gray-900 mb-8">Hot Products</h2>

            <div class="flex space-x-6 border-b border-gray-200 mb-8 text-sm font-medium">
                <button
                    @click="activeTab = 'new'"
                    :class="activeTab === 'new' ? 'text-orange-600 border-b-2 border-orange-600' : 'text-gray-500 hover:text-gray-700'"
                    class="pb-2 transition duration-150"
                >
                    NEW PRODUCTS
                </button>
                <button
                    @click="activeTab = 'rating'"
                    :class="activeTab === 'rating' ? 'text-orange-600 border-b-2 border-orange-600' : 'text-gray-500 hover:text-gray-700'"
                    class="pb-2 transition duration-150"
                >
                    TOP RATING
                </button>
                <button
                    @click="activeTab = 'best'"
                    :class="activeTab === 'best' ? 'text-orange-600 border-b-2 border-orange-600' : 'text-gray-500 hover:text-gray-700'"
                    class="pb-2 transition duration-150"
                >
                    BEST SELLERS
                </button>
                <a href="{{ route('shop.index') }}" class="ml-auto text-orange-500 hover:text-orange-700 pb-2 flex items-center gap-1">
                    All products <span class="font-bold">→</span>
                </a>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <template x-for="product in activeProducts" :key="product.id">
                    <a :href="'/shop/' + product.slug" class="group relative bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition duration-300 border border-gray-100 block">

                        <template x-if="product.discount_percentage">
                            <div class="absolute top-0 right-0 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded-bl-lg z-10" x-text="'-' + product.discount_percentage + '%'"></div>
                        </template>

                        <div class="aspect-[4/3] w-full overflow-hidden bg-gray-100">
                            <img
                                :src="product.image_url"
                                :alt="product.name"
                                class="w-full h-full object-cover transition duration-500 group-hover:scale-105"
                            >
                        </div>

                        <div class="p-4">
                            <h3 class="text-sm text-gray-700 font-medium truncate" x-text="product.name"></h3>

                            <div class="flex items-baseline mt-1 space-x-2">
                                <template x-if="product.discount_price">
                                    <p class="text-lg font-bold text-gray-900" x-text="'$' + product.discount_price.toFixed(2)"></p>
                                    <p class="text-sm font-light text-gray-400 line-through" x-text="'$' + product.price.toFixed(2)"></p>
                                </template>
                                <template x-if="!product.discount_price">
                                    <p class="text-lg font-bold text-gray-900" x-text="'$' + product.price.toFixed(2)"></p>
                                </template>
                            </div>

                            <template x-if="product.rating > 0">
                                <div class="flex items-center text-xs text-yellow-500 mt-1">
                                    <span x-text="'★'.repeat(Math.round(product.rating)) + '☆'.repeat(5 - Math.round(product.rating))"></span>
                                    <span class="text-gray-500 ml-1" x-text="'(' + product.reviews_count + ' Reviews)'"></span>
                                </div>
                            </template>
                        </div>
                    </a>
                </template>

                <template x-if="activeProducts.length === 0">
                    <p class="col-span-4 text-center text-gray-500">Produk tidak ditemukan di kategori ini.</p>
                </template>
            </div>
        </div>
    </section>
</x-guest-layout>