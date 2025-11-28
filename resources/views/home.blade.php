<x-guest-layout>
    {{-- Bagian 1: Hero Banner "Spring Collection" --}}
    <section class="relative bg-gray-100 py-16 md:py-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center">

            {{-- Konten Kiri (Teks) --}}
            <div class="md:w-1/2 z-10 space-y-4 md:space-y-6">
                <p class="text-sm font-semibold uppercase tracking-widest text-gray-500">Davici furniture 2020</p>
                <p class="text-xs font-semibold uppercase tracking-widest text-orange-500 border border-orange-500 inline-block px-2 py-1 rounded-full">New Arrivals</p>
                <h1 class="text-6xl md:text-8xl font-serif font-light leading-none text-gray-900">
                    Spring <br> Collection
                </h1>
                <a href="#" class="inline-block px-6 py-3 bg-orange-500 text-white font-medium rounded-md hover:bg-orange-600 transition duration-150 shadow-lg">
                    Shop now →
                </a>
            </div>

            {{-- Gambar & Dekorasi Kanan --}}
            <div class="md:w-1/2 mt-10 md:mt-0 relative flex justify-center">
                {{-- Gambar (Menggunakan gambar placeholder) --}}
                {{--  --}}
                <img src="https://via.placeholder.com/600x600?text=Spring+Collection+Chair" alt="Spring Collection Armchair" class="relative z-10 max-h-[500px] w-auto">

                {{-- Angka Dekorasi "01" --}}
                <span class="absolute inset-0 flex items-center justify-center text-[250px] font-bold text-white text-opacity-70 opacity-30 pointer-events-none -mt-16 md:-mr-16">
                    01
                </span>
            </div>
        </div>

        {{-- Indikator Slider Sederhana --}}
        <div class="absolute bottom-5 left-1/2 transform -translate-x-1/2 flex space-x-2">
            <span class="w-2 h-2 bg-orange-500 rounded-full"></span>
            <span class="w-2 h-2 bg-gray-300 rounded-full"></span>
            <span class="w-2 h-2 bg-gray-300 rounded-full"></span>
        </div>
    </section>

    {{-- Bagian 2: Shop by Categories --}}
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold mb-8">Shop by categories</h2>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                {{-- Kategori 1: All Categories (Kolom Kiri) --}}
                <div class="bg-gray-100 p-6 flex flex-col justify-between rounded-lg shadow-inner">
                    <div class="space-y-2">
                        <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        <p class="text-xl font-semibold">All Categories</p>
                        <p class="text-sm text-gray-500">200 + unique products</p>
                    </div>
                    <a href="#" class="text-orange-500 font-medium mt-4">ALL CATEGORIES →</a>
                </div>

                {{-- Kategori 2: Dining Chair --}}
                <div class="relative group overflow-hidden rounded-lg shadow-md">
                    <img src="https://via.placeholder.com/400x400?text=Dining+Chair" alt="Dining Chair" class="w-full h-full object-cover transition duration-300 group-hover:scale-105">
                    <div class="absolute inset-0 bg-black bg-opacity-10 flex items-end p-4">
                        <p class="text-white font-semibold text-lg">Dining Chair</p>
                    </div>
                </div>

                {{-- Kategori 3: Sofas --}}
                <div class="relative group overflow-hidden rounded-lg shadow-md">
                    <img src="https://via.placeholder.com/400x400?text=Sofas" alt="Sofas" class="w-full h-full object-cover transition duration-300 group-hover:scale-105">
                    <div class="absolute inset-0 bg-black bg-opacity-10 flex items-end p-4">
                        <p class="text-white font-semibold text-lg">Sofas</p>
                    </div>
                </div>

                {{-- Kategori 4: Table --}}
                <div class="relative group overflow-hidden rounded-lg shadow-md">
                    <img src="https://via.placeholder.com/400x400?text=Table" alt="Table" class="w-full h-full object-cover transition duration-300 group-hover:scale-105">
                    <div class="absolute inset-0 bg-black bg-opacity-10 flex items-end p-4">
                        <p class="text-white font-semibold text-lg">Table</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Bagian 3: Banner Promosi (Living Room & Dining Room) --}}
    <section class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Banner Kiri: Living Room --}}
                <div class="relative bg-cover bg-center h-96 rounded-lg shadow-xl overflow-hidden" style="background-image: url('https://via.placeholder.com/800x600?text=Living+Room+Promo');">
                    <div class="absolute inset-0 bg-black bg-opacity-30"></div>
                    <div class="relative p-10 flex flex-col justify-between h-full">
                        <p class="text-sm font-semibold text-white bg-orange-500 inline-block px-2 py-1 rounded-full">35 % OFF ALL ITEM</p>
                        <div>
                            <h3 class="text-4xl font-bold text-white mb-2">Living Room</h3>
                            <a href="#" class="inline-block px-6 py-2 bg-white text-gray-800 font-medium rounded-md hover:bg-gray-200 transition duration-150">Shop Now</a>
                        </div>
                    </div>
                </div>

                {{-- Banner Kanan: Dining Room --}}
                <div class="relative bg-cover bg-center h-96 rounded-lg shadow-xl overflow-hidden" style="background-image: url('https://via.placeholder.com/800x600?text=Dining+Room+Promo');">
                    <div class="absolute inset-0 bg-black bg-opacity-30"></div>
                    <div class="relative p-10 flex flex-col justify-between h-full">
                        <p class="text-sm font-semibold text-white bg-orange-500 inline-block px-2 py-1 rounded-full">30 % OFF ALL ITEM</p>
                        <div>
                            <h3 class="text-4xl font-bold text-white mb-2">Dining Room</h3>
                            <a href="#" class="inline-block px-6 py-2 bg-white text-gray-800 font-medium rounded-md hover:bg-gray-200 transition duration-150">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Bagian 4: Hot Products --}}
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold mb-8">Hot Products</h2>

            {{-- Navigasi Tab (Sederhana) --}}
            <div class="flex space-x-6 border-b border-gray-200 mb-8 text-sm font-medium">
                <button class="text-orange-600 border-b-2 border-orange-600 pb-2">LATEST PRODUCTS</button>
                <button class="text-gray-500 hover:text-gray-700 pb-2">TOP RATING</button>
                <button class="text-gray-500 hover:text-gray-700 pb-2">BEST SELLERS</button>
                <button class="ml-auto text-orange-500 hover:text-orange-700 pb-2">All products →</button>
            </div>

            {{-- Daftar Produk (Hanya 4 item pertama untuk contoh) --}}
            <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-8">

                {{-- Item Produk 1 (Contoh: Sofa Abu-abu) --}}
                <div class="group relative bg-white rounded-lg overflow-hidden">
                    <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden bg-gray-200">
                        <img src="https://via.placeholder.com/400x300?text=Sofa+Crate" alt="Crate Peobied Seat" class="w-full h-full object-cover group-hover:opacity-75">
                    </div>
                    <div class="p-4">
                        <h3 class="mt-1 text-sm text-gray-700">Crate Peobied Seat</h3>
                        <p class="mt-1 text-lg font-medium text-gray-900">$100.00</p>
                        <div class="flex items-center text-xs text-yellow-500 mt-1">
                            <span>★★★★☆</span>
                            <span class="text-gray-500 ml-1">(24 Reviews)</span>
                        </div>
                    </div>
                </div>

                {{-- Item Produk 2 (Contoh: Kursi Diskon dengan Timer) --}}
                <div class="group relative bg-white rounded-lg overflow-hidden border border-orange-100">
                    <div class="absolute top-0 right-0 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-bl-lg">
                        -20%
                    </div>
                    <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden bg-gray-200">
                        <img src="https://via.placeholder.com/400x300?text=Erforwood+Decorative" alt="Erforwood Decorative 2" class="w-full h-full object-cover group-hover:opacity-75">
                    </div>
                    <div class="p-4">
                        <h3 class="mt-1 text-sm text-gray-700">Erforwood Decorative 2</h3>
                        <div class="flex items-baseline mt-1">
                            <p class="text-lg font-medium text-gray-900">$25.00</p>
                            <p class="text-sm font-light text-gray-400 line-through ml-2">$30.00</p>
                        </div>
                        {{-- Timer Sederhana (Contoh teks) --}}
                        <div class="bg-orange-50 border border-orange-200 p-2 mt-3 rounded-md text-center text-sm font-medium">
                            <span class="text-orange-600">Ends in: </span>
                            <span class="text-gray-800">60d : 08h : 37m : 20s</span>
                        </div>
                    </div>
                </div>

                {{-- Item Produk 3 (Contoh: Kursi Santai) --}}
                <div class="group relative bg-white rounded-lg overflow-hidden">
                    <div class="absolute top-0 right-0 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-bl-lg">
                        -10%
                    </div>
                    <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden bg-gray-200">
                        <img src="https://via.placeholder.com/400x300?text=Argus+Globes+3" alt="Argus Globes 3" class="w-full h-full object-cover group-hover:opacity-75">
                    </div>
                    <div class="p-4">
                        <h3 class="mt-1 text-sm text-gray-700">Argus Globes 3</h3>
                        <div class="flex items-baseline mt-1">
                            <p class="text-lg font-medium text-gray-900">$20.00</p>
                            <p class="text-sm font-light text-gray-400 line-through ml-2">$22.00</p>
                        </div>
                    </div>
                </div>

                {{-- Item Produk 4 (Contoh: Kursi Krem) --}}
                <div class="group relative bg-white rounded-lg overflow-hidden">
                    <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden bg-gray-200">
                        <img src="https://via.placeholder.com/400x300?text=Argus+Globes+5" alt="Argus Globes 5" class="w-full h-full object-cover group-hover:opacity-75">
                    </div>
                    <div class="p-4">
                        <h3 class="mt-1 text-sm text-gray-700">Argus Globes 5</h3>
                        <p class="mt-1 text-lg font-medium text-gray-900">$18.00</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

</x-guest-layout>