<div x-data="{openMenu: false, floatingMenu: false, alwaysOpen: false}" x-on:scroll.window.throttle.50ms="handleScroll" x-init="
    window.addEventListener('resize', function() {
        if(!!document.querySelector('.no-floating-menu')) {
            alwaysOpen = window.innerWidth >= 1200;
        }
    })
    if(!!document.querySelector('.no-floating-menu')) {
        alwaysOpen = window.innerWidth >= 1200;
    }
    $watch('floatingMenu', function(value) {

    })
">

    <header x-ref="header-menu" class="top-0 left-0 right-0 z-40 transition-all duration-300 fixed bg-white shadow-md" x-bind:class="floatingMenu || alwaysOpen ? 'fixed bg-white shadow-md' : 'absolute py-9'">
        <nav class="container xl:max-w-7xl 2xl:max-w-8xl mx-auto px-4 hidden xl:block py-2">
            <div class="flex justify-center items-center">
                <a class="l-header__logo flex justify-center" href="https://ebw-bank.evo">
                    <img x-bind:class="floatingMenu || alwaysOpen ? 'max-w-ss' : 'max-w-xxs'" src="https://ebw-bank.evo/images/haeder-logo-black.png" alt="EBW Bank Logo" class="max-w-ss">
                </a>
                <div class="flex items-center">

                    <ul class="2xl:pl-20 lg:pl-8 flex flex-row items-center justify-center">

                        <li class="my-4 mx-3">
                            <a class="l-header__nav-link font-bold uppercase p-2 inline-block  text-black" href="https://ebw-bank.evo">
                                Home
                            </a>
                        </li>

                        <li class="my-4 mx-3">
                            <a class="l-header__nav-link font-bold uppercase p-2 inline-block text-black" href="https://ebw-bank.evo/aebw">
                                A EBW
                            </a>
                        </li>

                        <li class="l-dropdown relative my-4 mx-3">
                            <a class="l-header__nav-link font-bold uppercase p-2 inline-block text-black" href="#">
                                Para seu negócio
                            </a>

                            <ul class="l-dropdown__menu">

                                <li class="l-dropdown__item u-icon__free u-icon__arrow-right hover:opacity:08 relative all:u-color-folk-white my-4">

                                    <a class="font-medium text-white" href="https://ebw-bank.evo/venda-pela-internet">
                                        Venda pela internet
                                    </a>
                                </li>

                                <li class="l-dropdown__item u-icon__free u-icon__arrow-right hover:opacity:08 relative all:u-color-folk-white my-4">

                                    <a class="font-medium text-white" href="https://ebw-bank.evo/peca-sua-maquininha">
                                        Peça sua maquininha
                                    </a>
                                </li>
                            </ul>
                        </li>



                        <li class="my-4 mx-3">
                            <a class="l-header__nav-link font-bold uppercase p-2 inline-block text-black" href="https://ebw-bank.evo/banco-talentos">
                                Banco de Talentos
                            </a>
                        </li>
                        <li class="my-4 mx-3">
                            <a class="l-header__nav-link font-bold uppercase p-2 inline-block text-black" href="https://ebw-bank.evo/portal-do-empreendedor">
                                Blog
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>

        <nav class="fixed bg-black bg-opacity-95 inset-0 flex justify-center items-center" x-show="openMenu" x-transition:enter="transition-opacity duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" style="display: none;">
            <div class="flex flex-col justify-center items-center">
                <a class="l-header__logo flex justify-center mb-6" href="https://ebw-bank.evo">
                    <img src="https://ebw-bank.evo/images/header-logo.png" alt="EBW Bank Logo">
                </a>

                <ul class="flex-1 flex flex-col items-center justify-center">

                <li class="my-1 mx-3">
                        <a class="l-header__nav-link font-bold uppercase p-2 inline-block text-white" href="https://ebw-bank.evo">
                            Home
                        </a>
                    </li>

                <li class="my-1 mx-3">
                        <a class="l-header__nav-link font-bold uppercase p-2 inline-block text-white" href="https://ebw-bank.evo/aebw">
                            A EBW
                        </a>
                    </li>
                    <li class="text-center text-white text-opacity-75">Para seu negócio</li>
                <li class="mx-3">
                        <a class="l-header__nav-link font-bold uppercase p-2 inline-block text-white" href="https://ebw-bank.evo/venda-pela-internet">
                            Venda pela internet
                        </a>
                    </li>
                <li class="mb-1 mx-3">
                    <a class="l-header__nav-link font-bold uppercase p-2 inline-block text-white" href="https://ebw-bank.evo/peca-sua-maquininha">
                        Peça sua maquininha
                    </a>
                </li>



                <li class="my-1 mx-3">
                        <a class="l-header__nav-link font-bold uppercase p-2 inline-block text-white" href="https://ebw-bank.evo/banco-talentos">
                            Banco de Talentos
                        </a>
                    </li>
                </ul>
                <li class="my-1 mx-3">
                    <a class="l-header__nav-link font-bold uppercase p-2 inline-block text-white" href="https://ebw-bank.evo/portal-do-empreendedor">
                        Blog
                    </a>
                </li>
        </nav>
        <button type="button" aria-label="Open Menu" class="l-header__hamburger xl:hidden z-50 flex justify-center items-center" x-on:click="openMenu = !openMenu">
            <span class="fas fa-bars text-xl text-white" x-bind:class="openMenu ? 'fa-times' : 'fa-bars' "></span>
        </button>
    </header>

    <script>
        function handleScroll(evt) {
            const top = window.pageYOffset || document.documentElement.scrollTop;

            this.floatingMenu = top > 400;
        }
    </script>
</div>
