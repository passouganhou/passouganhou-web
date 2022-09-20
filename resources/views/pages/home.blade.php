<x-base-layout>
    <x-slot name="title">Home</x-slot>
    <x-slot name="main">
        <div class="relative">
            <img loading="lazy"
            srcset="{{ Vite::asset('resources/images/banner-home-xs.jpg') }} 640w,
            {{ Vite::asset('resources/images/banner-home-md.jpg') }} 1024w,
            {{ Vite::asset('resources/images/banner-home-lg.jpg') }} 1280px,
            {{ Vite::asset('resources/images/banner-home.jpg') }} 1281w"
            sizes="(max-width: 640px) 640px,
            (max-width: 1024px) 1024px,
            (max-width: 1280px) 1280px,
            1281px"
            class="w-full"
            src="{{ Vite::asset('resources/images/banner-home.jpg') }}"
            alt="Banner Passou Ganhou">
            <div class="inset-0 absolute 2xl:pt-32 xl:pt-20 lg:pt-16 md:pt-12 sm:pt-10 pt-6">
                <div class="container">
                    <h1 class="2xl:text-6xl xl:text-5xl md:text-4xl sm:text-2xl text-xl text-passou-magenta md:mb-5 mb-3">
                        Para <span class="font-bold">empreendedor</span><br>
                        que quer <span class="font-bold">crescer</span> com<br>
                        a <span class="font-bold">Passou Ganhou.</span>
                    </h1>

                    <h2 class="text-white xl:text-3xl md:text-2xl sm:text-lg text-sm xl:mb-40 md:mb-32 sm:mb-20 mb-4">
                        Soluções inteligentes, benefícios<br>
                        exclusivos e, claro, as melhores taxas.
                    </h2>

                    <x-btn-magenta href="#" class="font-montserrat lg:text-2xl md:text-xl text-lg font-semibold md:px-10 px-6">Peça a sua</x-btn-magenta>
                </div>
            </div>
        </div>

        <section class="pt-10 2xl:pt-20 bg-[length:320px] bg-maquininhas bg-no-repeat lg:bg-[url({{ Vite::asset('resources/images/detalhe-maquininhas.png') }})]">
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
                                <x-slot name="list">
                                    <ul class="list-disc  whitespace-nowrap text-white font-medium">
                                        <li class="text-lg leading-tight">Maquininha leve e portátil</li>
                                        <li class="text-lg leading-tight">Não precisa de celular</li>
                                        <li class="text-lg leading-tight">Bateria de longa duração</li>
                                        <li class="text-lg leading-tight">Envio de compravante por SMS</li>
                                    </ul>
                                </x-slot>
                            </x-maquininha>
                        </div>

                        <div class="w-full sm:w-6/12 lg:w-3/12 lg:mb-0 mb-20">
                            <x-maquininha name="Revolution" image="{{ Vite::asset('resources/images/machine-revolution.png') }}">
                                <x-slot name="list">
                                    <ul class="list-disc   text-white font-medium">
                                        <li class="text-lg leading-tight whitespace-nowrap">Imprime comprovante</li>
                                        <li class="text-lg leading-tight whitespace-nowrap">Permite pagamento por aproximação</li>
                                        <li class="text-lg leading-tight">Portabilidade absolute: ideal para pagamento dentro e fora do estabelecimento.</li>
                                    </ul>
                                </x-slot>
                            </x-maquininha>
                        </div>

                        <div class="w-full sm:w-6/12 lg:w-3/12 lg:mb-0 mb-20">
                            <x-maquininha name="Ultra" image="{{ Vite::asset('resources/images/machine-ultra.png') }}">
                                <x-slot name="list">
                                    <ul class="list-disc text-white font-medium">
                                        <li class="text-lg leading-tight whitespace-nowrap">Design compacto e moderno</li>
                                        <li class="text-lg leading-tight whitespace-nowrap">Permite pagamento por QRCode e aproximação</li>
                                        <li class="text-lg leading-tight">Portabilidade absolute: ideal para pagamento dentro e fora do estabelecimento.</li>
                                        <li class="text-lg leading-tight">Conectividade total: 4G, Wi-Fi</li>
                                    </ul>
                                </x-slot>
                            </x-maquininha>
                        </div>

                        <div class="w-full sm:w-6/12 lg:w-3/12 lg:mb-0 mb-20">
                            <x-maquininha name="TEF" image="{{ Vite::asset('resources/images/machine-tef.png') }}">
                                <x-slot name="list">
                                    <ul class="list-disc text-white font-medium">
                                        <li class="text-lg leading-tight">Utilizada para TEF ou soluções de pagamentos proprietários, como bancos ou cooperativas.</li>
                                        <li class="text-lg leading-tight">Possui processador de alta performace, leitores de tarja magnéticos, smart card e, ainda, cabo DUAL (SERIAL + USB).</li>
                                        <li class="text-lg leading-tight whitespace-nowrap">eita para garantir total segurança em todas as transações.</li>
                                    </ul>
                                </x-slot>
                            </x-maquininha>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center flex-wrap">
                    <x-btn-magenta href="#" :chevronRight="true" :bg="true" class="lg:mx-20 sm:mx-4 lg:mb-0 mb-5  font-bold font-segoe-ui pb-4 sm:px-10 px-8 sm:text-2xl text-lg">
                        Peça pelo Site
                    </x-btn-magenta>
                    <x-btn-default href="#" :chevronRight="true" :bg="true" class="lg:mx-20 sm:mx-4 sm:px-10 px-8 font-segoe-ui font-bold sm:text-2xl text-lg pb-4">
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
                <p class="font-segoe-ui text-sm text-center text-white leading-snug">
                    Bandeiras: Mastercard, Visa e Elo nas funções crédito e débito,<br>
                    nos chips; Amex, Dinners, Aura e JCB; crédito à vistta, crédito parcelado emissor e débito
                </p>
            </div>
        </section>

        <section class="bg-cover bg-center bg-no-repeat md:pt-40 pt-20 md:pb-20 pb-12 min-h-160" style="background-image: url({{ Vite::asset('resources/images/banner-sacolas.jpg') }})">
            <div class="container">
                <h2 class="md:text-4xl sm:text-2xl text-lg tracking-tight text-passou-magenta font-segoe-ui mb-10 leading-snug">
                    Vendas com a <span class="font-bold uppercase">Passou Ganhou</span><br>
                    e transforme seus clientes em fãs
                </h2>

                <p class="md:text-4xl sm:text-2xl text-lg tracking-tight text-passou-magenta font-segoe-ui md:mb-108 mb-40 leading-snug">
                    Quem é <span class="font-bold uppercase">Passou Ganhou</span> sai na frente.<br>
                    Não tem essa de plano de fidelidade ou<br>
                    metas de vendas. É o atendimento sem<br>
                    complicação que você merece.
                </p>

                <p class="max-w-2xl font-segoe-ui text-[#451d50] tracking-tight">
                    A cada um Real gasto na sua loja, seu cliente ganha 1 ponto, que pode ser trocado por descontos exclusivos. A cada um Real vendido na <b>PASSOU, GANHOU</b>, você, lojista, também ganha pontos e consegue exibir seus descontos exclusivos no <b>APP PASSOU GANHOU. EM BREVE!</b>
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
                    <x-btn-magenta class="sm:pl-12 pl-6 sm:pr-10 pr-5 font-bold pt-5 pb-6 sm:text-2xl text-lg font-segoe-ui normal-case mb-5" :bg="true">
                        Peça sua maquininha
                       <x-slot name="icon">
                            <x-icon name="chevron-right" class="fill-white group-hover:fill-white transition-all duration-200 sm:ml-10 ml-4" width="20" height="20"/>
                        </x-slot>
                    </x-btn-magenta>

                    <p class="font-bold font-segoe-ui text-2xl text-center text-passou-magenta">Sem taxa de adesão</p>
                </div>
            </div>
        </section>

        <section class="pt-20 bg-[#eaddd7] pb-20">
            <div class="container px-6">
                <div class="flex -mx-6 flex-wrap justify-center">
                    <div class="lg:w-1/2 w-10/12 px-6 mb-12 lg:mb-0">
                        <h3 class="text-2xl font-segoe-ui font-bold text-passou-magenta tracking-tighter text-center leading-none mb-10 px-16">Quer um portal com informações para alavancar seu negócio? Acompanhe nossos artigos e podcasts.</h3>
                        <a href="" class="group">
                            <div class="relative">
                                <img class="absolute top-8 left-8 z-10 -translate-x-6 -translate-y-4 group-hover:translate-x-0 group-hover:translate-y-0 transition-all duration-200 " loading="lazy" src="{{ Vite::asset('resources/images/logo-ebw.png') }}" alt="Logo EBW Bank">
                                <img loading="lazy" class="rounded-3xl shadow-[25px_15px_0_0_#461d52] group-hover:shadow-[0px_0px_0_0_#461d52] transition-all duration-200 -translate-x-6 -translate-y-4 group-hover:translate-x-0 group-hover:translate-y-0" src="{{ Vite::asset('resources/images/portal-do-investidor.jpg') }}" alt="Portal do Investidor">
                                <x-btn-default class="px-8 whitespace-nowrap absolute bottom-0 font-bold text-xl font-segoe-ui left-1/2 -translate-x-1/2 translate-y-1/2" :chevronRight="true" href="#">
                                    Portal do Investidor
                                </x-btn-default>
                            </div>
                        </a>
                    </div>

                    <div class="lg:w-1/2 w-10/12 px-6 mb-12 lg:mb-0">
                        <h3 class="text-2xl font-segoe-ui font-bold text-passou-magenta tracking-tighter text-center leading-none mb-10 px-16">Quer um portal com informações para alavancar seu negócio? Acompanhe nossos artigos e podcasts.</h3>
                        <a href="" class="group">
                            <div class="relative">
                                <img class="absolute top-8 left-8 z-10 -translate-x-6 -translate-y-4 group-hover:translate-x-0 group-hover:translate-y-0 transition-all duration-200 " loading="lazy" src="{{ Vite::asset('resources/images/logo-ebw.png') }}" alt="Logo EBW Bank">
                                <img loading="lazy" class="rounded-3xl shadow-[25px_15px_0_0_#461d52] group-hover:shadow-[0px_0px_0_0_#461d52] transition-all duration-200 -translate-x-6 -translate-y-4 group-hover:translate-x-0 group-hover:translate-y-0" src="{{ Vite::asset('resources/images/conheca-a-ebw.jpg') }}" alt="Conheça a EBW">
                                <x-btn-default class="px-12 whitespace-nowrap absolute bottom-0 font-bold text-xl font-segoe-ui left-1/2 -translate-x-1/2 translate-y-1/2" :chevronRight="true" href="#">
                                   Conheça a EBW
                                </x-btn-default>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="container mx-auto px-4 pt-32">

                <div class=" mb-10">
                    <img loading="lazy" class="mx-auto block" src="{{ Vite::asset('resources/images/icon-business.png') }}" alt="Negocie as suas taxas">

                    <h4 class="text-passou-cyan font-bold text-center my-4 text-3xl">
                        Negocie suas taxas.
                    </h4>

                    <p class="text-lg font-bold text-center text-passou-magenta-800">
                        Com a PASSOU GANHOU, você tem o atendimento personalizado <br>
                        que você merece e as taxas ideais para o seu negócio prosperar.
                    </p>
                </div>

                <div class="flex flex-wrap justify-center -mx-4">
                    <div class="w-full md:w-6/12 lg:w-4/12 my-4 lg:my-0 px-4">
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
                                        <x-icon name="envelope" class="fill-passou-magenta-800" />
                                        <span class="text-passou-magenta-800 font-segoe-ui text-[15px] font-medium tracking-wide ml-3">vendas@passouganhou.com.br</span>
                                    </a>
                                </div>
                                <div class="mb-4">
                                    <a href="https://wa.me/5561996044061" target="_blank" rel="noopener noreferrer" class="flex w-full leading-none justify-center items-center border-2 border-passou-cyan bg-passou-cyan hover:bg-opacity-80 transition-opacity duration-300 text-white rounded-full py-5 font-bold text-lg font-segoe-ui">
                                        Chame pelo WhatsApp!
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full md:w-6/12 lg:w-4/12 my-4 lg:my-0 px-4">
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
                                        <x-icon name="envelope" class="fill-passou-magenta-800" />
                                        <span class="text-passou-magenta-800 font-segoe-ui text-[15px] font-medium tracking-wide ml-3">suporte@passouganhou.com.br</span>
                                    </a>
                                </div>
                                <div class="mb-4">
                                    <a href="https://wa.me/5561996041988" target="_blank" rel="noopener noreferrer" class="flex w-full leading-none justify-center items-center border-2 border-passou-cyan bg-passou-cyan hover:bg-opacity-80 transition-opacity duration-300 text-white rounded-full py-5 font-bold text-lg font-segoe-ui">
                                        Chame pelo WhatsApp!
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full md:w-6/12 lg:w-4/12 my-4 lg:my-0 px-4">
                        <div class="sm:p-6 p-4 bg-white rounded-xl flex flex-col h-full justify-between">
                            <div class="mb-8">
                                <p class="font-bold text-passou-cyan my-4 text-xl">
                                    Fale conosco
                                </p>
                                <p class="font-bold mb-4 text-passou-magenta-800 text-2xl">
                                    0800-894-3000
                                </p>
                                <p class="text-passou-magenta-800">
                                    Horário de atendimento: <br>
                                    <span class="font-bold">Segunda a Sexta - 8h às 18h, Sábado - 8h às 13h</span>
                                </p>
                            </div>
                            <div class="">
                                <div class="mb-4">
                                    <a href="mailto:cac@passouganhou.com.br"
                                    class="flex w-full leading-none break-all px-4 justify-center items-center border-2 border-passou-cyan bg-opacity-0 hover:bg-opacity-20 bg-passou-cyan transition-opacity duration-300 rounded-full py-5">
                                        <x-icon name="envelope" class="fill-passou-magenta-800" />
                                        <span class="text-passou-magenta-800 font-segoe-ui text-[15px] font-medium tracking-wide ml-3">cac@passouganhou.com.br</span>
                                    </a>
                                </div>
                                <div class="mb-4">
                                    <a href="tel:08008943000" target="_blank" rel="noopener noreferrer" class="flex w-full leading-none justify-center items-center border-2 border-passou-cyan bg-passou-cyan hover:bg-opacity-80 transition-opacity duration-300 text-white rounded-full py-5 font-bold text-lg font-segoe-ui">
                                        Ligue 0800-894-3000
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
