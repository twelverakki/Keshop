<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-6">

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-6 font-medium border border-green-200 shadow-md">{{ session('success') }}</div>
        @endif

        <div class="flex justify-between items-center mb-6 p-4 bg-white shadow-lg rounded-xl border border-gray-100">
            <div class="flex items-center space-x-4">
                <p class="text-sm font-semibold text-gray-700">Filter Role:</p>
                <select onchange="window.location.href=this.value" class="border-gray-300 rounded-lg text-sm focus:ring-gray-500 focus:border-gray-500">
                    <option value="{{ route('admin.users', Arr::except(request()->all(), 'role')) }}" @selected(!request('role'))>All Users</option>
                    <option value="{{ route('admin.users', array_merge(request()->all(), ['role' => 'seller'])) }}" @selected(request('role') == 'seller')>Sellers</option>
                    <option value="{{ route('admin.users', array_merge(request()->all(), ['role' => 'buyer'])) }}" @selected(request('role') == 'buyer')>Buyers</option>
                </select>
            </div>

            <form action="{{ route('shop.index') }}" method="GET" class="relative">
                <input type="hidden" name="role" value="{{ request('role') }}">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..." class="border-gray-300 focus:border-orange-500 focus:ring-orange-500 rounded-full text-sm py-2 pl-4 pr-10" />
                <button type="submit" class="absolute right-0 top-0 mt-2 mr-2 text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </button>
            </form>
        </div>


        <div class="bg-white overflow-hidden shadow-2xl rounded-xl border border-gray-100">
            <div class="p-0 text-gray-900 overflow-x-auto">
                <table class="min-w-full text-left border-collapse">
                    <thead class="bg-gray-50">
                        <tr class="text-sm text-gray-600 uppercase border-b border-gray-200 tracking-wider">
                            <th class="p-4 w-2/5">Name / Email</th>
                            <th class="p-4">Role</th>
                            <th class="p-4 w-1/5">Verification Status</th>
                            <th class="p-4 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-100">
                        @forelse($users as $user)
                        <tr class="hover:bg-gray-50 transition duration-150">

                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-700 font-bold text-base">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-900">{{ $user->name }}</p>
                                        <p class="text-gray-500 text-xs">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </td>

                            <td class="p-4">
                                @php
                                    $roleColor = match ($user->role) {
                                        'admin' => 'bg-red-100 text-red-700 border-red-200',
                                        'seller' => 'bg-purple-100 text-purple-700 border-purple-200',
                                        default => 'bg-blue-100 text-blue-700 border-blue-200',
                                    };
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $roleColor }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>

                            <td class="p-4">
                                @if($user->role == 'seller')
                                    @if($user->email_verified_at)
                                        <span class="text-green-600 font-semibold text-xs flex items-center gap-1">
                                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2C6.47 2 2 6.47 2 12s4.47 10 10 10 10-4.47 10-10S17.53 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                                            Verified / Active
                                        </span>
                                    @else
                                        <span class="text-orange-600 font-semibold text-xs flex items-center gap-1 animate-pulse">
                                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M11 15h2v2h-2zm0-8h2v6h-2zm0-4c-4.41 0-8 3.59-8 8s3.59 8 8 8 8-3.59 8-8-3.59-8-8-8zm0 14c-3.31 0-6-2.69-6-6s2.69-6 6-6 6 2.69 6 6-2.69 6-6 6z"/></svg>
                                            Pending Review
                                        </span>
                                    @endif
                                @else
                                    <span class="text-gray-400 text-xs">N/A</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-right">
                                <div x-data="{ open: false }" @click.outside="open = false" class="relative inline-block text-left">

                                    <button @click="open=!open" type="button" class="text-gray-500 hover:text-gray-700 p-2 rounded-full hover:bg-gray-100 transition focus:outline-none">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 6a2 2 0 110-4 2 2 0 010 4zm0 6a2 2 0 110-4 2 2 0 010 4zm0 6a2 2 0 110-4 2 2 0 010 4z"></path></svg>
                                    </button>

                                    <div x-show="open"
                                         x-transition:enter="transition ease-out duration-100"
                                         x-transition:enter-start="transform opacity-0 scale-95"
                                         x-transition:enter-end="transform opacity-100 scale-100"
                                         x-transition:leave="transition ease-in duration-75"
                                         x-transition:leave-start="transform opacity-100 scale-100"
                                         x-transition:leave-end="transform opacity-0 scale-95"
                                         class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 z-20"
                                         style="display: none;">

                                        <div class="py-1">
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="text-gray-700 hover:bg-gray-100 hover:text-gray-900 px-4 py-2 text-sm flex items-center gap-2">
                                                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                                Edit Info
                                            </a>
                                        </div>

                                        @if($user->role == 'seller')
                                        <div class="py-1">
                                            @if(!$user->email_verified_at)
                                                <form action="{{ route('admin.users.verify', $user->id) }}" method="POST" class="block">
                                                    @csrf <input type="hidden" name="action" value="approve">
                                                    <button type="submit" class="text-green-600 hover:bg-green-50 w-full text-left px-4 py-2 text-sm flex items-center gap-2">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Approve Seller
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('admin.users.verify', $user->id) }}" method="POST" class="block">
                                                    @csrf <input type="hidden" name="action" value="reject">
                                                    <button type="submit" class="text-orange-600 hover:bg-orange-50 w-full text-left px-4 py-2 text-sm flex items-center gap-2">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg> Suspend Seller
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                        @endif

                                        <div class="py-1">
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('DELETE: Are you sure?')" class="block">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:bg-red-50 w-full text-left px-4 py-2 text-sm flex items-center gap-2">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    Delete User
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-gray-500 font-medium bg-gray-50 rounded-lg">
                                No users found matching your criteria.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </div>
</div>
</x-app-layout>