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
                    <header class="bg-white shadow flex justify-between items-center py-4 px-8 min-h-[72px]">
                        <div class="max-w-7xl">
                            {{ $header }}
                        </div>
                        @unless(Request::url() == url('/dashboard') || Request::segment(count(Request::segments())) == 'save')
                            <form action="{{ url()->current() }}" method="get" class="flex items-center w-full max-w-sm bg-white px-4 py-2 border border-indigo-700/15 h-10 overflow-hidden rounded-3xl">
                                <input name="search" type="text" class="!ring-0 basis-[90%] w-full !outline-none border-0"/>
                                <button type="submit" class="basis-[10%]">
                                    <x-feathericon-search class="ml-auto h-5 w-5 text-indigo-500"/>
                                </button>
                            </form>
                        @endunless 
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
