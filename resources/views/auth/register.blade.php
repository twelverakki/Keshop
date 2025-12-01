<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - Hiyoucan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font- antialiased text-gray-900 bg-white">
    <section
			id="kontak"
			class="h-[100vh] bg-cover px-20"
		>
            <div class="fixed inset-0" style="z-index: 0;">
                <img src="{{ asset('images/bg-l.jpg') }}" alt="Dark Leaves Background"
                    class="w-full h-full object-cover">

                <div class="absolute inset-0 bg-black/50" style="z-index: 1;"></div>
            </div>

			<div class="grid md:grid-cols-2 h-full place-items-center">
				<div class="flex flex-col pb-16 max-md:mt-15 max-md:mb-10 z-10 text-white">
					<div class="flex-shrink-0 flex items-center mb-4">
                        <a href="{{ route('home') }}" class="text-2xl font-bold tracking-wider">
                            K E S H O P
                        </a>
                    </div>
					<h2 class="mt-6 text-7xl font-bold">Create an account</h2>
                    <p class="mt-2 text-sm">Start your journey with us today.</p>
				</div>

                <form method="POST" action="{{ route('register') }}" class="flex flex-wrap z-10">
                    @csrf

                    <div
                        class="flex-[0_0_auto] flex flex-col w-full gap-[7px] relative text-white mb-[30px] px-2"
                    >
                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            class="peer h-[45px] rounded-md border-none outline-none px-[7px] text-white text-[15px] bg-transparent backdrop-blur-sm shadow-[3px_3px_10px_rgba(0,0,0,1),-1px_-1px_6px_rgba(255,255,255,0.4)] focus:shadow-[3px_3px_10px_rgba(0,0,0,1),-1px_-1px_6px_rgba(255,255,255,0.4),inset_3px_3px_10px_rgba(0,0,0,1),inset_-1px_-1px_6px_rgba(255,255,255,0.4)]"
                            placeholder=""
                        />
                        <label
                            class="absolute left-[18px] top-[13px] text-[15px] transition-all peer-focus:-translate-y-[35px] peer-focus:pl-[2px] peer-valid:-translate-y-[35px] peer-valid:pl-[2px]"
                        >
                            Nama Lengkap
                        </label>
                        <x-input-error :messages="$errors->get('name')" class="mt-1" />
                    </div>

                    <div
                        class="flex-[0_0_auto] flex flex-col w-full gap-[7px] relative text-white mb-[30px] px-2"
                    >
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            class="peer h-[45px] rounded-md border-none outline-none px-[7px] text-white text-[15px] bg-transparent backdrop-blur-sm shadow-[3px_3px_10px_rgba(0,0,0,1),-1px_-1px_6px_rgba(255,255,255,0.4)] focus:shadow-[3px_3px_10px_rgba(0,0,0,1),-1px_-1px_6px_rgba(255,255,255,0.4),inset_3px_3px_10px_rgba(0,0,0,1),inset_-1px_-1px_6px_rgba(255,255,255,0.4)]"
                            placeholder=""
                        />
                        <label
                            class="absolute left-[18px] top-[13px] text-[15px] transition-all peer-focus:-translate-y-[35px] peer-focus:pl-[2px] peer-valid:-translate-y-[35px] peer-valid:pl-[2px]"
                        >
                            Email
                        </label>
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <div
                        class="flex-[0_0_auto] w-full flex flex-col gap-[7px] relative text-white mb-[30px] px-2"
                    >
                        <input
                            type="password"
                            name="password"
                            required
                            class="peer h-[45px] rounded-md border-none outline-none px-[7px] text-white text-[15px] bg-transparent backdrop-blur-sm shadow-[3px_3px_10px_rgba(0,0,0,1),-1px_-1px_6px_rgba(255,255,255,0.4)] focus:shadow-[3px_3px_10px_rgba(0,0,0,1),-1px_-1px_6px_rgba(255,255,255,0.4),inset_3px_3px_10px_rgba(0,0,0,1),inset_-1px_-1px_6px_rgba(255,255,255,0.4)]"
                            placeholder=" "
                        />
                        <label
                            class="absolute left-[18px] top-[13px] text-[15px] transition-all peer-focus:-translate-y-[35px] peer-focus:pl-[2px] peer-valid:-translate-y-[35px] peer-valid:pl-[2px]"
                        >
                            Password
                        </label>
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    <div
                        class="flex-[0_0_auto] w-full flex flex-col gap-[7px] relative text-white mb-[30px] px-2"
                    >
                        <input
                            type="password"
                            name="password_confirmation"
                            required
                            class="peer h-[45px] rounded-md border-none outline-none px-[7px] text-white text-[15px] bg-transparent backdrop-blur-sm shadow-[3px_3px_10px_rgba(0,0,0,1),-1px_-1px_6px_rgba(255,255,255,0.4)] focus:shadow-[3px_3px_10px_rgba(0,0,0,1),-1px_-1px_6px_rgba(255,255,255,0.4),inset_3px_3px_10px_rgba(0,0,0,1),inset_-1px_-1px_6px_rgba(255,255,255,0.4)]"
                            placeholder=" "
                        />
                        <label
                            class="absolute left-[18px] top-[13px] text-[15px] transition-all peer-focus:-translate-y-[35px] peer-focus:pl-[2px] peer-valid:-translate-y-[35px] peer-valid:pl-[2px]"
                        >
                            Konfirmasi Password
                        </label>
                    </div>

                    <div class="flex-[0_0_auto] w-full flex flex-col gap-[7px] relative text-white mb-[30px] px-2">
                        <label class="block text-sm font-medium mb-2">Saya ingin bergabung sebagai:</label>
                        <div class="grid grid-cols-2 gap-3">

                            {{-- Pilihan Buyer --}}
                            <label class="border rounded-lg p-3 cursor-pointer hover:bg-white/10 flex items-center justify-center gap-2 has-[:checked]:border-white has-[:checked]:bg-white/20 transition backdrop-blur-sm shadow-[3px_3px_10px_rgba(0,0,0,1),-1px_-1px_6px_rgba(255,255,255,0.4)]">
                                <input type="radio" name="role" value="buyer" class="text-white focus:ring-white bg-transparent" {{ old('role') == 'buyer' ? 'checked' : '' }} >
                                <span class="text-sm font-medium">Pembeli</span>
                            </label>

                            {{-- Pilihan Seller --}}
                            <label class="border rounded-lg p-3 cursor-pointer hover:bg-white/10 flex items-center justify-center gap-2 has-[:checked]:border-white has-[:checked]:bg-white/20 transition backdrop-blur-sm shadow-[3px_3px_10px_rgba(0,0,0,1),-1px_-1px_6px_rgba(255,255,255,0.4)]">
                                <input type="radio" name="role" value="seller" class="text-white focus:ring-white bg-transparent" {{ old('role') == 'seller' ? 'checked' : '' }}>
                                <span class="text-sm font-medium">Penjual</span>
                            </label>

                        </div>
                        <x-input-error :messages="$errors->get('role')" class="mt-1" />
                    </div>

                    <div
                        class="flex-[0_0_auto] w-full flex flex-col gap-[7px] relative text-white px-2"
                    >
                        <button
                            type="submit"
                            class="h-[45px] rounded-md border-none outline-none px-[7px] text-white text-[15px] backdrop-blur-sm focus:shadow-[3px_3px_10px_rgba(0,0,0,1),-1px_-1px_6px_rgba(255,255,255,0.4)] shadow-[3px_3px_10px_rgba(0,0,0,1),-1px_-1px_6px_rgba(255,255,255,0.4),inset_3px_3px_10px_rgba(0,0,0,1),inset_-1px_-1px_6px_rgba(255,255,255,0.4)] font-bold transition hover:opacity-90"
                        >
                            Buat Akun
                        </button>
                    </div>

                    <div class="mt-8 text-center w-full">
                        <p class="text-md text-white">
                            Already have an account?
                            <a href="{{ route('login') }}" class="font-bold text-[#456845] hover:text-hiyoucan-600 transition">Log in</a>
                        </p>
                    </div>
                </form>


			</div>
		</section>
</body>
</html>