<header class="bg-white shadow-sm sticky top-0 z-40" >
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-gray-800 tracking-wider">
                    K E S H O P
                </a>
            </div>

            <nav class="hidden sm:ml-6 sm:flex sm:space-x-8 items-center text-sm font-medium">
                <x-nav-link :href="route('home')" :active="request()->routeIs('home')">Home</x-nav-link>
                <x-nav-link :href="route('shop.index')" :active="request()->routeIs('shop*')">Shop</x-nav-link>
            </nav>

            <div class="flex items-center space-x-4">

                <div class="relative hidden lg:block">
                    <form action="{{ route('shop.index') }}" method="GET">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..." class="border-gray-300 focus:border-orange-500 focus:ring-orange-500 rounded-full text-sm py-2 pl-4 pr-10" />
                        <button type="submit" class="absolute right-0 top-0 mt-2 mr-2 text-gray-400 hover:text-gray-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </button>
                    </form>
                </div>

                @if(request()->routeIs('shop.index'))
                <button @click="filterModalOpen = true" class="lg:hidden p-2 text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-orange-500" title="Open Filters">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-4.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                </button>
                @endif

                <div class="flex items-center space-x-4">
                    @auth
                        @if(Auth::user()->role === 'buyer' || Auth::user()->role === 'seller')
                            <a href="{{ route('wishlist.index') }}" class="text-gray-400 hover:text-gray-600 relative hidden sm:block" title="Wishlist">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                <span class="absolute top-0 right-0 -mt-1 -mr-1 px-1 bg-red-500 text-white text-xs rounded-full">{{Auth::user()->wishlists()->count()}}</span>
                            </a>
                            <a href="{{ route('cart.index') }}" class="text-gray-400 hover:text-gray-600 relative hidden sm:block" title="Cart">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                <span class="absolute top-0 right-0 -mt-1 -mr-1 px-1 bg-orange-500 text-white text-xs rounded-full">{{Auth::user()->carts()->count()}}</span>
                            </a>

                            <div x-data="{ profileOpen: false }" class="relative hidden sm:block">
                            <button @click="profileOpen=!profileOpen" @click.outside="profileOpen = false"
                                class="flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-[#456845] focus:outline-none transition">
                                <div class="h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center text-[#456845] font-bold border border-gray-200">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <span class="hidden md:block">{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': profileOpen}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>

                            <div x-show="profileOpen"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95"
                                class="origin-top-right absolute right-0 mt-2 w-48 bg-white rounded-md shadow-xl py-1 z-50 border border-gray-100"
                                style="display: none;">

                                <div class="px-4 py-3 border-b border-gray-100 bg-gray-50">
                                    <p class="text-xs text-gray-500">Signed in as</p>
                                    <p class="text-sm font-bold text-gray-900 truncate">{{ Auth::user()->email }}</p>
                                </div>

                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#456845] transition">Edit Profile</a>

                                @if(Auth::user()->role === 'buyer')
                                <a href="{{ route('wishlist.index') }}" class="sm:hidden block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#456845] transition">My Wishlist</a>
                                <a href="{{ route('cart.index') }}" class="sm:hidden block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#456845] transition">My Cart</a>
                                <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#456845] transition">My History</a>
                                @else
                                <a href="{{ url('/dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#456845] transition">Dashboard</a>
                                @endif

                                <div class="border-t border-gray-100 my-1"></div>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition">
                                        Log Out
                                    </button>
                                </form>
                            </div>
                        </div>

                        @else
                            <a href="{{ url('/dashboard') }}"
                                class="text-sm font-medium text-white bg-[#456845] px-4 py-2 rounded hover:bg-[#2f442f] transition shadow-sm">
                                Dashboard
                            </a>
                        @endif
                    @else
                        <div class="items-center gap-4 hidden sm:flex">
                            <a href="{{ route('login') }}" class="text-sm font-medium text-gray-500 hover:text-[#456845]">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-sm font-medium text-white bg-[#456845] px-4 py-2 rounded-full hover:bg-[#2f442f] transition shadow-sm">Register</a>
                            @endif
                        </div>
                    @endauth
                </div>



                <button @click="mobileMenuOpen = !mobileMenuOpen" class="sm:hidden p-2 text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-orange-500" aria-controls="mobile-menu" aria-expanded="false">
                    <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                    <svg x-show="mobileMenuOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>

            </div>
        </div>
    </div>

    <div x-show="mobileMenuOpen" x-collapse x-cloak class="sm:hidden bg-white border-t border-gray-100 shadow-md absolute w-full z-30">

        @if(request()->routeIs('shop.index'))
        <div class="p-4 border-b border-gray-100">
            <form action="{{ route('shop.index') }}" method="GET">
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..." class="w-full pl-10 border-gray-200 bg-gray-50 rounded-lg text-sm focus:ring-[#76a576] focus:border-[#76a576] transition" />
                    <button type="submit" class="absolute left-0 top-0 mt-3 ml-3 text-gray-400 hover:text-gray-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                </div>
            </form>
        </div>
        @endif

        <div class="pt-2 pb-3 space-y-1">
            <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="block px-4 py-2 text-base font-medium">Home</x-nav-link>
            <x-nav-link :href="route('shop.index')" :active="request()->routeIs('shop*')" class="block px-4 py-2 text-base font-medium">Shop</x-nav-link>
        </div>

        <div class="pt-4 pb-3 border-t border-gray-100">
            @auth
            <div class="flex items-center px-4">
                </div>

            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-base font-medium text-gray-700 hover:bg-gray-50">Edit Profile</a>

                @if(Auth::user()->role === 'buyer')
                <a href="{{ route('wishlist.index') }}" class="block px-4 py-2 text-base font-medium text-gray-700 hover:bg-gray-50">Wishlist ({{Auth::user()->wishlists()->count()}})</a>
                <a href="{{ route('cart.index') }}" class="block px-4 py-2 text-base font-medium text-gray-700 hover:bg-gray-50">My Cart</a>
                <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-base font-medium text-gray-700 hover:bg-gray-50">My History</a>

                @elseif(Auth::user()->role === 'seller' || Auth::user()->role === 'admin')
                <a href="{{ url('/dashboard') }}" class="block px-4 py-2 text-base font-medium text-gray-700 hover:bg-gray-50">Dashboard</a>
                @endif

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 text-base font-medium text-red-600 hover:bg-red-50">
                        Log Out
                    </button>
                </form>
            </div>

            @else
            <div class="mt-3 space-y-1 px-4">
                <a href="{{ route('login') }}" class="block w-full text-center text-sm font-medium text-white bg-[#456845] px-4 py-2 rounded-full hover:bg-[#2f442f] transition shadow-sm">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="mt-2 block w-full text-center text-sm font-medium text-gray-500 bg-gray-100 px-4 py-2 rounded-full hover:bg-gray-200 transition">Register</a>
                @endif
            </div>
            @endauth
        </div>
    </div>
</header>