<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-indigo-900 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="pt-12 h-full">
        <div class="flex flex-col gap-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col gap-4 bg-white overflow-hidden shadow-sm sm:rounded-lg py-6 px-8">
                <p class="font-medium">
                    Selamat Datang! Anda login sebagai {{ Auth::user()->role}}
                </p>
                @if (Auth::user()->role == "ADMIN")
                <div class="grid grid-cols-3 gap-12">

                    <div class="flex gap-4 border-2 p-6 rounded-2xl shadow-md">
                        <div class="basis-1/2 text-wrap leading-tight">
                            <p>
                                Total Category Barang
                            </p>
                            <h1 class="text-2xl font-medium text-indigo-600/75">
                                {{ $totalCategory }}
                            </h1>
                        </div>
                        <div class="basis-1/2 flex items-center text-4xl text-indigo-600">
                            <x-heroicon-c-tag class="ml-auto w-14 h-14"/>
                        </div>
                    </div>
                    <div class="flex gap-4 border-2 p-6 rounded-2xl shadow-md">
                        <div class="basis-1/2 text-lg text-wrap leading-tight">
                            <p>
                                Total Barang
                            </p>
                            <h1 class="text-2xl font-medium text-indigo-600/75">
                                {{ $totalBarang }}
                            </h1>
                        </div>
                        <div class="basis-1/2 flex items-center text-4xl text-indigo-600">
                            <x-heroicon-s-archive-box class="ml-auto w-14 h-14"/>
                        </div>
                    </div>
                    <div class="flex gap-4 border-2 p-6 rounded-2xl shadow-md">
                        <div class="basis-1/2 text-lg text-wrap leading-tight">
                            <p>
                                Total Ruangan
                            </p>
                            <h1 class="text-2xl font-medium text-indigo-600/75">
                                {{ $totalRuangan }}
                            </h1>
                        </div>
                        <div class="basis-1/2 flex items-center text-4xl text-indigo-600">
                            <x-heroicon-s-building-storefront class="ml-auto w-14 h-14"/>
                        </div>
                    </div>
                </div>
                @endif
                @if (Auth::user()->role == "OPERATOR")
                <div class="grid grid-cols-3 gap-12">
                    <div class="flex gap-4 border-2 p-6 rounded-2xl shadow-md">
                        <div class="basis-1/2 text-lg text-wrap leading-tight">
                            <p>
                                Total Barang
                            </p>
                            <h1 class="text-2xl font-medium text-indigo-600/75">
                                {{ $totalBarang }}
                            </h1>
                        </div>
                        <div class="basis-1/2 flex items-center text-4xl text-indigo-600">
                            <x-heroicon-s-archive-box class="ml-auto w-14 h-14"/>
                        </div>
                    </div>
                    <div class="flex gap-4 border-2 p-6 rounded-2xl shadow-md">
                        <div class="basis-1/2 text-lg text-wrap leading-tight">
                            <p>
                                Total Pembelian
                            </p>
                            <h1 class="text-2xl font-medium text-indigo-600/75">
                                {{ $totalPembelian }}
                            </h1>
                        </div>
                        <div class="basis-1/2 flex items-center text-4xl text-indigo-600">
                            <x-heroicon-c-shopping-cart class="ml-auto w-14 h-14"/>
                        </div>
                    </div>
                    <div class="flex gap-4 border-2 p-6 rounded-2xl shadow-md">
                        <div class="basis-1/2 text-lg text-wrap leading-tight">
                            <p>
                                Total Pemakaian
                            </p>
                            <h1 class="text-2xl font-medium text-indigo-600/75">
                                {{ $totalPemakaian }}
                            </h1>
                        </div>
                        <div class="basis-1/2 flex items-center text-4xl text-indigo-600">
                            <x-heroicon-s-archive-box class="ml-auto w-14 h-14"/>
                        </div>
                    </div>
                </div>
                @endif
                @if (Auth::user()->role == "PETUGAS")
                <div class="grid grid-cols-3 gap-12">
                    <div class="flex gap-4 border-2 p-6 rounded-2xl shadow-md">
                        <div class="basis-1/2 text-lg text-wrap leading-tight">
                            <p>
                                Total Barang
                            </p>
                            <h1 class="text-2xl font-medium text-indigo-600/75">
                                {{ $totalBarang }}
                            </h1>
                        </div>
                        <div class="basis-1/2 flex items-center text-4xl text-indigo-600">
                            <x-heroicon-s-archive-box class="ml-auto w-14 h-14"/>
                        </div>
                    </div>
                    <div class="flex gap-4 border-2 p-6 rounded-2xl shadow-md">
                        <div class="basis-1/2 text-lg text-wrap leading-tight">
                            <p>
                                Total Pembelian
                            </p>
                            <h1 class="text-2xl font-medium text-indigo-600/75">
                                {{ $totalPembelian }}
                            </h1>
                        </div>
                        <div class="basis-1/2 flex items-center text-4xl text-indigo-600">
                            <x-heroicon-c-shopping-cart class="ml-auto w-14 h-14"/>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="flex flex-col gap-3 min-h-[25rem] py-6">
                @if (Auth::user()->role == "ADMIN")
                <p class="font-medium pr-8">
                    Laporan Inventaris
                </p>
                <div class="flex justify-between gap-3 h-full text-xs">
                    <div class="flex flex-col gap-2 px-8 py-4 bg-white overflow-hidden border shadow-sm sm:rounded-lg">
                        <h1 class="text-lg text-indigo-500 font-semibold">Pemakaian</h1>
                        <div class="flex flex-col bg-white overflow-hidden border shadow-sm sm:rounded-lg">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b h-8 bg-indigo-600 text-white border-b-slate-200">
                                        <th class="px-4">Nama Barang</th>
                                        <th class="px-4">Category</th>
                                        <th class="px-4">Tanggal Pakai</th>
                                        <th class="px-4">Jumlah</th>
                                        <th class="px-4">Ruang</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pemakaians as $pemakaian)    
                                      <tr class="border-b h-10 border-b-slate-200 hover:bg-slate-100">
                                        <td class="px-4">{{ $pemakaian->barang->name }}</td>
                                        <td class="px-4">{{ $pemakaian->barang->category->name}}</td>
                                        <td class="px-4 text-center">{{ $pemakaian->updated_at}}</td>
                                        <td class="px-4">{{ $pemakaian->amount}}</td>
                                        <td class="px-4">
                                            @if ($pemakaian->ruang)
                                                {{ $pemakaian->ruang->name }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                      </tr>
                                    @endforeach
                                    @if(count($pemakaians) == 0)
                                      <tr class="h-32">
                                        <td colspan="7" class="text-center text-gray-400">
                                          <p class="select-none">Data Kosong</p>
                                        </td>
                                      </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div> 
                        <a href="{{ route('pemakaian') }}" class="text-indigo-700/75 text-center">View More</a>
                    </div>
                    <div class="flex flex-col gap-2 px-8 py-4 bg-white overflow-hidden border shadow-sm sm:rounded-lg">
                        <h1 class="text-lg text-indigo-500 font-semibold">Pembelian</h1>
                        <div class="flex flex-col bg-white overflow-hidden border shadow-sm sm:rounded-lg">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b h-8 bg-indigo-600 text-white border-b-slate-200">
                                        <th class="px-4">Nama Barang</th>
                                        <th class="px-4">Category</th>
                                        <th class="px-4">Tanggal Beli</th>
                                        <th class="px-4">Jumlah</th>
                                        <th class="px-4">Harga</th>
                                        <th class="px-4 text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pembelians as $pembelian)    
                                    <tr class="border-b h-10 border-b-slate-200 hover:bg-slate-100">
                                        <td class="px-4">{{ $pembelian->barang->name }}</td>
                                        <td class="px-4">{{ $pembelian->barang->category->name}}</td>
                                        <td class="px-4 text-center">{{ $pembelian->updated_at}}</td>
                                        <td class="px-4">{{ $pembelian->amount}}</td>
                                        <td class="px-4">{{ $pembelian->barang->price}}</td>
                                        <td class="px-4 text-end">{{ $pembelian->barang->price * $pembelian->amount}}</td>
                                    </tr>
                                    @endforeach
                                    @if(count($pembelians) == 0)
                                    <tr class="h-32">
                                        <td colspan="9" class="text-center text-gray-400">
                                        <p class="select-none">Data Kosong</p>
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <a href="{{ route('pembelian') }}" class="text-indigo-700/75 text-center">View More</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
