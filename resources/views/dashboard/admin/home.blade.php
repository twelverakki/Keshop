<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <div class="pb-12 pt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="font-bold text-lg mb-4">Welcome, Admin!</h3>
                    <p>Anda memiliki akses penuh untuk mengelola pengguna, kategori, dan memantau transaksi platform Hiyoucan.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">

                <div class="bg-white rounded-lg p-6 shadow-md border-b-4 border-green-500 flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Total Revenue</p>
                        <p class="text-3xl font-extrabold text-[#456845] mt-1">Rp {{ number_format($stats['total_sales'], 0, ',', '.') }}</p>
                    </div>
                    <div class="text-green-500 bg-green-50 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-8 h-8" viewBox="0 0 16 16">
                            <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73z"/>
                        </svg>
                    </div>
                </div>

                <div class="bg-white rounded-lg p-6 shadow-md border-b-4 border-blue-500 flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Total Orders</p>
                        <p class="text-3xl font-extrabold text-gray-900 mt-1">{{ $stats['total_orders'] }}</p>
                    </div>
                    <div class="text-blue-500 bg-blue-50 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-8 h-8" viewBox="0 0 16 16">
                            <path d="M4 11a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0zm6-4a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0zM7 9a1 1 0 0 1 2 0v3a1 1 0 1 1-2 0z"/>
                            <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z"/>
                            <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z"/>
                        </svg>
                    </div>
                </div>

                <div class="bg-white rounded-lg p-6 shadow-md border-b-4 border-purple-500 flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Registered Users</p>
                        <p class="text-3xl font-extrabold text-gray-900 mt-1">{{ $stats['total_users'] }}</p>
                    </div>
                    <div class="text-purple-500 bg-purple-50 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg"  fill="currentColor" class="w-8 h-8" viewBox="0 0 16 16">
                            <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4"/>
                        </svg>
                    </div>
                </div>

                <div class="bg-white rounded-lg p-6 shadow-md border-b-4 {{ $stats['pending_sellers'] > 0 ? 'border-red-500' : 'border-green-500' }} flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Pending Sellers</p>
                        <p class="text-3xl font-extrabold text-gray-900 mt-1">{{ $stats['pending_sellers'] }}</p>
                        @if($stats['pending_sellers'] > 0)
                            <a href="{{ route('admin.users') }}" class="text-xs text-red-500 hover:underline mt-2 inline-block">Review Now &rarr;</a>
                        @else
                            <p class="text-xs text-gray-400 mt-2">All sellers are approved!</p>
                        @endif
                    </div>
                    <div class="{{ $stats['pending_sellers'] > 0 ? 'text-red-500 bg-red-50' : 'text-green-500 bg-green-50' }} p-3 rounded-full">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>