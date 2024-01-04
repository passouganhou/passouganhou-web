<x-bf-base-layout>
    <x-slot name="title">Home</x-slot>
    <x-slot name="main">
        @php($sectionVerticalPadding = 'pt-24 pb-8')
        <section class="overflow-hidden pt-8 sm:pt-16 pb-4 sm:pb-12 lg:py-48 xl:py-64 2xl:py-40 bg-fixed bg-black bg-center bg-no-repeat bg-cover text-white" style="background-image: url({{Vite::asset('resources/images/bf/bg-black.webp')}});">
            <div class="container flex flex-col lg:flex-row justify-between {{$sectionVerticalPadding}}">
                <div class="lg:w-6/12 md:text-center lg:text-start">
                    <div class="md:pr-10 lg:pr-4">
                        <h1 class="font-bold text-3xl sm:text-4xl md:text-4xl lg:text-4xl xl:text-5xl sm:py-2">Promoção de verdade você só encontra na Passou Ganhou.</h1>
                    </div>
                    <div class="flex flex-col w-full sm:w-10/12 lg:w-full">
                        <a href="#promova" class="inline-flex my-2 border border-white py-1 pr-2 pl-1 gap-3 hover:gap-6 hover:bg-passou-cyan transition-all">
                            <img class="self-center w-12 sm:w-16 bg-passou-cyan px-2 py-1" src="{{Vite::asset('resources/images/icon-coin-hand.svg')}}" alt="">
                            <span class="self-center text-xl sm:text-3xl">Promo pra quem vende</span>
                        </a>
                        <a href="#promocoes" class="inline-flex my-2 border border-white py-1 pr-2 pl-1 gap-3 hover:gap-6 hover:bg-passou-magenta transition-all group">
                            <img class="self-center w-12 sm:w-16 bg-passou-magenta px-2 py-1" src="{{Vite::asset('resources/images/icon-coins-stars.svg')}}" alt="">
                            <span class="self-center text-xl sm:text-3xl">Promo pra quem compra</span>
                        </a>
                    </div>
                </div>
                <div class="lg:w-6/12 lg:flex lg:flex-col">
                    <div class="flex flex-row lg:fixed pt-20">
                        <picture
                            id="hero-section-mockup-1"
                            class="self-center relative bottom-0 lg:-m-20 2xl:-m-10"
                            transform: translate3d(0px, 0px, 10px);>
                            <source media="(max-width: 640px)" srcset="{{ Vite::asset('resources/images/bf/App_Mockup_1.webp') }}">
                            <source media="(max-width: 768px)" srcset="{{ Vite::asset('resources/images/bf/App_Mockup_1.webp') }}">
                            <source media="(max-width: 1024px)" srcset="{{ Vite::asset('resources/images/bf/App_Mockup_1.webp') }}">
                            <source media="(min-width: 1025px)" srcset="{{ Vite::asset('resources/images/bf/App_Mockup_1.webp') }}">
                            <img
                                class=""
                                src="{{ Vite::asset('resources/images/bf/App_Mockup_1.webp') }}"
                                alt="Mockup Passou Ganhou">
                        </picture>
                        <picture
                            id="hero-section-mockup-2"
                            class="self-center relative bottom-16 lg:-m-20 2xl:-m-10">
                            <source media="(max-width: 640px)" srcset="{{ Vite::asset('resources/images/bf/App_Mockup_2.webp') }}">
                            <source media="(max-width: 768px)" srcset="{{ Vite::asset('resources/images/bf/App_Mockup_2.webp') }}">
                            <source media="(max-width: 1024px)" srcset="{{ Vite::asset('resources/images/bf/App_Mockup_2.webp') }}">
                            <source media="(min-width: 1025px)" srcset="{{ Vite::asset('resources/images/bf/App_Mockup_2.webp') }}">
                            <img
                                class=""
                                src="{{ Vite::asset('resources/images/bf/App_Mockup_2.webp') }}"
                                alt="Mockup Passou Ganhou">
                        </picture>
                    </div>
                </div>
            </div>

            <marquee hspace="0"
                     class="absolute bottom-[25%] sm:bottom-[5%] lg:bottom-[15%] xl:bottom-[12%] 2xl:bottom-[20%] ml-[-1rem] uppercase border-y border-passou-cyan py-1 text-base sm:text-lg"
                     style="transform: rotate(-7.5deg);">
                <div class="ml-[-60%]">
                    @for($i = 0; $i < 16; $i++)
                    <span class="drop-shadow-xl font-bold text-passou-cyan">Baixe o app</span>
                    <span class="drop-shadow-xl">Baixe o app</span>
                    @endfor
                </div>
            </marquee>

        </section>
        <section class="relative">
            <div class="bg-white text-black pt-20 lg:pb-20 xl:pt-24 xl:pb-28">
                <div class="container">
                    <div class="w-full lg:w-6/12 xl:w-7/12 text-center md:text-start">
                        <h2 class="text-3xl sm:text-4xl xl:text-5xl font-bold"><span class="overline decoration-passou-cyan decoration-8">Quem</span> vende, lucra.<br> Quem compra, economiza.</h2>
                        <p class="py-5 text-xl sm:text-2xl xl:text-3xl">
                            É real, oficial! Passou Ganhou é a primeira plataforma que conecta lojas e clientes, do digital ao físico.
                        </p>
                    </div>
                </div>
            </div>
            <div class="md:container bg-white">
                <div id="section2Bg" class="relative md:p-24 lg:p-0 md:mb-12 lg:mb-0 lg:w-[500px] md:h-[500px] lg:h-[600px] lg:-mt-[25%] lg:float-right bg-no-repeat bg-contain" style="background-image: url('{{ Vite::asset('resources/images/logo-simplificada.svg') }}')">
                    <img class="" src="{{Vite::asset('resources/images/bf/section-2-front.webp')}}" id="section2Image" loading="lazy">
                </div>
            </div>
            <div class="bg-black bg-fixed bg-cover text-white py-8" style="background-image: url('{{Vite::asset('resources/images/bf/Lines_Faixa3.svg')}}')">
                <!-- Fundo preto -->
                <div class="container">
                    <div class="w-full lg:w-6/12 py-4 sm:py-8">
                        <!-- Texto, ocupar somente o lado esquerdo -->
                        <h2 class="text-2xl xl:text-4xl h-24 sm:text-4xl font-bold w-10/12 sm:w-full">Passou Ganhou é <span id="typewitterOne"></span></h2>
                        <p class="py-5 text-base sm:text-2xl xl:text-3xl">
                            A tecnologia exclusiva e disruptiva, CND-RS, impulsiona o empreendedorismo, gerando valor aos estabelecimentos comerciais, promove a inclusão financeira e fomenta o consumo consciente.
                        </p>
                    </div>
                </div>
                <div class="container md:h-[30rem] lg:h-[28rem] text-center sm:text-start text-black flex flex-col md:flex-row gap-4 py-4 md:py-8 justify-center items-center sm:justify-between">
                    <div class="bg-white h-full sm:h-auto xl:h-full p-4 sm:p-8 flex flex-col gap-4 sm:gap-6 w-9/12 sm:w-10/12 md:w-1/2 lg:w-5/12 justify-between">
                        <h3 class="text-lg sm:text-3xl xl:text-4xl font-bold">Para o comerciante:</h3>
                        <p class="text-sm sm:text-xl xl:text-2xl">Anuncie seus produtos, alcance e fidelize novos clientes, com a Máquina de Anúncios Inteligentes (MAI-910).</p>
                        <x-btn-default href="https://api.whatsapp.com/send?phone=558000001678&text=Ol%C3%A1!%20Quero%20saber%20mais%20sobre%20a%20Maquininha%20de%20An%C3%BAncios%20Inteligentes%2C%20como%20fa%C3%A7o%20para%20come%C3%A7ar%20a%20usar%3F" target="_blank" rel="noopener noreferrer" class="normal-case whitespace-nowrap sm:pl-10 pl-5 sm:pr-8 pr-4 font-medium pb-5 sm:text-2xl text-sm font-segoe-ui rounded-none" :bg="true">
                            Peça a sua!
                        </x-btn-default>
                    </div>
                    <div class="bg-white h-full sm:h-auto xl:h-full p-4 sm:p-8 flex flex-col gap-4 sm:gap-6 w-9/12 sm:w-10/12 md:w-1/2 lg:w-5/12 justify-between text-center">
                        <h3 class="text-lg sm:text-3xl xl:text-4xl font-bold">Para o consumidor:</h3>
                        <p class="text-sm sm:text-xl xl:text-2xl">Compre com descontos exclusivos pelo App Passou Ganhou.</p>
                        <div class="flex flex-col gap-2 items-center justify-center w-full py-8">
                            <a class="w-fit" href="https://play.google.com/store/apps/details?id=passou.ganhou.personal" target="_blank">
                                <img class="w-70 sm:w-50 xl:w-60" src="{{Vite::asset('resources/images/bf/googleplay2.svg')}}" alt="" loading="lazy">
                            </a>
                            <a class="w-fit" href="https://apps.apple.com/br/app/passou-ganhou/id6472958736" target="_blank">
                                <img class="w-70 sm:w-50 xl:w-60" src="{{Vite::asset('resources/images/bf/appstore.svg')}}" alt="" loading="lazy">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="relative py-20 bg-white overflow-hidden">
            <!--
                2 seções, uma branca e uma preta
                Na seção de cima há um formulário de cadastro a direita e um texto a esquerda
                Na seção de baixo, há um texto a esquerda e uma imagem a direita. Há uma imagem entre as seções para transição
            -->
            <div class="flex flex-col lg:flex-row justify-between container pb-12">
                <!-- Fundo branco -->
                <div class="flex flex-col gap-4 md:gap-8 w-full  py-0 md:py-8 lg:py-0 lg:w-1/2">
                    <div class="w-full lg:w-10/12">
                        <h2 class="text-3xl sm:text-4xl xl:text-5xl xl:pt-3 font-bold"><span id="promova" class="overline decoration-passou-cyan decoration-8">Promo</span>(va)<br>sua empresa<br>Peça a sua MAI-910<br>e anuncie grátis!</h2>
                        <p class="text-base sm:text-xl xl:text-2xl py-4">
                            Anuncie seus produtos e serviços gratuitamente no app Passou Ganhou Empresas, para potencializar seus lucros.
                        </p>
                    </div>
                    <div class="w-12/12 flex flex-col gap-6">
                        <div class="ml-4 xl:ml-3 bg-black inline-flex px-3 py-3 sm:py-1 sm:px-6 my-1 w-10/12"  id="parallax-element-1" style="translate: none; rotate: none; scale: none; transform: translate(-16px, 0px);">
                            <span class="text-4xl sm:text-6xl text-passou-cyan font-bold px-3 self-center">1</span>
                            <p class="text-sm sm:text-base text-white self-center leading-none sm:leading-normal">Anúncios por geolocalização: alcance e atraia pessoas que estão próximas à sua loja.</p>
                        </div>
                        <div class="ml-8 xl:ml-6 bg-black inline-flex px-3 py-3 sm:py-1 sm:px-6 my-1 w-10/12"  id="parallax-element-2" style="translate: none; rotate: none; scale: none; transform: translate(-18px, 0px);">
                            <span class="text-4xl sm:text-6xl text-passou-cyan font-bold px-3 self-center">2</span>
                            <p class="text-sm sm:text-base text-white self-center leading-none sm:leading-normal">Oportunidade de negócio: aumente seus lucros, reduza estoque e melhore o movimento em dias ociosos, criando anúncios exclusivos.</p>
                        </div>
                        <div class="ml-12 xl:ml-9 bg-black inline-flex px-3 py-3 sm:py-1 sm:px-6 my-1 w-10/12"  id="parallax-element-3" style="translate: none; rotate: none; scale: none; transform: translate(-20px, 0px);">
                            <span class="text-4xl sm:text-6xl text-passou-cyan font-bold px-3 self-center">3</span>
                            <p class="text-sm sm:text-base text-white self-center leading-none sm:leading-normal">Programa de pontos: fidelize clientes, trocando pontos acumulados no app, por descontos.</p>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col py-8 md:py-0 w-full lg:w-6/12">
                    <div class="p-3 border border-gray-900 bg-white">
                        <div class="bg-black flex flex-col px-8 py-4">
                            <div>
                                <div class="inline-flex text-white gap-4">
                                    <div class="self-center">
                                        <img src="{{ Vite::asset('resources/images/logo-simplificada.svg') }}" alt="Passou Ganhou Logo" class="p-1 max-w-ss" loading="lazy">
                                    </div>
                                    <p class="self-center">
                                        Preencha o formulário<br>e garanta já a sua!
                                    </p>
                                </div>
                            </div>
                            <livewire:contact-forms.dynamic />
                        </div>
                    </div>
                </div>
            </div>
            <div id="partnerDiv" class="bg-black bg-cover bg-fixed {{$sectionVerticalPadding}}" style="background-image: url('{{Vite::asset('resources/images/bf/Lines_Faixa5.svg')}}')" loading="lazy">
                <div class="container flex flex-col-reverse md:flex-row justify-between">
                    <div class="flex flex-col w-full md:w-6/12 h-100 justify-between">
                        <div class="text-white h-full flex flex-col justify-evenly py-8">
                            <h2 class="text-3xl md:text-4xl xl:text-5xl font-bold">Somos a real parceira de quem empreende!</h2>
                        </div>
                        <div class="flex flex-col" id="partnershipSection" style="translate: none; rotate: none; scale: none; transform: translate(16px, -8px);">
                            <div class="bg-white inline-flex px-6 my-2 w-fit">
                                <span class="text-4xl sm:text-6xl text-passou-cyan font-bold px-3 self-center">1</span>
                                <p class="text-black text-sm sm:text-base xl:text-xl self-center">As melhores taxas do mercado.</p>
                            </div>
                            <div class="bg-white inline-flex px-6 my-2 w-fit">
                                <span class="text-4xl sm:text-6xl text-passou-cyan font-bold px-3 self-center">2</span>
                                <p class="text-black text-sm sm:text-base xl:text-xl self-center">Sistema de pontos exclusivo e livre taxa adicional.</p>
                            </div>
                            <div class="bg-white inline-flex px-6 my-2 w-fit">
                                <span class="text-4xl sm:text-6xl text-passou-cyan font-bold px-3 self-center">3</span>
                                <p class="text-black text-sm sm:text-base xl:text-xl self-center">Plataforma de anúncios.</p>
                            </div>
                            <div class="bg-white inline-flex px-6 my-2 w-fit">
                                <span class="text-4xl sm:text-6xl text-passou-cyan font-bold px-3 self-center">4</span>
                                <p class="text-black text-sm sm:text-base xl:text-xl self-center">Parcele em até 12x no crédito.</p>
                            </div>
                            <div class="bg-white inline-flex px-6 my-2 w-fit">
                                <span class="text-4xl sm:text-6xl text-passou-cyan font-bold px-3 self-center">5</span>
                                <p class="text-black text-sm sm:text-base xl:text-xl self-center">Aceite as principais bandeiras e carteiras digitais.</p>
                            </div>
                            <div class="bg-white inline-flex px-6 my-2 w-fit">
                                <span class="text-4xl sm:text-6xl text-passou-cyan font-bold px-3 self-center">6</span>
                                <p class="text-black text-sm sm:text-base xl:text-xl self-center">Sem burocracia, plano de vendas ou domicílio bancário.</p>
                            </div>
                            <x-btn-default href="#promova" rel="noopener noreferrer" class="mt-16 mb-8 normal-case whitespace-nowrap sm:pl-10 pl-5 sm:pr-8 pr-4 font-medium pt-4 pb-5 sm:text-2xl text-lg font-segoe-ui mb-4 rounded-none" :bg="true">
                                Peça sua MAI-910 e anuncie grátis
                            </x-btn-default>
                        </div>
                    </div>
                    <div class="flex flex-col w-10/12 md:w-5/12 self-center items-start justify-start mt-[-11rem] gap-4">
                        <div class="">
                            <img src="{{Vite::asset('resources/images/bf/maquininha.webp')}}" alt="" id="section3Image">
                        </div>
                        <div class="hidden sm:block px-12">
                            <img src="{{Vite::asset('resources/images/bf/venda.webp')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="bg-white relative" id="exclusivePromotionsSection">
            <div class="flex flex-col sm:flex-row sm:max-h-[100vh] {{$sectionVerticalPadding}} container">
                <div class="w-full sm:w-6/12 xl:w-7/12 flex flex-col justify-around">

                    <div>
                        <h2 class="text-3xl sm:text-4xl xl:text-5xl w-full sm:w-10/12 font-bold"><span class="overline decoration-passou-magenta decoration-8" id="promocoes">Promo</span>ções exclusivas para você!</h2>
                        <p class="text-xl xl:text-2xl py-4">
                            Confira o app Passou Ganhou, seu app de descontos, e economize!
                        </p>
                        <p class="text-xl xl:text-2xl py-4">
                            Baixe o aplicativo e confira ofertas exclusivas.
                        </p>
                        <p class="text-xl xl:text-2xl py-4">
                            Acumule pontos a cada compra e troque por descontos. Não é cashback. É promoção real oficial!
                        </p>
                    </div>

                    <div class="flex flex-row gap-2 justify-around">
                        <a class="w-fit" href="https://play.google.com/store/apps/details?id=passou.ganhou.personal" target="_blank">
                            <img class="w-40 md:w-60 xl:w-10/12" src="{{Vite::asset('resources/images/bf/googleplay2.svg')}}" alt="" loading="lazy">
                        </a>
                        <a class="w-fit" href="https://apps.apple.com/br/app/passou-ganhou/id6472958736" target="_blank">
                            <img class="w-40 md:w-60 xl:w-10/12" src="{{Vite::asset('resources/images/bf/appstore.svg')}}" alt="" loading="lazy">
                        </a>
                    </div>

                </div>
                <div class="w-full sm:w-6/12">
                    <img src="{{Vite::asset('resources/images/bf/Mockup_Iphone_app.webp')}}" class="max-h-[60vh] sm:max-h-[90vh]" id="mockupIphoneApp" alt=""  style="translate: none; rotate: none; scale: none; transform: translate(0px, 50%);">
                </div>
            </div>
        </section>
        <section class="relative bg-gray-200 {{$sectionVerticalPadding}} sm:px-0 px-6">
            <div class="flex flex-col sm:flex-row container sm:justify-between sm:gap-0 gap-4">
                <div class="flex flex-col w-full sm:w-5/12">
                    <img src="{{Vite::asset('resources/images/bf/img-ebw-call.webp')}}" loading="lazy" alt="">
                </div>
                <div class="flex flex-col w-full sm:w-6/12 text-center sm:text-start sm:justify-evenly">
                    <div>
                        <h2 class="text-3xl sm:text-4xl w-full sm:w-10/12 font-bold">Passou Ganhou é uma solução EBW Bank,</h2>
                        <p class="text-2xl sm:text-4xl w-full sm:w-10/12 py-4">
                            por isso, somos assim, diferentes.
                        </p>
                    </div>
                    <x-btn-default href="https://ebwbank.com.br/portal-do-empreendedor" target="_blank" rel="noopener noreferrer" class="normal-case whitespace-nowrap sm:pl-10 pl-5 sm:pr-8 pr-4 font-medium pt-4 pb-5 sm:text-2xl text-lg font-segoe-ui mb-4 rounded-none bg-red-600 hover:bg-red-700" :bg="true">
                        Conheça a EBW Bank
                    </x-btn-default>
                </div>
            </div>
        </section>
        <section class="relative bg-black bg-fixed bg-cover text-white text-center flex flex-col pt-12 pb-8" id="contactSection" style="background-image: url('{{Vite::asset('resources/images/bf/Lines_Faixa8.svg')}}')">
            <!--
                Seção preta com texto centralizado, e na parte inferior os contatos
            -->
            <!-- Fundo preto -->
            <div class="container w-full lg:w-9/12">
                <div class="my-8 flex flex-col gap-10">
                    <h2 class="text-3xl sm:text-4xl font-bold">Precisou? É só chamar!</h2>
                    <hr class="border-t-8 border-passou-cyan w-32 self-center text-center">
                    <p class="text- sm:text-2xl py-4">
                        Quer adquirir sua Passou Ganhou, tirar dúvidas ou precisa de alguma ajuda com a sua Máquina de Anúncios Inteligentes, ou Aplicativo, fale conosco. Prezamos por um atendimento rápido, prático e transparente.
                    </p>
                </div>
                <div class="my-8 flex flex-col items-center gap-2">
                    <a href="tel:08000001678" class="font-bold text-4xl w-fit">0800 0001 678</a>
                    <x-btn-default href="https://api.whatsapp.com/send?phone=558000001678" target="_blank" rel="noopener noreferrer" class="inline-flex whitespace-nowrap normal-case whitespace-nowrap sm:pl-10 pl-5 sm:pr-8 pr-4 font-medium pt-4 pb-5 sm:text-2xl text-lg font-segoe-ui mb-4 rounded-none" :bg="true">
                        <div class="inline-flex gap-2">
                            <svg class="w-8 self-center" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="none" d="M0 0h24v24H0z"></path><path d="M7.25361 18.4944L7.97834 18.917C9.18909 19.623 10.5651 20 12.001 20C16.4193 20 20.001 16.4183 20.001 12C20.001 7.58172 16.4193 4 12.001 4C7.5827 4 4.00098 7.58172 4.00098 12C4.00098 13.4363 4.37821 14.8128 5.08466 16.0238L5.50704 16.7478L4.85355 19.1494L7.25361 18.4944ZM2.00516 22L3.35712 17.0315C2.49494 15.5536 2.00098 13.8345 2.00098 12C2.00098 6.47715 6.47813 2 12.001 2C17.5238 2 22.001 6.47715 22.001 12C22.001 17.5228 17.5238 22 12.001 22C10.1671 22 8.44851 21.5064 6.97086 20.6447L2.00516 22ZM8.39232 7.30833C8.5262 7.29892 8.66053 7.29748 8.79459 7.30402C8.84875 7.30758 8.90265 7.31384 8.95659 7.32007C9.11585 7.33846 9.29098 7.43545 9.34986 7.56894C9.64818 8.24536 9.93764 8.92565 10.2182 9.60963C10.2801 9.76062 10.2428 9.95633 10.125 10.1457C10.0652 10.2428 9.97128 10.379 9.86248 10.5183C9.74939 10.663 9.50599 10.9291 9.50599 10.9291C9.50599 10.9291 9.40738 11.0473 9.44455 11.1944C9.45903 11.25 9.50521 11.331 9.54708 11.3991C9.57027 11.4368 9.5918 11.4705 9.60577 11.4938C9.86169 11.9211 10.2057 12.3543 10.6259 12.7616C10.7463 12.8783 10.8631 12.9974 10.9887 13.108C11.457 13.5209 11.9868 13.8583 12.559 14.1082L12.5641 14.1105C12.6486 14.1469 12.692 14.1668 12.8157 14.2193C12.8781 14.2457 12.9419 14.2685 13.0074 14.2858C13.0311 14.292 13.0554 14.2955 13.0798 14.2972C13.2415 14.3069 13.335 14.2032 13.3749 14.1555C14.0984 13.279 14.1646 13.2218 14.1696 13.2222V13.2238C14.2647 13.1236 14.4142 13.0888 14.5476 13.097C14.6085 13.1007 14.6691 13.1124 14.7245 13.1377C15.2563 13.3803 16.1258 13.7587 16.1258 13.7587L16.7073 14.0201C16.8047 14.0671 16.8936 14.1778 16.8979 14.2854C16.9005 14.3523 16.9077 14.4603 16.8838 14.6579C16.8525 14.9166 16.7738 15.2281 16.6956 15.3913C16.6406 15.5058 16.5694 15.6074 16.4866 15.6934C16.3743 15.81 16.2909 15.8808 16.1559 15.9814C16.0737 16.0426 16.0311 16.0714 16.0311 16.0714C15.8922 16.159 15.8139 16.2028 15.6484 16.2909C15.391 16.428 15.1066 16.5068 14.8153 16.5218C14.6296 16.5313 14.4444 16.5447 14.2589 16.5347C14.2507 16.5342 13.6907 16.4482 13.6907 16.4482C12.2688 16.0742 10.9538 15.3736 9.85034 14.402C9.62473 14.2034 9.4155 13.9885 9.20194 13.7759C8.31288 12.8908 7.63982 11.9364 7.23169 11.0336C7.03043 10.5884 6.90299 10.1116 6.90098 9.62098C6.89729 9.01405 7.09599 8.4232 7.46569 7.94186C7.53857 7.84697 7.60774 7.74855 7.72709 7.63586C7.85348 7.51651 7.93392 7.45244 8.02057 7.40811C8.13607 7.34902 8.26293 7.31742 8.39232 7.30833Z"></path></svg>
                            <span class="self-center">Chame pelo Whatsapp</span>
                        </div>
                    </x-btn-default>
                    <p>Segunda a Sexta - 8h às 20h</p>
                    <p>Sábados, domingos e feriados - 10h às 16h</p>
                </div>
            </div>
            <div class="container flex flex-col lg:flex-row gap-4 lg:gap-0 justify-around mt-8 pb-12" id="contactsWrapper">
                <!-- Botões de contato -->
                <a href="mailto:vendas@passouganhou.com.br" class="bg-black border border-white px-8 py-4" id="contactVendas">vendas@passouganhou.com.br</a>
                <a href="mailto:suporte@passouganhou.com.br" class="bg-black border border-white px-8 py-4" id="contactSuporte">suporte@passouganhou.com.br</a>
                <a href="mailto:cac@passouganhou.com.br" class="bg-black border border-white px-8 py-4" id="contactCac">cac@passouganhou.com.br</a>
            </div>
        </section>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollToPlugin.min.js"></script>
        <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
        <script>
            var typed = new Typed('#typewitterOne', {
                strings: ['Máquina de Anúncios Inteligentes', 'Aplicativo de Promoção', 'Plataforma de Anúncios', 'Tecnologia'],
                typeSpeed: 30,
                backSpeed: 30,
                backDelay: 1000,
                loop: true,
                loopCount: Infinity,
            });
        </script>
        <script>
            const isMobile = window.innerWidth < 768;
            gsap.registerPlugin(ScrollTrigger)
            const mockTrigger = ScrollTrigger.create({
                trigger: "#mockupDownloadAppBtn",
                start: "top 90%",
                end: "bottom 30%",
                toggleActions: "play none none none",
                onEnter: () => {
                    gsap.to("#mockupIphoneApp", {
                        y: 0,
                        scrollTrigger: {
                            trigger: "#mockupIphoneApp",
                        },
                    });
                },
                onLeaveBack: () => {
                    gsap.to("#mockupIphoneApp", {
                        //duration: 3 seconds,
                        y: 100,
                        scrollTrigger: {
                            trigger: "#mockupIphoneApp",
                        },
                    });
                },
            });

            gsap.to("#contactsWrapper", {
                y: "-50",
                scrollTrigger: {
                    trigger: "#contactSection",
                    scrub: true
                },
            });

            gsap.to("#contactCac", {
                x: "-10",
                scrollTrigger: {
                    trigger: "#contactSection",
                    scrub: true
                },
            });

            gsap.to("#contactVendas", {
                x: "10",
                scrollTrigger: {
                    trigger: "#contactSection",
                    scrub: true
                },
            });

            gsap.to("#hero-section-mockup-1", {
                x: 100,
                y: -100,
                scrollTrigger: {
                    trigger: "#hero-section-mockup-1",
                    scrub: true
                },
            });

            gsap.to("#hero-section-mockup-2", {
                x: -100,
                y: 100,
                scrollTrigger: {
                    trigger: "#hero-section-mockup-2",
                    scrub: true
                },
            });

            gsap.to("#parallax-element-1", {
                x: 0,
                scrollTrigger: {
                    trigger: "#parallax-element-1",
                    scrub: true
                },
            });

            gsap.to("#parallax-element-2", {
                x: 0,
                scrollTrigger: {
                    trigger: "#parallax-element-2",
                    scrub: true
                },
            });
            gsap.to("#parallax-element-3", {
                x: 0,
                scrollTrigger: {
                    trigger: "#parallax-element-3",
                    scrub: true
                },
            });
            let section2ImageY = isMobile ? -80 : -150;
            gsap.to("#section2Image", {
                x: 0,
                y: section2ImageY,
                scrollTrigger: {
                    trigger: "#section2Image",
                    scrub: true
                },
            });

            gsap.to("#section2Bg", {
                x: 0,
                y: "+=50",
                scrollTrigger: {
                    trigger: "#section2Bg",
                    scrub: true
                },
            });

            gsap.to("#section3Image", {
                x: "+=50",
                y: "-=50",
                scrollTrigger: {
                    trigger: "#section3Image",
                    scrub: true
                },
            });

            let partnershipSectionX = isMobile ? "-=15" : "+=30";
            gsap.to("#partnershipSection", {
                x: partnershipSectionX,
                y: "-5",
                scrollTrigger: {
                    trigger: "#partnershipSection",
                    scrub: true
                },
            });

        </script>
        <script>
            /*window.addEventListener('load', function () {
                //const texts  = ["Promoção de verdade você só encontra na Passou Ganhou.", "Aqui é Black Friday o ano todo!", "Só aqui você encontra descontos reais e ofertas exclusivas."];
                //typeWritterEffectMultiple(texts, 'text');
                typeWritterEffect("Promoção de verdade você só encontra na Passou Ganhou.", 'text')
            })*/
            function typeWritterEffect(text, element) {
                let index = 0;
                const typingEffect = setInterval(() => {
                    const typingText = text.substring(0, index);
                    document.getElementById(element).innerHTML = typingText;
                    index++;

                    if (typingText === text) {
                        clearInterval(typingEffect);
                    }
                }, 35);
            }
            //function that writes text and deletes it then write the next text and so on, iterating through the array of texts
            function typeWritterEffectMultiple(texts, element) {
                let index = 0;
                let textIndex = 0;
                let currentText = texts[textIndex];
                let isDeleting = false;
                const typingEffect = setInterval(() => {
                    const typingText = currentText.substring(0, index);
                    document.getElementById(element).innerHTML = typingText;
                    index++;

                    if (typingText === currentText) {
                        isDeleting = true;
                        index = 0;
                        textIndex++;
                    }

                    if (isDeleting && index === 0) {
                        currentText = texts[textIndex % texts.length];
                        isDeleting = false;
                    }
                }, 35);
            }

        </script>
    </x-slot>
</x-bf-base-layout>
