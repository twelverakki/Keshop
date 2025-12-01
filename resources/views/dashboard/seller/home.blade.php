<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight ">
                {{ __('Seller Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

                <div class="bg-white p-6 rounded-xl shadow-lg flex items-center justify-between transition transform hover:-translate-y-0.5 duration-200">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Total Revenue</p>
                        <p class="text-3xl font-extrabold text-[#456845] mt-1">Rp {{ number_format($stats['revenue'], 0, ',', '.') }}</p>
                    </div>
                    <div class="text-[#456845] bg-[#456845] bg-opacity-10 p-3 rounded-full">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m0-4h4m-4 0h4m-4 0V9m0 0V7m0 7v2m0 0V7m0 10a2 2 0 002 2h6a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6z"></path></svg>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg flex items-center justify-between transition transform hover:-translate-y-0.5 duration-200">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Items Sold</p>
                        <p class="text-3xl font-extrabold text-blue-600 mt-1">{{ $stats['items_sold'] }}</p>
                    </div>
                    <div class="text-blue-600 bg-blue-100 p-3 rounded-full">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg flex items-center justify-between transition transform hover:-translate-y-0.5 duration-200">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Active Products</p>
                        <p class="text-3xl font-extrabold text-purple-600 mt-1">{{ $stats['total_products'] }}</p>
                    </div>
                    <div class="text-purple-600 bg-purple-100 p-3 rounded-full">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 12h14M5 16h14M5 20h14"></path></svg>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-lg rounded-xl">
            <div class="p-6">
                <h3 class="font-bold text-xl text-gray-800 border-b pb-4 mb-4">
                    <span class="border-b-2 border-blue-500 pb-4">Recent Orders</span>
                </h3>

                @if($recentOrders->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left text-sm divide-y divide-gray-200">
                            <thead class="bg-gray-50 uppercase text-xs text-gray-600 tracking-wider">
                                <tr>
                                    <th class="p-3 font-semibold">Order ID</th>
                                    <th class="p-3 font-semibold">Product</th>
                                    <th class="p-3 font-semibold">Buyer</th>
                                    <th class="p-3 text-center font-semibold">Qty</th>
                                    <th class="p-3 text-center font-semibold">Status</th>
                                    <th class="p-3 text-right font-semibold">Total</th>
                                    <th class="p-3 font-semibold">Date</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($recentOrders as $item)
                                <tr class="hover:bg-gray-50 transition duration-100">

                                    <td class="p-3 font-mono text-gray-600">#{{ $item->order->id }}</td>

                                    <td class="p-3 flex items-center gap-3">
                                        <img
                                            src="{{ $item->product->image_url ?? 'https://via.placeholder.com/40' }}"
                                            alt="{{ $item->product->name }}"
                                            class="w-10 h-10 object-cover rounded-md border border-gray-200"
                                        >
                                        <span class="font-medium text-gray-800 truncate max-w-[150px]">{{ $item->product->name }}</span>
                                    </td>

                                    <td class="p-3 text-gray-700">{{ $item->order->user->name }}</td>

                                    <td class="p-3 text-center text-gray-600">{{ $item->quantity }}</td>

                                    <td class="p-3 text-center">
                                        @php
                                            $status = strtolower($item->order->status);
                                            $color = match ($status) {
                                                'completed' => 'bg-green-100 text-green-800',
                                                'pending' => 'bg-yellow-100 text-yellow-800',
                                                'processing' => 'bg-blue-100 text-blue-800',
                                                'cancelled' => 'bg-red-100 text-red-800',
                                                default => 'bg-gray-100 text-gray-600',
                                            };
                                        @endphp
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $color }}">
                                            {{ ucfirst($status) }}
                                        </span>
                                    </td>

                                    <td class="p-3 text-right font-bold text-gray-900">
                                        Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                    </td>

                                    <td class="p-3 text-gray-500 whitespace-nowrap">{{ $item->created_at->diffForHumans() }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6 text-right">
                        <a href="{{ route('seller.orders') }}" class="text-sm font-medium text-blue-600 hover:text-blue-800 transition">View All Orders &rarr;</a>
                    </div>
                @else
                    <p class="text-gray-500 py-4">No recent orders yet.</p>
                @endif
            </div>
        </div>
</x-app-layout>