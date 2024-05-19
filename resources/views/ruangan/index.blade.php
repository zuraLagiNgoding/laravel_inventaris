<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-indigo-900 leading-tight">
            {{ __('Data Jenis Barang') }}
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
            <div class="flex justify-between">
                <form action="{{ route('ruangan') }}" method="get" class="flex items-center max-w-sm bg-white px-4 py-2 border h-10 overflow-hidden rounded-3xl">
                    <input name="search" type="text" class="!ring-0 basis-[90%] w-auto !outline-none border-0"/>
                    <button type="submit" class=" basis-[10%]">
                        <x-feathericon-search class="h-5 w-5 text-indigo-500"/>
                    </button>
                </form>
                <a href="{{ route("ruangan.save") }}" class="bg-gray-900 gap-2 text-white font-medium px-4 py-1 rounded-md flex items-center text-sm">New Ruangan <x-feathericon-plus-circle class="w-5 h-5 fill-white text-gray-900"/></a>
            </div>
            <div class="flex flex-col h-full">
                <div class="flex flex-col bg-white overflow-hidden border shadow-sm sm:rounded-lg">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b h-8 border-b-slate-200">
                                <th class="w-16 text-start px-4">No</th>
                                <th class="px-4">Nama</th>
                                <th class="px-4">Deskripsi</th>
                                <th class="w-24 px-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ruangans as $ruangan)    
                              <tr class="border-b h-10 border-b-slate-200 hover:bg-slate-100">
                                <td class="px-4">{{ $loop->iteration }}</td>
                                <td class="px-4">{{ $ruangan->name }}</td>
                                <td class="px-4">{{ $ruangan->deskripsi }}</td>
                                <td class="px-4 text-center">
                                  <div class="flex gap-2 items-center justify-center">
                                    <a href="{{ url('ruangan', $ruangan->id) }}">
                                      <x-feathericon-edit class="w-4 h-4 text-indigo-400"/>
                                    </a>
                                    <button 
                                      x-data=""
                                      x-on:click.prevent="$dispatch('open-modal', '{{ $ruangan->id }}')"
                                    >
                                      <x-feathericon-trash-2 class="w-4 h-4 text-red-400"/>
                                    </button>
                                    <x-modal name="{{ $ruangan->id }}" focusable maxWidth="md">
                                        <form method="post" action="{{ route('ruangan.destroy', $ruangan->id) }}" class="p-6">
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
                            @if(count($ruangans) == 0)
                              <tr class="h-32">
                                <td colspan="3" class="text-center text-gray-400">
                                  <p class="select-none">Data Kosong</p>
                                </td>
                              </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $ruangans->links() }}
        </div>
    </div>

</x-app-layout>
