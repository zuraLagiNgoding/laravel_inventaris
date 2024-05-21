<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-indigo-900 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="flex flex-col gap-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col gap-4 bg-white overflow-hidden shadow-sm sm:rounded-lg py-6 px-8">
                <p class="font-medium">
                    Selamat Datang! Anda login sebagai {{ Auth::user()->role}}
                </p>
                @if (Auth::user()->role == "ADMIN")
                <div class="grid grid-cols-3 gap-12">
                    <div class="flex gap-6 border-2 p-6 rounded-2xl shadow-md">
                        <div class="basis-1/2 text-lg text-wrap leading-tight">
                            Total Category Barang
                        </div>
                        <div class="basis-1/2 text-4xl font-medium text-indigo-600">
                            {{ $totalCategory }}
                        </div>
                    </div>
                    <div class="flex gap-6 border-2 p-6 rounded-2xl shadow-md">
                        <div class="basis-1/2 text-lg text-wrap leading-tight">
                            Total Barang
                        </div>
                        <div class="basis-1/2 text-4xl font-medium text-indigo-600">
                            {{ $totalBarang }}
                        </div>
                    </div>
                    <div class="flex gap-6 border-2 p-6 rounded-2xl shadow-md">
                        <div class="basis-1/2 text-lg text-wrap leading-tight">
                            Total Ruangan
                        </div>
                        <div class="basis-1/2 text-4xl font-medium text-indigo-600">
                            {{ $totalRuangan }}
                        </div>
                    </div>
                </div>
                @endif
                @if (Auth::user()->role == "OPERATOR")
                <div class="grid grid-cols-3 gap-12">
                    <div class="flex gap-6 border-2 p-6 rounded-2xl shadow-md">
                        <div class="basis-1/2 text-lg text-wrap leading-tight">
                            Total Pembelian
                        </div>
                        <div class="basis-1/2 text-4xl font-medium text-indigo-600">
                            {{ $totalPembelian }}
                        </div>
                    </div>
                    <div class="flex gap-6 border-2 p-6 rounded-2xl shadow-md">
                        <div class="basis-1/2 text-lg text-wrap leading-tight">
                            Total Pemakaian
                        </div>
                        <div class="basis-1/2 text-4xl font-medium text-indigo-600">
                            {{ $totalPemakaian }}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
