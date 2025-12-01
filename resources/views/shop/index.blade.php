<x-guest-layout :categories="$categories">
    <section class="relative h-96 bg-[url('images/bg-l.jpg')] overflow-hidden mb-12">
        <div class="absolute inset-0" style="z-index: 0;">
            <img src="{{ asset('images/bg-l.jpg') }}" alt="Dark Leaves Background"
                class="w-full h-full object-cover">

            <div class="absolute inset-0 bg-black/50" style="z-index: 1;"></div>
        </div>
        <div class="relative max-w-7xl mx-auto h-full flex flex-col justify-center px-4 sm:px-6 lg:px-8 text-white">
            <h1 class="text-6xl font-extrabold tracking-tight">SHOP</h1>
            <p class="text-3xl font-light mt-2">Give All You Need</p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16">
        <div class="flex flex-col lg:flex-row gap-10">

            <div class="lg:w-1/4">
                @include('shop.sidebar-filters', ['categories'])
            </div>

            <div class="lg:w-3/4">
                <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                    @forelse ($products as $index => $product)
                        @include('shop.product-card', ['product' => $product])
                    @empty
                        <p class="col-span-3 text-center text-gray-500">Produk tidak ditemukan.</p>
                    @endforelse
                </div>

                <div class="mt-10">
                    {{$products->links()}}
                </div>
            </div>
        </div>
    </div>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-20">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Explore our recommendations</h2>
            <div class="flex space-x-2 text-gray-400">
                <button class="hover:text-gray-600 transition"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg></button>
                <button class="hover:text-gray-600 transition"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg></button>
            </div>
        </div>

        {{-- <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
                @foreach ($recommendations as $product)
                @include('shop.product-card', ['product' => $product])
                @endforeach
        </div> --}}
    </section>
</x-guest-layout>