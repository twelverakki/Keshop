<header class="bg-white shadow-sm sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            {{-- Logo --}}
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-gray-800 tracking-wider">
                    D A V I C I
                </a>
            </div>

            {{-- Navigasi Utama --}}
            <nav class="hidden sm:ml-6 sm:flex sm:space-x-8 items-center text-sm font-medium">
                <x-nav-link :href="route('home')" :active="request()->routeIs('home')">Home</x-nav-link>
                <x-nav-link :href="route('shop.index')" :active="request()->routeIs('shop')">Shop</x-nav-link>
                {{-- <a href="{{ route('home') }}" class="border-b-2 border-orange-500 text-orange-600 px-1 pt-1">Home</a>
                <a href="{{ route('shop') }}" class="border-b-2 border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 px-1 pt-1">Shop</a>
                <a href="#" class="border-b-2 border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 px-1 pt-1">Blog</a> --}}
            </nav>

            {{-- Search & Ikon Aksi --}}
            <div class="flex items-center space-x-4">
                {{-- Search Bar Sederhana --}}
                <div class="relative hidden lg:block">
                    <input type="text" placeholder="Search..." class="border-gray-300 focus:border-orange-500 focus:ring-orange-500 rounded-full text-sm py-2 pl-4 pr-10" />
                    <button class="absolute right-0 top-0 mt-2 mr-2 text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                </div>

                {{-- Ikon Aksi (Login, Wishlist, Keranjang) --}}
                <div class="flex items-center space-x-4">
                    <a href="#" class="text-gray-400 hover:text-gray-600" title="Login">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3v-1m3-4a4 4 0 100-8 4 4 0 000 8z"></path></svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-600 relative" title="Wishlist">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        <span class="absolute top-0 right-0 -mt-1 -mr-1 px-1 bg-red-500 text-white text-xs rounded-full">2</span>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-600 relative" title="Cart">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        <span class="absolute top-0 right-0 -mt-1 -mr-1 px-1 bg-orange-500 text-white text-xs rounded-full">1</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>