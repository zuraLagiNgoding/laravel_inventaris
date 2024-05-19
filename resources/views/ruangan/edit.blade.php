<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-indigo-900 leading-tight">
            {{ __('Edit Ruangan') }}
        </h2>
    </x-slot>

    <div class="py-12 h-full overflow-hidden">
        <div class="flex flex-col gap-4 max-w-7xl mx-auto h-full sm:px-6 lg:px-8">
            <div class="flex flex-col bg-white overflow-hidden border shadow-sm sm:rounded-lg px-6 py-14">
                <form method="post" action="{{ route('ruangan.edit', $ruangan->id) }}" class="space-y-6">
                    @csrf
                    @method('put')

                    <div>
                        <x-input-label for="ruangan_name" :value="__('Nama Ruangan')" />
                        <x-text-input id="ruangan_name" name="name" type="text" class="mt-1 block max-w-md w-full" :value="$ruangan->name"/>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="deskripsi" :value="__('Deskripsi')" />
                        <x-text-input id="deskripsi" name="deskripsi" type="text" class="mt-1 block max-w-md w-full" :value="$ruangan->deskripsi"/>
                        <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-2">
                        <a class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150" href="{{ route('ruangan') }}">Back</a>                        
                        <x-primary-button>{{ __('Save') }}</x-primary-button>                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
