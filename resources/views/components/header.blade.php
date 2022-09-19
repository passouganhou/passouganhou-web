<div x-data="{ openMenu: false, floatingMenu: false }"
x-on:scroll.window.throttle.50ms="handleScroll"
x-init="console.log(true)">

    <header x-ref="header-menu"
        class="top-0 left-0 right-0 z-40 transition-all duration-300 fixed bg-passou-magenta shadow-md py-4"
        x-bind:class="floatingMenu ? 'fixed bg-passou-magenta shadow-md' : 'relative'">
        <nav class="container mx-auto px-4 hidden xl:block py-2">
            <div class="flex justify-between items-center">
                <a class="flex justify-center" href="#">
                    <img x-bind:class="floatingMenu ? 'max-w-ss' : 'max-w-xxs'"
                        src="{{ Vite::asset('resources/images/logo-passou-ganhou.png') }}" alt="EBW Bank Logo"
                        class="max-w-ss">
                </a>

                <ul class="flex flex-row items-center justify-center">
                    <x-nav-link href="#">Home</x-nav-link>
                    <x-nav-link href="#">Atendimento</x-nav-link>
                    <x-nav-link href="#">Venda pela internet</x-nav-link>
                    <x-nav-link href="#">Portal do Empreendedor
                        <x-icon name="chevron-right" class="fill-white inline mb-1" width="14" height="14" />
                    </x-nav-link>
                    <x-nav-link href="#">FAQ
                        <x-icon name="chevron-right" class="fill-white inline mb-1" width="14" height="14" />
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
                    <img src="{{ Vite::asset('resources/images/logo-passou-ganhou.png') }}" alt="EBW Bank Logo">
                </a>

                <ul class="flex-1 flex flex-col items-center justify-center">

                    <li class="my-1 mx-3">
                        <a class="l-header__nav-link font-bold uppercase p-2 inline-block text-white"
                            href="https://ebw-bank.evo">
                            Home
                        </a>
                    </li>

                    <li class="my-1 mx-3">
                        <a class="l-header__nav-link font-bold uppercase p-2 inline-block text-white"
                            href="https://ebw-bank.evo/aebw">
                            A EBW
                        </a>
                    </li>
                    <li class="text-center text-white text-opacity-75">Para seu negócio</li>
                    <li class="mx-3">
                        <a class="l-header__nav-link font-bold uppercase p-2 inline-block text-white"
                            href="https://ebw-bank.evo/venda-pela-internet">
                            Venda pela internet
                        </a>
                    </li>
                    <li class="mb-1 mx-3">
                        <a class="l-header__nav-link font-bold uppercase p-2 inline-block text-white"
                            href="https://ebw-bank.evo/peca-sua-maquininha">
                            Peça sua maquininha
                        </a>
                    </li>



                    <li class="my-1 mx-3">
                        <a class="l-header__nav-link font-bold uppercase p-2 inline-block text-white"
                            href="https://ebw-bank.evo/banco-talentos">
                            Banco de Talentos
                        </a>
                    </li>
                </ul>
                <li class="my-1 mx-3">
                    <a class="l-header__nav-link font-bold uppercase p-2 inline-block text-white"
                        href="https://ebw-bank.evo/portal-do-empreendedor">
                        Blog
                    </a>
                </li>
        </nav>
        <button type="button" aria-label="Open Menu"
            class="l-header__hamburger xl:hidden z-50 flex justify-center items-center"
            x-on:click="openMenu = !openMenu">
            <span class="fas fa-bars text-xl text-white" x-bind:class="openMenu ? 'fa-times' : 'fa-bars'"></span>
        </button>
    </header>

    <script>
        function handleScroll(evt) {
            const top = window.pageYOffset || document.documentElement.scrollTop;

            this.floatingMenu = top > 400;
        }
    </script>
</div>
