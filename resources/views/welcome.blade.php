<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SINKLUS - Sistem Informasi Klinik</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    
    <body class="antialiased bg-white min-h-screen flex items-center justify-center relative overflow-hidden font-['Open_Sans']">

        <div class="relative z-10 bg-[#FBF8F1] w-full max-w-5xl h-auto py-16 px-12 rounded-xl shadow-2xl flex flex-col md:flex-row items-center justify-between border border-gray-100 mx-4">
            
            <div class="flex items-center gap-5 mb-8 md:mb-0">
                <div class="relative w-20 h-20">
                    <div class="absolute inset-0 bg-[#009CBD] rounded-full flex items-center justify-center border-4 border-[#005F73]">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="4" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                        </svg>
                    </div>
                </div>

                <div>
                    <h1 class="text-5xl font-extrabold text-[#004E64] tracking-wide">SINKLUS</h1>
                    <p class="text-sm font-semibold text-[#004E64] mt-1 tracking-wide">Sistem Informasi Klinik & Puskesmas</p>
                </div>
            </div>

            <div>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="bg-[#A4C96A] text-[#1a3d1f] font-bold text-lg py-3 px-10 rounded-lg shadow-md hover:bg-[#8eb555] transition duration-300">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="bg-[#A4C96A] text-[#1a3d1f] font-bold text-lg py-3 px-10 rounded-lg shadow-md hover:bg-[#8eb555] transition duration-300">
                            Login Account
                        </a>
                    @endauth
                @endif
            </div>
        </div>
        <div class="absolute bottom-0 left-0 w-full z-0">
            <img src="{{ asset('images/wave.png') }}" alt="Wave Decoration" class="w-full h-auto object-cover">
        </div>
    </body>
</html>