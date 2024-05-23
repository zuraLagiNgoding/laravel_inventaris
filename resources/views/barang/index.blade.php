<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-indigo-900 leading-tight">
            {{ __('Data Barang') }}
        </h2>
    </x-slot>

    <div class="py-12 relative h-full overflow-hidden">   

        @if (session('status'))
            <div class="absolute top-0 mt-4 flex justify-center w-full">
                <div 
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 3000)" 
                    class="text-green-600 border-b border-green-400 bg-white shadow-md p-4 rounded-lg flex items-center gap-6 text-sm"
                ><x-feathericon-check-circle class="w-5 h-5"/>{{ session('status') }}</div>
            </div>
        @endif
        
        <div class="flex flex-col gap-4 max-w-7xl mx-auto h-full sm:px-6 lg:px-8">
            <div class="flex justify-end">                
                <div class="flex items-center gap-3">
                    <a href="{{ url()->current() . '/export' }}" class="border border-green-600 gap-2 hover:bg-green-200/10 text-green-600 font-medium h-full px-4 py-2 rounded-lg flex items-center text-sm">Generate Report<x-bx-spreadsheet class="w-5 h-5 "/></a>
                    <a href="{{ url()->current() . '/save' }}" class="bg-gray-900 gap-2 text-white font-medium h-full px-4 py-2 rounded-lg flex items-center text-sm">New Barang <x-feathericon-plus-circle class="w-5 h-5 fill-white text-[#2D232E]"/></a>
                </div>
            </div>
            <div class="flex flex-col h-full">
                <div class="flex flex-col bg-white overflow-hidden border shadow-sm sm:rounded-lg">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b h-8 bg-indigo-600 text-white text-sm border-b-slate-200">
                                <th class="w-16 text-start px-4">No</th>
                                <th class="px-4">Nama Barang</th>
                                <th class="px-4">Merk/Type</th>
                                <th class="px-4">Category</th>
                                <th class="px-4">Qty</th>
                                <th class="px-4">Harga</th>
                                <th class="w-24 px-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barangs as $barang)    
                              <tr class="border-b h-10 border-b-slate-200 hover:bg-slate-100">
                                <td class="px-4">{{ $loop->iteration }}</td>
                                <td class="px-4">{{ $barang->name }}</td>
                                <td class="px-4">{{ $barang->merk }}</td>
                                <td class="px-4">{{ $barang->category->name}}</td>
                                <td class="px-4">{{ $barang->qty}}</td>
                                <td class="px-4">{{ $barang->price}}</td>
                                <td class="px-4 text-center">
                                  <div class="flex gap-2 items-center justify-center">
                                    <a href="{{ url('barang', $barang->id) }}">
                                      <x-feathericon-edit class="w-4 h-4 text-indigo-400"/>
                                    </a>
                                    <button 
                                      x-data=""
                                      x-on:click.prevent="$dispatch('open-modal', '{{ $barang->id }}')"
                                    >
                                      <x-feathericon-trash-2 class="w-4 h-4 text-red-400"/>
                                    </button>
                                    <x-modal name="{{ $barang->id }}" focusable maxWidth="md">
                                        <form method="post" action="{{ route('barang.destroy', $barang->id) }}" class="p-6">
                                            @csrf
                                            @method('delete')

                                            <h2 class="text-start font-medium text-gray-900">
                                                {{ __('Are you sure you want to delete this data?') }}
                                            </h2>
                                            <div class="mt-6 flex justify-end">
                                                <x-secondary-button x-on:click="$dispatch('close')">
                                                    {{ __('Cancel') }}
                                                </x-secondary-button>

                                                <x-danger-button class="ms-3">
                                                    {{ __('Delete') }}
                                                </x-danger-button>
                                            </div>
                                        </form>
                                    </x-modal>
                                  </div>
                                </td>
                              </tr>
                            @endforeach
                            @if(count($barangs) == 0)
                              <tr class="h-32">
                                <td colspan="7" class="text-center text-gray-400">
                                  <p class="select-none">Data Kosong</p>
                                </td>
                              </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $barangs->links() }}
        </div>
    </div>

</x-app-layout>
