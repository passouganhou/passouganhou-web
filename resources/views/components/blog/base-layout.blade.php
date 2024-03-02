<!DOCTYPE html>
<html lang="pt-BR">
<head>
    @production
        @include('partials.gtag-head')
    @endproduction
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Passou Ganhou - {{ $title }} </title>
    <meta name="title" content="Passou Ganhou - {{ $title }}">
    <meta name="description" content="{{$metadata->description??'Negocie suas taxas. Cada cliente é único. Nossa proposta também. Comece agoraa negociar com a PASSOU GANHOU.'}}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ URL::to('/') }}">
    <meta property="og:title" content="{{$metadata->title??'Passou Ganhou'}}">
    <meta property="og:description" content="{{$metadata->description??'Negocie suas taxas. Cada cliente é único. Nossa proposta também. Comece agoraa negociar com a PASSOU GANHOU.'}}">
    <meta property="og:image" content="{{ Vite::asset('resources/images/machine-collection.png') }}">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ URL::to('/') }}/">
    <meta property="twitter:title" content="{{$metadata->title??'Passou Ganhou'}}">
    <meta property="twitter:description" content="{{$metadata->description??'Negocie suas taxas. Cada cliente é único. Nossa proposta também. Comece agoraa negociar com a PASSOU GANHOU.'}}">
    <meta property="twitter:image" content="{{ Vite::asset('resources/images/machine-collection.png') }}">
    <meta name="keywords" content="{{$metadata->keywords??'negocie taxas, cliente, maquininha de cartão, crédito, débito, passou ganhou, venda, negócios'}}">
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
    <link href="https://cdn.jsdelivr.net/npm/swiffy-slider@1.6.0/dist/css/swiffy-slider.min.css" rel="stylesheet" crossorigin="anonymous">

    <style>
        [x-cloak] {
            display: none;
        }
    </style>
    <style>



    </style>
</head>
<body class="antialiased" id="body">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N7CQCG2"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<x-bf-header :whatsapp="$settings->whatsapp" />
<main>
    {{ $main }}
</main>

<x-blog.footer />

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
    <script src="https://unpkg.com/blip-chat-widget" type="text/javascript"></script>
    <script>
        (function () {
            window.onload = function () {
                new BlipChat()
                    .withAppKey('ZWJ3YmFua3JvdXRlcjozZWM0YTNjZi04NjgwLTQ5OWEtOTU5OC02ZWVjN2JkYzA0YmU=')
                    .withButton({"color":"#01a181","icon":""})
                    .withCustomCommonUrl('https://ebwbank.chat.blip.ai/')
                    .build();
            }
        })();
    </script>

</div>
{{-- <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/6250219ec72df874911e1df9/1g04g6l1u';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
</script> --}}
@livewireScripts
@vite(['resources/js/app.js'])
<script src="https://cdn.jsdelivr.net/npm/swiffy-slider@1.6.0/dist/js/swiffy-slider.min.js" crossorigin="anonymous" defer></script>
</body>
</html>
