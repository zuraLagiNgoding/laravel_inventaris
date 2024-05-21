<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="flex h-screen w-full bg-gray-100">
            @include('layouts.sidebar')

            <div class="flex flex-col h-full w-full">
                <!-- Page Heading -->
                @if (isset($header))
                    <header class="bg-white shadow flex justify-between py-6 px-8">
                        <div class="max-w-7xl">
                            {{ $header }}
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <a class="text-red-500 text-sm flex items-center gap-1 font-semibold" href="{{ route("logout") }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                Log Out
                                <x-tabler-logout-2 class="w-5 h-5"/>
                            </a>
                        </form>
                    </header>
                @endif
    
                <!-- Page Content -->
                <main class="h-full p-12 relative">
                    {{ $slot }}
                </main>
    
            </div>
        </div>
    </body>
</html>
