<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">Edit User Info</h2>
    </x-slot>

    <div class="py-10 bg-gray-50">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl rounded-xl p-8 border border-gray-100">

                <h3 class="text-xl font-bold text-gray-900 mb-6 border-b pb-4">
                    Update Account Details
                </h3>

                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-6">

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Name</label>
                                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-600 focus:border-blue-600 transition duration-150" required>
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-600 focus:border-blue-600 transition duration-150" required>
                            </div>
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">New Password (Optional)</label>
                            <input type="password" id="password" name="password"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-600 focus:border-blue-600 transition duration-150">
                            <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengganti password user.</p>
                        </div>

                        <div class="pt-4 border-t border-gray-100 mt-4">
                            <label class="block text-base font-bold text-gray-800 mb-3">Tetapkan Role Sebagai:</label>

                            <div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                                    <label class="border-2 rounded-xl p-4 cursor-pointer hover:bg-blue-50/50 flex items-center gap-4 has-[:checked]:border-blue-600 has-[:checked]:bg-blue-50 transition duration-200">
                                        <input type="radio" name="role" value="buyer"
                                            class="text-blue-600 focus:ring-blue-600 h-5 w-5"
                                            {{ old('role', $user->role) == 'buyer' ? 'checked' : '' }}>
                                        <div>
                                            <span class="text-lg font-bold text-gray-800 block">Buyer</span>
                                            <span class="text-sm text-gray-500">Mampu berbelanja dan membuat pesanan.</span>
                                        </div>
                                    </label>

                                    <label class="border-2 rounded-xl p-4 cursor-pointer hover:bg-blue-50/50 flex items-center gap-4 has-[:checked]:border-blue-600 has-[:checked]:bg-blue-50 transition duration-200">
                                        <input type="radio" name="role" value="seller"
                                            class="text-blue-600 focus:ring-blue-600 h-5 w-5"
                                            {{ old('role', $user->role) == 'seller' ? 'checked' : '' }}>
                                        <div>
                                            <span class="text-lg font-bold text-gray-800 block">Seller</span>
                                            <span class="text-sm text-gray-500">Mampu menjual produk dan mengelola toko.</span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>


                        <div class="flex justify-end gap-3 pt-6 border-t border-gray-100 mt-6">
                            <a href="{{ route('admin.users') }}" class="bg-gray-200 text-gray-700 px-5 py-2 rounded-lg font-medium hover:bg-gray-300 transition">Cancel</a>
                            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-blue-700 transition shadow-md">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>