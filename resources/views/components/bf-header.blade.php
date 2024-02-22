@props([
    'whatsapp' => null
])

<div x-data="{ openMenu: false, floatingMenu: false }"
     x-on:scroll.window.throttle.50ms="handleScroll">

    <header x-ref="header-menu"
            class="top-0 left-0 right-0 z-40 transition-all duration-300 fixed bg-black py-2"
        x-bind:class="floatingMenu ? 'shadow-md' : 'relative'">
        <nav class="container mx-auto hidden xl:block py-2">
            <div class="flex justify-between items-center">
                <a class="flex justify-center" href="{{ route('home') }}">
                    <img x-bind:class="floatingMenu ? 'max-w-ss' : 'max-w-xxs'"
                        src="{{ Vite::asset('resources/images/logo-simplificada.svg') }}" alt="Passou Ganhou Logo"
                        class="max-w-ss">
                </a>

                <ul class="flex flex-row items-center justify-center">
                    <x-nav-link href="{{ route('home') }}" color="text-white">Home</x-nav-link>
                    <x-nav-link href="{{ route('home') }}#atendimento" color="text-white" class="page-scroller">Atendimento</x-nav-link>
                    {{-- <x-nav-link href="{{ route('venda-pela-internet.index') }}">Venda pela internet</x-nav-link> --}}
                    <x-nav-link href="{{route('publicacao-aqui')}}" color="text-white" target="_blank" rel="noopener noreferrer">Blog</x-nav-link>
                    <x-nav-link href="{{ route('faq.index') }}" color="text-white">FAQ</x-nav-link>
                    <x-nav-link href="{{ route('noticias-em-destaque') }}" color="text-white">Notícias em Destaque</x-nav-link>
                </ul>

                <div class="flex gap-1">

                    <a class="hover:scale-105 flex items-center justify-center rounded-full py-3 uppercase transition-all duration-200 group cursor-pointer text-white bg-passou-cyan hover:bg-passou-magenta hover:text-white px-8 font-bold font-segoe-ui" href="{{ $whatsapp  }}" target="_blank" rel="noopener noreferrer">
                        <span class="mr-2">Peça Agora</span>
                        <x-icons name="arrow-right" class="fill-white group-hover:fill-passou-cyan transition-all duration-200" />
                    </a>
                </div>

            </div>
        </nav>

        <nav class="fixed bg-black bg-opacity-95 inset-0 flex justify-center items-center" x-show="openMenu"
            x-transition:enter="transition-opacity duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" style="display: none;">
            <div class="flex flex-col justify-center items-center">
                <a class="flex justify-center mb-6" href="/">
                    <img src="{{ Vite::asset('resources/images/logo-passou-ganhou-inverted.svg') }}" alt="Passou Ganhou Logo">
                </a>

                <ul class="flex-1 flex flex-col items-center justify-center">
                    <x-nav-link type="item-mobile" href="{{ route('home') }}">Home</x-nav-link>
                    <x-nav-link type="item-mobile" href="{{ route('home') }}#atendimento" class="page-scroller">Atendimento</x-nav-link>
                    {{-- <x-nav-link type="item-mobile" href="{{ route('venda-pela-internet.index') }}">Venda pela internet</x-nav-link> --}}
                    <x-nav-link type="item-mobile" href="https://ebwbank.com.br/portal-do-empreendedor" target="_blank" rel="noopener noreferrer">Blog
                        <x-icons name="chevron-right" class="fill-white inline mb-1" width="14" height="14" />
                    </x-nav-link>
                    <x-nav-link type="item-mobile" href="{{ route('faq.index') }}">FAQ
                        <x-icons name="chevron-right" class="fill-white inline mb-1" width="14" height="14" />
                    </x-nav-link>
                    <x-nav-link type="item-mobile" href="{{ route('noticias-em-destaque') }}">Notícias em Destaque
                        <x-icons name="chevron-right" class="fill-white inline mb-1" width="14" height="14" />
                    </x-nav-link>

                </ul>


                <x-btn-default href="{{ $whatsapp  }}" target="_blank" rel="noopener noreferrer" :chevronRight="true" class="px-8 font-bold font-segoe-ui mt-1">Peça Agora</x-btn-default>
            </div>
        </nav>
        <div class="xl:hidden flex justify-between container">
            <a class="flex justify-center" href="{{ route('home') }}">
                <img src="{{ Vite::asset('resources/images/logo-passou-ganhou-inverted.svg') }}"
                    alt="Passou Ganhou Logo"
                    class="w-28">
            </a>
            <button type="button" aria-label="Open Menu"
                class="z-50 flex justify-center items-center border-2 border-white rounded-lg w-10 h-10 overflow-hidden"
                x-on:click="openMenu = !openMenu">
                <span x-show="!openMenu" x-cloak x-transition>
                    <x-icons name="bars" class="fill-white" width="24" height="24" />
                </span>
                <span x-show="openMenu" x-cloak x-transition>
                    <x-icons name="times"  class="fill-white" width="24" height="24" />
                </span>
            </button>
        </div>
    </header>

    <script>
        function handleScroll(evt) {
            const top = window.pageYOffset || document.documentElement.scrollTop;

            this.floatingMenu = top > 400;
        }
    </script>
</div>
