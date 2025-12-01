<x-auth-layout>
    <div class="min-h-screen flex items-center justify-center py-12">

        <div
            class="max-w-md w-full z-10 overflow-hidden shadow-2xl rounded-xl p-8 border-none outline-none text-white text-[15px] bg-transparent backdrop-blur-sm shadow-[3px_3px_10px_rgba(0,0,0,1),-1px_-1px_6px_rgba(255,255,255,0.4)]"
        >

            <div class="text-center text-white">

                <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-blue-100/20 mb-6 border-4 border-blue-200/50">
                    <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2v5a2 2 0 01-2 2H9a2 2 0 01-2-2V9a2 2 0 012-2h6zM11 11h2v2h-2v-2z"></path>
                    </svg>
                </div>

                <h2 class="text-3xl font-extrabold mb-3">Lupa Password?</h2>

                <p class="mb-8 leading-relaxed text-gray-300">
                    Masukkan email yang terdaftar di akun Anda. Kami akan mengirimkan tautan *reset* password.
                </p>

                @if (session('status'))
                    <div class="text-green-300 bg-green-900/50 p-3 rounded-lg mb-4 font-medium text-sm">
                        {{ session('status') }}
                    </div>
                @endif


                <form method="POST" action="{{ route('password.email') }}" class="w-full">
                    @csrf

                    <div class="flex-[0_0_auto] flex flex-col w-full gap-[7px] relative text-white mb-[30px] px-2">
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            class="peer h-[45px] rounded-lg border-none outline-none px-[15px] text-white text-[15px] bg-transparent backdrop-blur-sm shadow-[3px_3px_10px_rgba(0,0,0,1),-1px_-1px_6px_rgba(255,255,255,0.4)] focus:shadow-[0_0_10px_rgba(255,255,255,0.5)]"
                            placeholder=""
                        />
                        <label
                            class="absolute left-[18px] top-[13px] text-[15px] transition-all"
                        >
                            Email
                        </label>
                    </div>


                    <div class="flex-[0_0_auto] w-full flex flex-col gap-[7px] relative text-white px-2 mt-6">
                        <button
                            type="submit"
                            class="h-[45px] rounded-lg border-none outline-none px-[7px] text-white text-[15px] backdrop-blur-sm shadow-[3px_3px_10px_rgba(0,0,0,1),-1px_-1px_6px_rgba(255,255,255,0.4)] font-bold transition hover:opacity-90 bg-blue-600"
                        >
                            Kirim Tautan Reset Password
                        </button>
                    </div>

                </form>

                <div class="mt-8 text-center w-full px-2">
                    <p class="text-md text-gray-300">
                        <a href="{{ route('login') }}" class="font-bold text-white hover:text-white/80 transition underline">
                            ← Kembali ke Login
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-auth-layout>