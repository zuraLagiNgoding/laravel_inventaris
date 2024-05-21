<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 w-full max-w-xs">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col justify-between h-16">
            <div class="flex flex-col py-8 gap-6">
                <!-- Logo -->
                <div class="shrink-0 flex items-center mb-4">
                    <a href="{{ route('dashboard') }}" class="text-lg font-medium text-indigo-500">
                        Inventaris <span class="text-indigo-600">Barang</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden gap-4 sm:flex flex-col">
                    <x-nav-link class="py-2 flex gap-3" :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <x-bi-grid-fill class="w-5 h-5"/>
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    @if (Auth::user()->role == "ADMIN") 
                        <h1 class="text-xs text-gray-400">Manajemen Data</h1>

                        <x-nav-link class="py-2 flex gap-3" :href="route('category')" :active="request()->routeIs('category')">
                            <x-heroicon-c-tag class="w-5 h-5"/>
                            {{ __('Data Category') }}
                        </x-nav-link>

                        <x-nav-link class="py-2 flex gap-3" :href="route('barang')" :active="request()->routeIs('barang')">
                            <x-heroicon-s-archive-box class="w-5 h-5"/>
                            {{ __('Data Barang') }}
                        </x-nav-link>

                        <x-nav-link class="py-2 flex gap-3" :href="route('ruangan')" :active="request()->routeIs('ruangan')">
                            <x-heroicon-s-building-storefront class="w-5 h-5"/>
                            {{ __('Data Ruang') }}
                        </x-nav-link>
                    @endif

                    @if (Auth::user()->role == "ADMIN" || Auth::user()->role == "OPERATOR") 
                        <h1 class="text-xs text-gray-400">Operasional</h1>

                        <x-nav-link class="py-2 flex gap-3" :href="route('pembelian')" :active="request()->routeIs('pembelian')">
                            <x-heroicon-c-shopping-cart class="w-5 h-5"/>
                            {{ __('Pembelian') }}
                        </x-nav-link>

                        <x-nav-link class="py-2 flex gap-3" :href="route('pemakaian')" :active="request()->routeIs('pemakaian')">
                            <x-heroicon-s-archive-box class="w-5 h-5"/>
                            {{ __('Pemakaian') }}
                        </x-nav-link>
                    @endif

                    @if (Auth::user()->role == "PETUGAS") 
                        <x-nav-link class="py-2 flex gap-3" :href="route('pembelian')" :active="request()->routeIs('pembelian')">
                            <x-heroicon-c-shopping-cart class="w-5 h-5"/>
                            {{ __('Pembelian Barang') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            {{-- <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <x-feathericon-chevron-down class="h-4 w-4"/>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div> --}}

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

</nav>
