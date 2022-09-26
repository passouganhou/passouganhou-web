<div x-data="{ openMenu: false, floatingMenu: false }"
x-on:scroll.window.throttle.50ms="handleScroll">

    <header x-ref="header-menu"
        class="top-0 left-0 right-0 z-40 transition-all duration-300 fixed bg-passou-magenta shadow-md py-4"
        x-bind:class="floatingMenu ? 'fixed bg-passou-magenta shadow-md' : 'relative'">
        <nav class="container mx-auto px-4 hidden xl:block py-2">
            <div class="flex justify-between items-center">
                <a class="flex justify-center" href="#">
                    <img x-bind:class="floatingMenu ? 'max-w-ss' : 'max-w-xxs'"
                        src="{{ Vite::asset('resources/images/logo-passou-ganhou.png') }}" alt="Passou Ganhou Logo"
                        class="max-w-ss">
                </a>

                <ul class="flex flex-row items-center justify-center">
                    <x-nav-link href="#">Home</x-nav-link>
                    <x-nav-link href="#">Atendimento</x-nav-link>
                    <x-nav-link href="#">Venda pela internet</x-nav-link>
                    <x-nav-link href="#">Portal do Empreendedor
                        <x-icons name="chevron-right" class="fill-white inline mb-1" width="14" height="14" />
                    </x-nav-link>
                    <x-nav-link href="{{ route('faq.index') }}">FAQ
                        <x-icons name="chevron-right" class="fill-white inline mb-1" width="14" height="14" />
                    </x-nav-link>
                </ul>

                <x-btn-default href="#" :chevronRight="true" class="px-8 font-bold font-segoe-ui open-contact-form">Peça Agora</x-btn-default>
            </div>
        </nav>

        <nav class="fixed bg-black bg-opacity-95 inset-0 flex justify-center items-center" x-show="openMenu"
            x-transition:enter="transition-opacity duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" style="display: none;">
            <div class="flex flex-col justify-center items-center">
                <a class="flex justify-center mb-6" href="/">
                    <img src="{{ Vite::asset('resources/images/logo-passou-ganhou.png') }}" alt="Passou Ganhou Logo">
                </a>

                <ul class="flex-1 flex flex-col items-center justify-center">
                    <x-nav-link type="item-mobile" href="#">Home</x-nav-link>
                    <x-nav-link type="item-mobile" href="#">Atendimento</x-nav-link>
                    <x-nav-link type="item-mobile" href="#">Venda pela internet</x-nav-link>
                    <x-nav-link type="item-mobile" href="#">Portal do Empreendedor
                        <x-icons name="chevron-right" class="fill-white inline mb-1" width="14" height="14" />
                    </x-nav-link>
                    <x-nav-link type="item-mobile" href="{{ route('faq.index') }}">FAQ
                        <x-icons name="chevron-right" class="fill-white inline mb-1" width="14" height="14" />
                    </x-nav-link>
                </ul>
                <x-btn-default href="#" :chevronRight="true" class="px-8 font-bold font-segoe-ui open-contact-form mt-1">Peça Agora</x-btn-default>
            </div>
        </nav>
        <div class="xl:hidden flex justify-between container">
            <a class="flex justify-center" href="#">
                <img src="{{ Vite::asset('resources/images/logo-passou-ganhou.png') }}"
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
