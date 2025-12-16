<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SINKLUS') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-['Open_Sans'] antialiased bg-[#E9F5DB]"> <div class="min-h-screen flex">
            
            @include('layouts.sidebar')

            <div class="flex-1 flex flex-col min-h-screen transition-all duration-300">
                
                @include('layouts.navigation')

                @if (isset($header))
                    <header class="bg-white shadow-sm z-10 relative">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <main class="flex-1 p-6 overflow-y-auto">
                    {{ $slot }}
                </main>
            </div>
            
        </div>
    </body>
</html>