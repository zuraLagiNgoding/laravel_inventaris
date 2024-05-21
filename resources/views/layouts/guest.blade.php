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
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen w-full h-screen flex bg-gray-100">
            <div class="basis-8/12 w-full p-12">
                <div>
                    <h1 class="text-2xl font-semibold">Aplikasi Manajemen Inventaris Barang</h1>
                    <h1 class="text-gray-400">Tugas Pemrograman Web</h1>
                </div>
            </div>
            <div class="basis-4/12 flex flex-col gap-6 w-full h-full px-6 py-12 bg-white shadow-md overflow-hidden sm:rounded-lg justify-center">
                <h1 class="text-3xl font-semibold">Login</h1>
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
