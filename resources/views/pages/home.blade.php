<x-base-layout>
    <x-slot name="title">Home</x-slot>
    <x-slot name="main">
        <div class="relative"
        x-data="{playing: true, muted: true, show: false, canClose: true}"
        x-on:mousemove.throttle="show = true"
        x-on:click="show = true"
        x-init="
            $watch('show', function(v) {
                if(v) {
                    setTimeout(function() {
                        if(canClose) {
                            show = false;
                        }
                    }, 2000)
                }
            });
            $watch('canClose', function(v) {
                if(v) {
                    setTimeout(function() {
                        show = false;
                    }, 2000)
                }
            });
            $watch('playing', function(v) {
                v ? $refs.video.play() : $refs.video.pause();
            })
            $watch('muted', function(v) {
                $refs.video.muted = v;
            })
        ">
            <div
            x-show="show"
            x-on:mouseenter="canClose = false"
            x-on:mouseleave="canClose = true"
            x-transition.opacity.500ms
            class="absolute bg-black bg-opacity-40 top-2 left-2 flex px-4 py-3 rounded-lg z-10">
                <button type="button"
                class="p-2 mr-2 cursor-pointer hover:bg-opacity-10 hover:scale-110 bg-white bg-opacity-0 transition-all duration-200 rounded-md"
                x-on:click="playing = !playing"
                >
                    <x-icons name="pause" class="fill-white" width="22" height="22" x-show="playing"/>
                    <x-icons name="play" class="fill-white" width="22" height="22" x-show="!playing" />
                </button>
                <button type="button"
                class="p-2 mr-2 cursor-pointer hover:bg-opacity-10 hover:scale-110 bg-white bg-opacity-0 transition-all duration-200 rounded-md"
                x-on:click="muted = !muted">
                    <x-icons name="volume-xmark" class="fill-white" width="22" height="22" x-show="muted" />
                    <x-icons name="volume-high" class="fill-white" width="22" height="22" x-show="!muted"/>
                </button>
                <button type="button"
                class="p-2 mr-2 cursor-pointer hover:bg-opacity-10 hover:scale-110 bg-white bg-opacity-0 transition-all duration-200 rounded-md"
                x-on:click="$refs.video.currentTime = 0"
                >
                    <x-icons name="clock-rotate-left" class="fill-white" width="22" height="22"/>
                </button>
                <button type="button"
                class="p-2 cursor-pointer hover:bg-opacity-10 hover:scale-110 bg-white bg-opacity-0 transition-all duration-200 rounded-md"
                x-on:click="openFullscreen($refs.video)">
                    <x-icons name="expand" class="fill-white" width="22" height="22" />
                </button>
            </div>
            <video class="w-full h-auto" autoplay muted loop x-ref="video">
                <source src="{{ Vite::asset('resources/images/A910_Negocie_Taxas_Menor.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <script>
                function openFullscreen(elem) {
                    if (elem.requestFullscreen) {
                        elem.requestFullscreen();
                    } else if (elem.webkitRequestFullscreen) { /* Safari */
                        elem.webkitRequestFullscreen();
                    } else if (elem.msRequestFullscreen) { /* IE11 */
                        elem.msRequestFullscreen();
                    }
                }
            </script>
        </div>
        {{-- <div class="relative">
            <picture>
                <source media="(max-width: 600px)" srcset="{{ Vite::asset('resources/images/banner-home-600w.jpg') }}">
                <source media="(max-width: 1024px)" srcset="{{ Vite::asset('resources/images/banner-home-1024w.jpg') }}">
                <source media="(max-width: 1280px)" srcset="{{ Vite::asset('resources/images/banner-home-1767w.jpg') }}">
                <source media="(min-width: 1281px)" srcset="{{ Vite::asset('resources/images/banner-home.jpg') }}">
                <img
                class="w-full 2xl:min-h-[900px] object-center object-cover"
                src="{{ Vite::asset('resources/images/banner-home.jpg') }}"
                alt="Banner Passou Ganhou">
            </picture>
            <div class="inset-0 absolute 2xl:pt-32 xl:pt-20 lg:pt-16 md:pt-12 sm:pt-10 pt-6">
                <div class="container">
                    <h1 class="2xl:text-4xl xl:text-4xl font-bold sm:text-2xl text-xl text-passou-magenta md:mb-5 mb-3">Negocie suas taxas.</h1>
                    <h2 class="2xl:text-6xl xl:text-5xl md:text-4xl font-semibold sm:text-2xl text-xl text-passou-magenta md:mb-12 mb-5">
                        Cada <b>cliente</b> é único.<br>
                        <b>Nossa proposta</b><br>
                        <b>também</b>
                    </h2>

                    <h3 class="text-white xl:text-3xl md:text-2xl sm:text-lg text-sm md:mb-12 mb-5">
                        Comece agora<br>
                        a <b>negociar</b> com<br>
                        a <b>PASSOU GANHOU.</b>
                    </h3>

                    <a href="{{ route('peca-maquininha.index') }}" class="font-semibold text-sm sm:px-6 px-3 sm:shadow-none shadow-md bg-passou-magenta text-white py-3 uppercase transition-all duration-200 cursor-pointer hover:bg-passou-cyan">
                        Quero negociar minhas taxas
                    </a>
                </div>
            </div>
        </div> --}}

        <section class="pt-10 2xl:pt-20 2xl:bg-[length:320px] bg-[length: 270px] bg-maquininhas bg-no-repeat" style="background-image: url({{ Vite::asset('resources/images/detalhe-maquininhas.png') }})">
            <div class="container mx-auto px-4">
                <div class="mb-20">
                    <h2 class="md:text-3xl text-2xl leading-tight text-center text-passou-magenta mb-6 font-segoe-ui">
                        A <span class="text-passou-cyan font-bold">maquininha ideal</span> para o micro, pequeno, médio e gigante.
                    </h2>
                </div>

                <div class="mb-40">
                    <div class="flex flex-wrap">
                        <div class="w-full sm:w-6/12 lg:w-3/12 lg:mb-0 mb-20">
                            <x-maquininha name="Enjoy" image="{{ Vite::asset('resources/images/machine-enjoy.png') }}">
                                <x-slot name="list" class="bg-passou-magenta md:left-16">
                                    <ul class="list-disc  md:whitespace-nowrap text-white font-medium">
                                        <li class="md:text-lg md:leading-tight leading-tight">Maquininha leve e portátil</li>
                                        <li class="md:text-lg md:leading-tight leading-tight">Não precisa de celular</li>
                                        <li class="md:text-lg md:leading-tight leading-tight">Bateria de longa duração</li>
                                        <li class="md:text-lg md:leading-tight leading-tight">Envio de comprovante por SMS</li>
                                    </ul>
                                </x-slot>
                            </x-maquininha>
                        </div>

                        <div class="w-full sm:w-6/12 lg:w-3/12 lg:mb-0 mb-20">
                            <x-maquininha name="Revolution" image="{{ Vite::asset('resources/images/machine-revolution.png') }}">
                                <x-slot name="list" class="bg-passou-magenta md:left-0">
                                    <ul class="list-disc  text-white font-medium">
                                        <li class="md:text-lg md:leading-tight leading-tight md:whitespace-nowrap">Imprime comprovante</li>
                                        <li class="md:text-lg md:leading-tight leading-tight md:whitespace-nowrap">Permite pagamento por aproximação</li>
                                        <li class="md:text-lg md:leading-tight leading-tight">Portabilidade absoluta: ideal para pagamento dentro e fora do estabelecimento.</li>
                                    </ul>
                                </x-slot>
                            </x-maquininha>
                        </div>

                        <div class="w-full sm:w-6/12 lg:w-3/12 lg:mb-0 mb-20">
                            <x-maquininha name="Ultra" image="{{ Vite::asset('resources/images/machine-ultra.png') }}">
                                <x-slot name="list" class="bg-passou-magenta md:-left-6">
                                    <ul class="list-disc text-white font-medium">
                                        <li class="md:text-lg md:leading-tight leading-tight md:whitespace-nowrap">Design compacto e moderno</li>
                                        <li class="md:text-lg md:leading-tight leading-tight md:whitespace-nowrap">Permite pagamento por QRCode e aproximação</li>
                                        <li class="md:text-lg md:leading-tight leading-tight">Portabilidade absoluta: ideal para pagamento dentro e fora do estabelecimento.</li>
                                        <li class="md:text-lg md:leading-tight leading-tight">Conectividade total: 4G, Wi-Fi</li>
                                    </ul>
                                </x-slot>
                            </x-maquininha>
                        </div>

                        <div class="w-full sm:w-6/12 lg:w-3/12 lg:mb-0 mb-20">
                            <x-maquininha name="TEF" image="{{ Vite::asset('resources/images/machine-tef.png') }}">
                                <x-slot name="list" class="bg-passou-magenta 2xl:-left-52 md:-left-96">
                                    <ul class="list-disc text-white font-medium">
                                        <li class="md:text-lg md:leading-tight leading-tight">Utilizada para TEF ou soluções de pagamentos proprietários, como bancos ou cooperativas.</li>
                                        <li class="md:text-lg md:leading-tight leading-tight">Possui processador de alta performace, leitores de tarja magnéticos, smart card e, ainda, cabo DUAL (SERIAL + USB).</li>
                                        <li class="md:text-lg md:leading-tight leading-tight md:whitespace-nowrap">Feita para garantir total segurança em todas as transações.</li>
                                    </ul>
                                </x-slot>
                            </x-maquininha>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center flex-wrap pt-10">
                    <x-btn-magenta href="{{ route('peca-maquininha.index') }}" :chevronRight="true" :bg="true" class="lg:mx-20 sm:mx-4 lg:mb-0 mb-5  font-bold font-segoe-ui pb-4 sm:px-10 px-8 sm:text-2xl text-lg">
                        Peça pelo Site
                    </x-btn-magenta>
                    <x-btn-default href="https://api.whatsapp.com/send?phone=5561996044061&text=Ol%C3%A1%2C%20tudo%20bem%3F%20Bem-vindo%20%C3%A0%20PASSOU%20GANHOU.%20Meu%20nome%20%C3%A9%20Charles%2C%20do%20time%20de%20novos%20neg%C3%B3cios.%20Conta%20pra%20mim%20seu%20nome%2C%20por%20favor%3F" :chevronRight="true" :bg="true" class="lg:mx-20 sm:mx-4 sm:px-10 px-8 font-segoe-ui font-bold sm:text-2xl text-lg pb-4">
                        Peça pelo Whats
                    </x-btn-default>
                </div>

            </div>

            <div class="pt-24 flex justify-center items-start">
                <img loading="lazy" src="{{ Vite::asset('resources/images/machine-collection.png') }}" class="-mb-28" alt="Máquininhas Passou Ganhou">
            </div>
        </section>

        <section class="bg-passou-magenta-800 pt-48 pb-24">
            <div class="container">
                <h2 class="sm:text-3xl text-xl text-center text-passou-cyan font-segoe-ui">Todas as bandeiras que você precisa</h2>
                <div class="flex justify-center items-center flex-wrap pt-10 mb-10">
                    <img loading="lazy" class="mx-6 mb-5" src="{{ Vite::asset('resources/images/mastercard-brand.png') }}" alt="Bandeira Mastercard">
                    <img loading="lazy" class="mx-6 mb-5" src="{{ Vite::asset('resources/images/visa-brand.png') }}" alt="Bandeira Visa">
                    <img loading="lazy" class="mx-6 mb-5" src="{{ Vite::asset('resources/images/elo-brand.png') }}" alt="Bandeira Elo">
                    <img loading="lazy" class="mx-6 mb-5" src="{{ Vite::asset('resources/images/american-express-brand.png') }}" alt="Bandeira Amex">
                    <img loading="lazy" class="mx-6 mb-5" src="{{ Vite::asset('resources/images/dinners-club-international-brand.png') }}" alt="Bandeira Dinners">
                    <img loading="lazy" class="mx-6 mb-5" src="{{ Vite::asset('resources/images/aura-brand.png') }}" alt="Bandeira Aura">
                    <img loading="lazy" class="mx-6 mb-5" src="{{ Vite::asset('resources/images/jcb-brand.png') }}" alt="Bandeira JCB">
                </div>
                {{-- <p class="font-segoe-ui text-sm text-center text-white leading-snug">
                    Bandeiras: Mastercard, Visa e Elo nas funções crédito e débito,<br>
                    nos chips; Amex, Dinners, Aura e JCB; crédito à vistta, crédito parcelado emissor e débito
                </p> --}}
            </div>
        </section>

        <section class="bg-cover bg-center bg-no-repeat md:pt-40 pt-20 md:pb-20 pb-12 min-h-160" style="background-image: url({{ Vite::asset('resources/images/banner-sacolas.jpg') }})">
            <div class="container">
                <h2 class="md:text-4xl sm:text-2xl text-lg tracking-tight text-passou-magenta font-segoe-ui mb-10 leading-snug">
                    Venda com a <span class="font-bold uppercase">Passou Ganhou</span><br>
                    e transforme seus clientes em fãs
                </h2>

                <p class="md:text-4xl sm:text-2xl text-lg tracking-tight text-passou-magenta font-segoe-ui md:mb-108 mb-40 leading-snug">
                    Quem é <span class="font-bold uppercase">Passou Ganhou</span> sai na frente.<br>
                    Não tem essa de plano de fidelidade ou<br>
                    metas de vendas. É o atendimento sem<br>
                    complicação que você merece.
                </p>

                <p class="max-w-2xl font-segoe-ui text-[#451d50] tracking-tight">
                    A cada um Real gasto na sua loja, seu cliente ganha 1 ponto, que pode ser trocado por descontos exclusivos. A cada um Real vendido na <b>PASSOU GANHOU</b>, você, lojista, também ganha pontos e consegue exibir seus descontos exclusivos no <b>APP PASSOU GANHOU. EM BREVE!</b>
                </p>
            </div>
        </section>

        <section class="bg-[#e9ded7] pt-16 pb-20">
            <div class="container lg:px-10 px-4">
                <h2 class="md:text-2.5xl text-xl font-bold text-passou-magenta-800 text-center font-segoe-ui tracking-tight mb-3">Com a gente não tem essa de metas de venda, plano de fidelidade ou domícilio bancário.</h2>
                <h3 class="md:text-5xl text-2xl text-center font-segoe-ui font-bold tracking-tight text-passou-magenta-800">Resumindo: sem complicação.</h3>

                <div class="flex flex-wrap justify-between items-start lg:-mx-10 px-4 pt-20">
                    <div class="md:w-4/12 sm:w-1/2 w-full mb-16 lg:px-10 px-4 flex flex-col items-center justify-start">
                        <img loading="lazy" src="{{ Vite::asset('resources/images/split-pagamento.png') }}" class="mb-4" alt="Split de Pagamento">
                        <p class="text-center lg:text-2xl text-xl font-bold text-passou-magenta tracking-tight">Split de Pagamento</p>
                    </div>
                    <div class="md:w-4/12 sm:w-1/2 w-full mb-16 lg:px-10 px-4 flex flex-col items-center justify-start">
                        <img loading="lazy" src="{{ Vite::asset('resources/images/conta-pagamento.png') }}" class="mb-4" alt="Conta Pagamento">
                        <p class="text-center lg:text-2xl text-xl font-bold text-passou-magenta tracking-tight">Conta Pagamento</p>
                    </div>
                    <div class="md:w-4/12 sm:w-1/2 w-full mb-16 lg:px-10 px-4 flex flex-col items-center justify-start">
                        <img loading="lazy" src="{{ Vite::asset('resources/images/acompanhamento.png') }}" class="mb-4" alt="Acompanhamento em tempo real de transações">
                        <p class="text-center lg:text-2xl text-xl font-bold text-passou-magenta tracking-tight">Acompanhamento em tempo real de transações</p>
                    </div>
                    <div class="md:w-4/12 sm:w-1/2 w-full mb-16 lg:px-10 px-4 flex flex-col items-center justify-start">
                        <img loading="lazy" src="{{ Vite::asset('resources/images/consultoria.png') }}" class="mb-4" alt="Consultoria empresarial e atendimento personalizado ">
                        <p class="text-center lg:text-2xl text-xl font-bold text-passou-magenta tracking-tight">Consultoria empresarial e atendimento personalizado </p>
                    </div>
                    <div class="md:w-4/12 sm:w-1/2 w-full mb-16 lg:px-10 px-4 flex flex-col items-center justify-start">
                        <img loading="lazy" src="{{ Vite::asset('resources/images/suporte-whatsapp.png') }}" class="mb-4" alt="Suporte instantâneo via WhatsApp">
                        <p class="text-center lg:text-2xl text-xl font-bold text-passou-magenta tracking-tight">Suporte instantâneo via WhatsApp</p>
                    </div>
                    <div class="md:w-4/12 sm:w-1/2 w-full mb-16 lg:px-10 px-4 flex flex-col items-center justify-start">
                        <img loading="lazy" src="{{ Vite::asset('resources/images/sem-contrato.png') }}" class="mb-4" alt="Sem contrato de fidelização">
                        <p class="text-center lg:text-2xl text-xl font-bold text-passou-magenta tracking-tight">Sem contrato de fidelização</p>
                    </div>
                </div>

                <div class="text-center">
                    <x-btn-magenta href="{{ route('peca-maquininha.index') }}" class="sm:pl-12 pl-6 sm:pr-10 pr-5 font-bold pt-5 pb-6 sm:text-2xl text-lg font-segoe-ui normal-case mb-5" :bg="true">
                        Peça sua maquininha
                       <x-slot name="icon">
                            <x-icons name="chevron-right" class="fill-white group-hover:fill-white transition-all duration-200 sm:ml-10 ml-4" width="20" height="20"/>
                        </x-slot>
                    </x-btn-magenta>

                    <p class="font-bold font-segoe-ui text-2xl text-center text-passou-magenta">Sem taxa de adesão</p>
                </div>
            </div>
        </section>

        <section class="pt-20 bg-[#eaddd7] pb-20">
            <div class="container px-6" id="portal-do-empreendedor">
                <div class="flex -mx-6 flex-wrap justify-center">
                    <div class="lg:w-1/2 sm:w-10/12 w-full px-6 mb-12 lg:mb-0 relative">
                        <h3 class="text-2xl font-segoe-ui font-bold text-passou-magenta tracking-tighter text-center leading-none mb-10 sm:px-16 px-0">Quer um portal com informações para alavancar seu negócio? Acompanhe nossos artigos e podcasts.</h3>
                        <a href="https://ebwbank.com.br/portal-do-empreendedor" target="_blank" rel="noopener noreferrer" class="group">
                            <div class="relative">
                                <img loading="lazy" class="rounded-3xl sm:shadow-[25px_15px_0_0_#461d52] shadow-[4px_4px_0_0_#461d52] group-hover:shadow-[0px_0px_0_0_#461d52] transition-all duration-200 sm:-translate-x-6 sm:-translate-y-4 group-hover:translate-x-0 group-hover:translate-y-0" src="{{ Vite::asset('resources/images/portal-do-investidor.jpg') }}" alt="Portal do Investidor">
                            </div>
                        </a>
                        <x-btn-default href="https://ebwbank.com.br/portal-do-empreendedor" target="_blank" rel="noopener noreferrer" class="sm:px-8 px-4 whitespace-nowrap absolute bottom-0 font-bold sm:text-xl text-base font-segoe-ui left-1/2 -translate-x-1/2 translate-y-1/2" :chevronRight="true">
                            Portal do Empreendedor
                        </x-btn-default>
                    </div>

                    <div class="lg:w-1/2 sm:w-10/12 w-full px-6 mb-12 lg:mb-0 relative">
                        <h3 class="text-2xl font-segoe-ui font-bold text-passou-magenta tracking-tighter text-center leading-none mb-16 sm:px-16 px-0">Conheça o grande banco por trás da incrível maquinha Passou Ganhou</h3>
                        <a  href="https://ebwbank.com.br" target="_blank" rel="noopener noreferrer" class="group">
                            <div class="relative">
                                <img loading="lazy" class="rounded-3xl sm:shadow-[25px_15px_0_0_#461d52] shadow-[4px_4px_0_0_#461d52] group-hover:shadow-[0px_0px_0_0_#461d52] transition-all duration-200 sm:-translate-x-6 sm:-translate-y-4 group-hover:translate-x-0 group-hover:translate-y-0" src="{{ Vite::asset('resources/images/conheca-a-ebw.jpg') }}" alt="Conheça a EBW">
                            </div>
                        </a>
                        <x-btn-default href="https://ebwbank.com.br" target="_blank" rel="noopener noreferrer" class="px-12 whitespace-nowrap absolute bottom-0 font-bold sm:text-xl text-base font-segoe-ui left-1/2 -translate-x-1/2 translate-y-1/2" :chevronRight="true" >
                           Conheça a EBW
                        </x-btn-default>
                    </div>
                </div>
            </div>

            <div class="container mx-auto px-4 pt-32" id="atendimento">



                <div class="flex flex-wrap justify-center -mx-4">
                    <div class="w-full md:w-6/12 lg:w-4/12 my-4 lg:my-0 px-4 pt-10">

                        <img loading="lazy" class="mx-auto block" src="{{ Vite::asset('resources/images/icon-business.png') }}" alt="Negocie as suas taxas">

                        <h4 class="text-passou-cyan font-bold my-4 text-3xl">
                            Negocie suas taxas.
                        </h4>

                        <p class="text-lg text-passou-magenta-800">
                            Com a <b>PASSOU GANHOU</b>, você tem o atendimento personalizado
                            que você merece e as taxas ideais para o seu negócio prosperar.
                        </p>

                    </div>
                    {{-- <div class="w-full md:w-6/12 lg:w-4/12 my-4 lg:my-0 px-4">
                        <div class="sm:p-6 p-4 bg-white rounded-xl flex flex-col h-full justify-between">
                            <div class="mb-8">
                                <p class="font-bold text-passou-cyan my-4 text-xl">
                                    Vendas
                                </p>
                                <p class="font-bold mb-4 text-passou-magenta-800 text-2xl">
                                    (61) 9.9604-4061
                                </p>
                                <p class="text-passou-magenta-800">
                                    Horário de atendimento: <br>
                                    <span class="font-bold">Segunda a sexta das 8h às 18h</span>
                                </p>
                            </div>
                            <div class="">
                                <div class="mb-4">
                                    <a href="mailto:vendas@passouganhou.com.br"
                                    class="flex w-full leading-none break-all px-4 justify-center items-center border-2 border-passou-cyan bg-opacity-0 hover:bg-opacity-20 bg-passou-cyan transition-opacity duration-300 rounded-full py-5">
                                        <x-icons name="envelope" class="fill-passou-magenta-800" />
                                        <span class="text-passou-magenta-800 font-segoe-ui text-[15px] font-medium tracking-wide ml-3">vendas@passouganhou.com.br</span>
                                    </a>
                                </div>
                                <div class="mb-4">

                                    <a href="https://api.whatsapp.com/send?phone=5561996044061&text=Ol%C3%A1%2C%20tudo%20bem%3F%20Bem-vindo%20%C3%A0%20PASSOU%20GANHOU.%20Meu%20nome%20%C3%A9%20Charles%2C%20do%20time%20de%20novos%20neg%C3%B3cios.%20Conta%20pra%20mim%20seu%20nome%2C%20por%20favor%3F" target="_blank" rel="noopener noreferrer" class="flex w-full leading-none justify-center items-center border-2 border-passou-cyan bg-passou-cyan hover:bg-opacity-80 transition-opacity duration-300 text-white rounded-full py-5 font-bold text-lg font-segoe-ui">
                                        Chame pelo WhatsApp!
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    {{-- <div class="w-full md:w-6/12 lg:w-4/12 my-4 lg:my-0 px-4">
                        <div class="sm:p-6 p-4 bg-white rounded-xl flex flex-col h-full justify-between">
                            <div class="mb-8">
                                <p class="font-bold text-passou-cyan my-4 text-xl">
                                    Suporte
                                </p>
                                <p class="font-bold mb-4 text-passou-magenta-800 text-2xl">
                                    (61) 9.9604-1988
                                </p>
                                <p class="text-passou-magenta-800">
                                    Horário de atendimento: <br>
                                    <span class="font-bold">Segunda a sexta das 8h às 18h</span>
                                </p>
                            </div>
                            <div class="">
                                <div class="mb-4">
                                    <a href="mailto:suporte@passouganhou.com.br"
                                    class="flex w-full leading-none break-all px-4 justify-center items-center border-2 border-passou-cyan bg-opacity-0 hover:bg-opacity-20 bg-passou-cyan transition-opacity duration-300 rounded-full py-5">
                                        <x-icons name="envelope" class="fill-passou-magenta-800" />
                                        <span class="text-passou-magenta-800 font-segoe-ui text-[15px] font-medium tracking-wide ml-3">suporte@passouganhou.com.br</span>
                                    </a>
                                </div>
                                <div class="mb-4">
                                    <a href="https://api.whatsapp.com/send?phone=5561996044061&text=Ol%C3%A1%2C%20tudo%20bem%3F%20Bem-vindo%20%C3%A0%20PASSOU%20GANHOU.%20Meu%20nome%20%C3%A9%20Charles%2C%20do%20time%20de%20novos%20neg%C3%B3cios.%20Conta%20pra%20mim%20seu%20nome%2C%20por%20favor%3F " target="_blank" rel="noopener noreferrer" class="flex w-full leading-none justify-center items-center border-2 border-passou-cyan bg-passou-cyan hover:bg-opacity-80 transition-opacity duration-300 text-white rounded-full py-5 font-bold text-lg font-segoe-ui">
                                        Chame pelo WhatsApp!
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="w-full md:w-6/12 lg:w-4/12 my-4 lg:my-0 px-4">
                        <div class="sm:p-6 p-4 bg-white rounded-xl flex flex-col h-full justify-between">
                            <div class="mb-8">
                                <p class="font-bold text-center text-passou-cyan my-4 text-xl">
                                    Fale conosco
                                </p>
                                <p class="font-bold mb-4 text-center text-passou-magenta-800 text-4xl">
                                    0800-0001-678
                                </p>
                                <p class="text-passou-magenta-800 text-center">
                                    Horário de atendimento: <br>
                                    <span class="font-bold">
                                        Segunda a Sexta-feira das 8h às 18h<br>
                                        Sábadosdas 8h às 13h
                                    </span>
                                </p>
                            </div>
                            <div class="">
                                <div class="mb-4">
                                    <a href="mailto:cac@passouganhou.com.br"
                                    class="flex w-full leading-none break-all px-4 justify-center items-center border-2 border-passou-cyan bg-opacity-0 hover:bg-opacity-20 bg-passou-cyan transition-opacity duration-300 rounded-full py-5">
                                        <x-icons name="envelope" class="fill-passou-magenta-800" />
                                        <span class="text-passou-magenta-800 font-segoe-ui text-[15px] font-medium tracking-wide ml-3">cac@passouganhou.com.br</span>
                                    </a>
                                </div>
                                <div class="mb-4">
                                    <a href="tel:08000001678" target="_blank" rel="noopener noreferrer" class="flex w-full leading-none justify-center items-center border-2 border-passou-cyan bg-passou-cyan hover:bg-opacity-80 transition-opacity duration-300 text-white rounded-full py-5 font-bold text-lg font-segoe-ui">
                                        Ligue 0800-0001-678
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </x-slot>
</x-base-layout>
