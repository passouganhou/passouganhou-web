<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Passou Ganhou - {{ $title }} </title>
        <meta name="title" content="Passou Ganhou - {{ $title }}">
        <meta name="description" content="Negocie suas taxas. Cada cliente é único. Nossa proposta também. Comece agoraa negociar com a PASSOU GANHOU.">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ URL::to('/') }}">
        <meta property="og:title" content="Passou Ganhou">
        <meta property="og:description" content="Negocie suas taxas. Cada cliente é único. Nossa proposta também. Comece agoraa negociar com a PASSOU GANHOU.">
        <meta property="og:image" content="{{ Vite::asset('resources/images/machine-collection.png') }}">
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="{{ URL::to('/') }}/">
        <meta property="twitter:title" content="Passou Ganhou">
        <meta property="twitter:description" content="Negocie suas taxas. Cada cliente é único. Nossa proposta também. Comece agoraa negociar com a PASSOU GANHOU.">
        <meta property="twitter:image" content="{{ Vite::asset('resources/images/machine-collection.png') }}">
        <meta name="keywords" content="negocie taxas, cliente, maquininha de cartão, crédito, débito, passou ganhou, venda, negócios">
        <meta name="author" content="Passou Ganhou">
        <meta name="robots" content="all" />
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">

        @vite(['resources/css/app.css'])
        @livewireStyles
        <style>
            [x-cloak] {
                display: none;
            }
        </style>
    </head>
    <body class="antialiased" id="body">

       <x-header :whatsapp="$settings->whatsapp" />
        <main>
            {{ $main }}
        </main>

        <x-footer />

        <a href="{{ $settings->whatsapp }}" class="fixed z-50 cursor-pointer right-7 bottom-24">
            <div class="bg-gradient-to-b from-[#61fd7d] to-[#2bb826] rounded-lg shadow-md" style="height:50px; width:50px;">
                <svg style="pointer-events:none; display:block; height:50px; width:50px;" width="50px" height="50px" viewBox="0 0 1024 1024">
                    <g>
                        <path fill="#FFF" d="M783.302 243.246c-69.329-69.387-161.529-107.619-259.763-107.658-202.402 0-367.133 164.668-367.214 367.072-.026 64.699 16.883 127.854 49.017 183.522l-52.096 190.229 194.665-51.047c53.636 29.244 114.022 44.656 175.482 44.682h.151c202.382 0 367.128-164.688 367.21-367.094.039-98.087-38.121-190.319-107.452-259.706zM523.544 808.047h-.125c-54.767-.021-108.483-14.729-155.344-42.529l-11.146-6.612-115.517 30.293 30.834-112.592-7.259-11.544c-30.552-48.579-46.688-104.729-46.664-162.379.066-168.229 136.985-305.096 305.339-305.096 81.521.031 158.154 31.811 215.779 89.482s89.342 134.332 89.312 215.859c-.066 168.243-136.984 305.118-305.209 305.118zm167.415-228.515c-9.177-4.591-54.286-26.782-62.697-29.843-8.41-3.062-14.526-4.592-20.645 4.592-6.115 9.182-23.699 29.843-29.053 35.964-5.352 6.122-10.704 6.888-19.879 2.296-9.176-4.591-38.74-14.277-73.786-45.526-27.275-24.319-45.691-54.359-51.043-63.543-5.352-9.183-.569-14.146 4.024-18.72 4.127-4.109 9.175-10.713 13.763-16.069 4.587-5.355 6.117-9.183 9.175-15.304 3.059-6.122 1.529-11.479-.765-16.07-2.293-4.591-20.644-49.739-28.29-68.104-7.447-17.886-15.013-15.466-20.645-15.747-5.346-.266-11.469-.322-17.585-.322s-16.057 2.295-24.467 11.478-32.113 31.374-32.113 76.521c0 45.147 32.877 88.764 37.465 94.885 4.588 6.122 64.699 98.771 156.741 138.502 21.892 9.45 38.982 15.094 52.308 19.322 21.98 6.979 41.982 5.995 57.793 3.634 17.628-2.633 54.284-22.189 61.932-43.615 7.646-21.427 7.646-39.791 5.352-43.617-2.294-3.826-8.41-6.122-17.585-10.714z"></path>
                    </g>
                </svg>

            </div>
        </a>

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
        <script type="text/javascript">
            var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
            (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/6250219ec72df874911e1df9/1g04g6l1u';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
            })();
        </script>
        @livewireScripts
        @vite(['resources/js/app.js'])
    </body>
</html>
