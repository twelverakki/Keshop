<header class="bg-white shadow-sm sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            {{-- Logo --}}
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-gray-800 tracking-wider">
                    K E S H O P
                </a>
            </div>

            <nav class="hidden sm:ml-6 sm:flex sm:space-x-8 items-center text-sm font-medium">
                <x-nav-link :href="route('home')" :active="request()->routeIs('home')">Home</x-nav-link>
                <x-nav-link :href="route('shop.index')" :active="request()->routeIs('shop')">Shop</x-nav-link>
            </nav>

            <div class="flex items-center space-x-4">
                <div class="relative hidden lg:block">
                    <input type="text" placeholder="Search..." class="border-gray-300 focus:border-orange-500 focus:ring-orange-500 rounded-full text-sm py-2 pl-4 pr-10" />
                    <button class="absolute right-0 top-0 mt-2 mr-2 text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                </div>

                <div class="flex items-center space-x-4">
                    {{-- <a href="#" class="text-gray-400 hover:text-gray-600" title="Login">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3v-1m3-4a4 4 0 100-8 4 4 0 000 8z"></path></svg>
                    </a> --}}
                    {{-- @auth
                    <a href="#" class="text-gray-400 hover:text-gray-600 relative" title="Wishlist">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        <span class="absolute top-0 right-0 -mt-1 -mr-1 px-1 bg-red-500 text-white text-xs rounded-full">{{Auth::user()->cart()->count()}}</span>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-600 relative" title="Cart">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        <span class="absolute top-0 right-0 -mt-1 -mr-1 px-1 bg-orange-500 text-white text-xs rounded-full">1</span>
                    </a>
                    @endauth --}}

                </a>

                @if (Route::has('login'))
                    @auth
                        @if(Auth::user()->role === 'buyer' || Auth::user()->role === 'user')

                            <div class="relative">
                                <button @click="profileOpen = !profileOpen" @click.outside="profileOpen = false" class="flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-hiyoucan-700 focus:outline-none transition">
                                    <div class="h-8 w-8 rounded-full bg-hiyoucan-100 flex items-center justify-center text-hiyoucan-700 font-bold border border-hiyoucan-200">
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
                                     class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-xl py-1 z-50 border border-gray-100"
                                     style="display: none;">

                                    <div class="px-4 py-3 border-b border-gray-100 bg-gray-50">
                                        <p class="text-xs text-gray-500">Signed in as</p>
                                        <p class="text-sm font-bold text-hiyoucan-900 truncate">{{ Auth::user()->email }}</p>
                                    </div>

                                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-hiyoucan-50 hover:text-hiyoucan-700 transition">Edit Profile</a>
                                    <a href="{{ route('wishlist.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-hiyoucan-50 hover:text-hiyoucan-700 transition">My Wishlist</a>
                                    <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-hiyoucan-50 hover:text-hiyoucan-700 transition">My Orders</a>

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
                            <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-white bg-hiyoucan-700 px-4 py-2 rounded hover:bg-hiyoucan-800 transition shadow-sm">Dashboard</a>
                        @endif

                    @else
                        <div class="flex items-center gap-4">
                            <a href="{{ route('login') }}" class="text-sm font-medium text-gray-500 hover:text-hiyoucan-700">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-sm font-medium text-white bg-hiyoucan-700 px-4 py-2 rounded-full hover:bg-hiyoucan-800 transition shadow-sm">Register</a>
                            @endif
                        </div>
                    @endauth
                @endif
                </div>
            </div>
        </div>
    </div>
</header>