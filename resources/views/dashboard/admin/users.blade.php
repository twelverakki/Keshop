<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="pt-6 pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6 border border-green-200">
                    {{ session('success') }}
                </div>
            @endif

            {{-- <div class="bg-white p-4 rounded-lg shadow-sm mb-6 flex flex-col md:flex-row gap-4 justify-between">
                <form action="{{ route('admin.users') }}" method="GET" class="flex w-full md:w-auto gap-2">
                    <div class="relative w-full md:w-64">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name or email..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-[#76a576] focus:border-[#76a576] text-sm">
                        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>


                    <button type="submit" class="bg-[#456845] text-white px-4 py-2 rounded-lg hover:bg-hiyoucan-800 text-sm font-bold transition">Filter</button>
                </form>
            </div> --}}

            <div class="relative pb-6 hidden lg:block">
                <form action="{{ route('admin.users') }}" method="GET" class="flex justify-end">
                    <select name="role" class="border border-gray-300 rounded-full mr-2 text-sm focus:ring-[#76a576] focus:border-[#76a576] bg-white">
                        <option value="all">All</option>
                        <option value="seller" {{ request('role') == 'seller' ? 'selected' : '' }}>Seller</option>
                        <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>Buyer</option>
                    </select>
                    <div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..." class="border-gray-300 focus:border-orange-500 focus:ring-orange-500 ml-auto rounded-full text-sm py-2 pl-4 pr-10" />
                        <button class="absolute right-0 top-0 mt-2 mr-2 text-gray-400 hover:text-gray-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-gray-50 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-sm text-gray-600 uppercase border-b border-gray-200">
                                <th class="p-4">Name / Email</th>
                                <th class="p-4">Current Role</th>
                                <th class="p-4 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            @forelse($users as $user)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-4">
                                    <div class="flex items-center gap-3">
                                        <div class="h-8 w-8 rounded-full {{ $user->profile_color }} flex items-center justify-center text-white font-bold text-xs">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-gray-900">{{ $user->name }}</p>
                                            <p class="text-gray-500 text-xs">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                </td>

                                <td class="p-4 flex gap-2">
                                        @if($user->role == 'seller')
                                            <span class="px-2 py-1 rounded text-xs font-bold bg-purple-100 text-purple-700 border border-purple-200">Seller</span>
                                            @if($user->email_verified_at)
                                                <span class="text-green-600 font-bold text-xs flex items-center gap-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    Active
                                                </span>
                                            @else
                                                <span class="text-orange-500 font-bold text-xs flex items-center gap-1 animate-pulse">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    Pending | Review
                                                </span>
                                            @endif
                                        @else
                                            <span class="px-2 py-1 rounded text-xs font-bold bg-blue-100 text-blue-700 border border-blue-200">Buyer</span>
                                        @endif
                                </td>


                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div x-data="{ open: false }" @click.outside="open = false" class="relative inline-block text-left">

                                        <button
                                            @click="open=!open"
                                            type="button"
                                            class="text-gray-500 hover:text-gray-700 p-2 rounded-full hover:bg-gray-100 transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300"
                                            title="More Actions"
                                            aria-expanded="true"
                                            aria-haspopup="true"
                                        >
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 6a2 2 0 110-4 2 2 0 010 4zm0 6a2 2 0 110-4 2 2 0 010 4zm0 6a2 2 0 110-4 2 2 0 010 4z"></path></svg>
                                        </button>

                                        <div
                                            x-show="open"
                                            x-transition:enter="transition ease-out duration-100"
                                            x-transition:enter-start="transform opacity-0 scale-95"
                                            x-transition:enter-end="transform opacity-100 scale-100"
                                            x-transition:leave="transition ease-in duration-75"
                                            x-transition:leave-start="transform opacity-100 scale-100"
                                            x-transition:leave-end="transform opacity-0 scale-95"
                                            class="origin-top-right absolute right-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none z-20"
                                            role="menu" aria-orientation="vertical" aria-labelledby="menu-button"
                                            style="display: none;"
                                        >
                                            <div class="py-1" role="none">
                                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                                    class="text-gray-700 hover:bg-gray-100 hover:text-gray-900 px-4 py-2 text-sm flex items-center gap-2"
                                                    role="menuitem"
                                                    title="Edit Detail Pengguna"
                                                >
                                                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                                    Edit Info
                                                </a>
                                            </div>

                                            @if($user->role == 'seller')
                                            <div class="py-1" role="none">
                                                @if(!$user->email_verified_at)
                                                    <form action="{{ route('admin.users.verify', $user->id) }}" method="POST" role="none">
                                                        @csrf
                                                        <input type="hidden" name="action" value="approve">
                                                        <button type="submit"
                                                            class="text-green-600 hover:bg-gray-100 hover:text-green-800 w-full text-left px-4 py-2 text-sm flex items-center gap-2"
                                                            role="menuitem"
                                                            title="Set Akun Seller Terverifikasi"
                                                        >
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                            Approve Seller
                                                        </button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('admin.users.verify', $user->id) }}" method="POST" role="none">
                                                        @csrf
                                                        <input type="hidden" name="action" value="reject">
                                                        <button type="submit"
                                                            class="text-orange-600 hover:bg-gray-100 hover:text-orange-800 w-full text-left px-4 py-2 text-sm flex items-center gap-2"
                                                            role="menuitem"
                                                            title="Cabut Verifikasi/Suspend Seller"
                                                        >
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                                                            Suspend Seller
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                            @endif

                                            <div class="py-1" role="none">
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" role="none" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini secara permanen? Aksi ini tidak dapat dibatalkan.')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-600 hover:bg-red-50 hover:text-red-800 w-full text-left px-4 py-2 text-sm flex items-center gap-2"
                                                        role="menuitem"
                                                        title="Hapus Pengguna Permanen"
                                                    >
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
                                <td colspan="5" class="p-8 text-center text-gray-500">
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