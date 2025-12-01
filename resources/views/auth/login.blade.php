<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Keshop</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .wrapper {
            cursor: pointer;
            color: #fff;
        }

        .wrapper svg {
            overflow: visible;
            margin-bottom: -4px;
        }

        .path {
            fill: none;
            stroke: black;
            stroke-width: 6;
            stroke-linecap: round;
            stroke-linejoin: round;
            transition: stroke-dasharray 0.5s ease, stroke-dashoffset 0.5s ease;
            stroke-dasharray: 241 9999999;
            stroke-dashoffset: 0;
        }

        .wrapper input:checked ~ svg .path {
            stroke-dasharray: 70.5096664428711 9999999;
            stroke-dashoffset: -262.2723388671875;
        }

    </style>
</head>
<body class="font-sans antialiased text-gray-900 bg-white">

    <section
			id="kontak"
			class="md:h-[100vh] bg-cover p-6 py-12 md:px-20 md:py-0"
		>
            <div class="fixed inset-0" style="z-index: 0;">
                <img src="{{ asset('images/bg-l.jpg') }}" alt="Dark Leaves Background"
                    class="w-full h-full object-cover">

                <div class="absolute inset-0 bg-black/50" style="z-index: 1;"></div>
            </div>

			<div class="grid md:grid-cols-2 h-full place-items-center">
                <form method="POST" action="{{ route('login') }}" class="flex flex-wrap z-10">
                    @csrf

                    <div class="flex flex-col max-md:mt-15 max-md:mb-10 z-10 text-white mb-12">
                        <div class="flex-shrink-0 flex items-center">
                            <a href="{{ route('home') }}" class="text-2xl font-bold tracking-wider">
                                K E S H O P
                            </a>
                        </div>
                        <h2 class="mb-2 text-7xl font-bold">Welcome back!</h2>
                        <p class="text-sm">Sign in to access your dashboard and continue shopping.</p>
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
                            placeholder=" "
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
                        class="flex gap-2 items-center text-white mb-4 mx-2 w-full justify-between"
                    >
                        <div class="flex gap-2 items-center">
                            <label class="wrapper col-6">
                                <input type="checkbox" name="remember" id="remember" class="hidden" />
                                <svg
                                    viewBox="0 0 64 64"
                                    height="20px"
                                    width="20px"
                                >
                                    <path
                                        d="M 0 16 V 56 A 8 8 90 0 0 8 64 H 56 A 8 8 90 0 0 64 56 V 8 A 8 8 90 0 0 56 0 H 8 A 8 8 90 0 0 0 8 V 16 L 32 48 L 64 16 V 8 A 8 8 90 0 0 56 0 H 8 A 8 8 90 0 0 0 8 V 56 A 8 8 90 0 0 8 64 H 56 A 8 8 90 0 0 64 56 V 16"
                                        pathLength="575.0541381835938"
                                        class="path"
                                    ></path>
                                </svg>
                            </label>

                            <label for="remember" class="cursor-pointer">Remember Me</label>
                        </div>

                        @if (Route::has('password.request'))
                            <div class="text-sm">
                                <a href="{{ route('password.request') }}" class="font-medium transition">
                                    Forgot password?
                                </a>
                            </div>
                        @endif
                    </div>



                    <div
                        class="flex-[0_0_auto] w-full flex flex-col gap-[7px] relative text-white px-2"
                    >
                        <button
                            type="submit"
                            class="h-[45px] rounded-md border-none outline-none px-[7px] text-white text-[15px] backdrop-blur-sm focus:shadow-[3px_3px_10px_rgba(0,0,0,1),-1px_-1px_6px_rgba(255,255,255,0.4)] shadow-[3px_3px_10px_rgba(0,0,0,1),-1px_-1px_6px_rgba(255,255,255,0.4),inset_3px_3px_10px_rgba(0,0,0,1),inset_-1px_-1px_6px_rgba(255,255,255,0.4)] font-bold transition hover:opacity-90"
                        >
                            Login
                        </button>
                    </div>

                    <div class="mt-8 text-center w-full">
                        <p class="text-md text-white">
                            Don't have an account?
                            <a href="{{ route('register') }}" class="font-bold text-[#456845] hover:text-[#456845] transition">Create an account</a>
                        </p>
                    </div>
                </form>
			</div>
		</section>
</body>
</html>