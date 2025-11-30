<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight ">
                {{ __('Seller Dashboard') }}
            </h2>
            <div class="space-x-2">
                <a href="{{ route('seller.store.edit') }}" class="bg-purple-600 text-white px-4 py-2 rounded text-sm hover:bg-purple-700">Store Profile</a>

                <a href="{{ route('seller.products.index') }}" class="bg-[#456845] text-white px-4 py-2 rounded text-sm hover:bg-hiyoucan-800">My Products</a>
                <a href="{{ route('seller.orders') }}" class="bg-gray-700 text-white px-4 py-2 rounded text-sm hover:bg-gray-800">Incoming Orders</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-[#76a576]">
                    <p class="text-gray-500 text-sm">Total Revenue</p>
                    <p class="text-2xl font-bold text-gray-800">Rp {{ number_format($stats['revenue'], 0, ',', '.') }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-blue-500">
                    <p class="text-gray-500 text-sm">Items Sold</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $stats['items_sold'] }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-purple-500">
                    <p class="text-gray-500 text-sm">Active Products</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $stats['total_products'] }}</p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="font-bold text-lg mb-4">Recent Orders</h3>
                    @if($recentOrders->count() > 0)
                        <table class="w-full text-left text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="p-3">Order ID</th>
                                    <th class="p-3">Product</th>
                                    <th class="p-3">Buyer</th>
                                    <th class="p-3">Qty</th>
                                    <th class="p-3">Total</th>
                                    <th class="p-3">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentOrders as $item)
                                <tr class="border-b">
                                    <td class="p-3 font-mono">#{{ $item->order->id }}</td>
                                    <td class="p-3">{{ $item->product->name }}</td>
                                    <td class="p-3">{{ $item->order->user->name }}</td>
                                    <td class="p-3">{{ $item->quantity }}</td>
                                    <td class="p-3 font-bold">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                                    <td class="p-3 text-gray-500">{{ $item->created_at->diffForHumans() }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4 text-right">
                            <a href="{{ route('seller.orders') }}" class="text-hiyoucan-600 text-sm hover:underline">View All Orders &rarr;</a>
                        </div>
                    @else
                        <p class="text-gray-500">No orders yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>