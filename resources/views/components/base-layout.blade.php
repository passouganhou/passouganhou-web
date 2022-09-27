<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ $title }} - Passou Ganhou</title>
        @vite(['resources/css/app.css'])
        @livewireStyles
        <style>
            [x-cloak] {
                display: none;
            }
        </style>
    </head>
    <body class="antialiased" id="body">

       <x-header />
        <main>
            {{ $main }}
        </main>

        <x-footer />
        <div x-data="{open: false}" x-init="
            if(!getCookie('cookie_notice_accepted')) {
                setTimeout(function() {
                    open = true;

                }, 1000)
            }
        ">
            <div class="fixed bottom-0 left-0 right-0 bg-passou-magenta py-4 z-10" x-show="open" x-transition:enter="transition-all duration-300" x-transition:enter-start="transform translate-y-full" x-transition:enter-end="transform translate-y-0" x-transition:leave="transition-all duration-300" x-transition:leave-start="transform translate-y-0" x-transition:leave-end="transform translate-y-full">
                <div class="container mx-auto flex lg:flex-row flex-col items-center justify-center">
                    <p class="text-sm text-white sm:mr-6 leading-tight lg:text-left text-center lg:mb-0 mb-3 ">Nosso site salva seu histórico de uso para proporcionar uma melhor experiência. Ao continuar navegando você concorda com a nossa política de cookies e privacidade</p>
                    <div class="flex 2xl:w-auto xl:w-5/12 lg:w-8/12 sm:flex-nowrap flex-wrap justify-center">
                        <button class="bg-white px-3 py-2 rounded-sm block text-xs text-passou-magenta-800 m-1 hover:bg-opacity-80 transition-all" type="button" x-on:click="createCookie">
                            Ok, Entendi!
                        </button>
                        <button class="bg-white px-3 py-2 rounded-sm block text-xs text-passou-magenta-800 m-1 hover:bg-opacity-80 transition-all" type="button" x-on:click="open = false">
                            Fechar
                        </button>
                        <a target="_blank" class="bg-white px-3 py-2 rounded-sm block text-xs text-passou-magenta-800 m-1 hover:bg-opacity-80 transition-all" href="{{ route('politica-de-privacidade') }}">Política de Privacidade</a>
                    </div>
                </div>
                <button type="button" class="absolute right-5 top-1/2 transform -translate-y-1/2 p-3 hidden sm:block" x-on:click="open = false">
                    <i class="fas fa-times text-lg text-ebw-form"></i>
                </button>
            </div>
            <script>
                function createCookie() {
                    setCookie('cookie_notice_accepted', true, 99999);
                    this.open = false;
                }

            function setCookie(cname, cvalue, exdays) {
                    const d = new Date();
                    d.setTime(d.getTime() + (exdays*24*60*60*1000));
                    let expires = "expires="+ d.toUTCString();
                    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
                }
                function getCookie(cname) {
                    let name = cname + "=";
                    let decodedCookie = decodeURIComponent(document.cookie);
                    let ca = decodedCookie.split(';');
                    for(let i = 0; i <ca.length; i++) {
                        let c = ca[i];
                        while (c.charAt(0) == ' ') {
                        c = c.substring(1);
                        }
                        if (c.indexOf(name) == 0) {
                        return c.substring(name.length, c.length);
                        }
                    }
                    return "";
                }
            </script>
        </div>
        @livewireScripts
        @vite(['resources/js/app.js'])
    </body>
</html>
