<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>K E S H O P</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font- antialiased text-gray-900 bg-white">
    <section
			id="kontak"
			class="md:h-[100vh] bg-cover p-6 py-12 md:px-20 md:py-0"
		>
            <div class="fixed inset-0" style="z-index: 0;">
                <img src="{{ asset('images/bg-l.jpg') }}" alt="Dark Leaves Background"
                    class="w-full h-full object-cover">

                <div class="absolute inset-0 bg-black/50" style="z-index: 1;"></div>
            </div>

            {{ $slot }}
    </section>
</body>
</html>