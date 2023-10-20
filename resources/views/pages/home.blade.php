<x-base-layout>
    <x-slot name="title">Home</x-slot>
    <x-slot name="main">
        <section class="relative">
            <picture>
                <source media="(max-width: 600px)" srcset="{{ Vite::asset('resources/images/banner-new-home-600w.jpg') }}">
                <source media="(max-width: 1024px)" srcset="{{ Vite::asset('resources/images/banner-new-home-1024w.jpg') }}">
                <source media="(max-width: 1280px)" srcset="{{ Vite::asset('resources/images/banner-new-home-1767w.jpg') }}">
                <source media="(min-width: 1281px)" srcset="{{ Vite::asset('resources/images/banner-new-home.jpg') }}">
                <img
                class="w-full xl:min-h-[900px] object-center object-cover"
                src="{{ Vite::asset('resources/images/banner-home.jpg') }}"
                alt="Banner Passou Ganhou">
            </picture>
            <div class="inset-0 absolute xl:pt-32 lg:pt-16 md:pt-12 sm:pt-10 pt-2">
                <div class="container xl:gap-4">
                    <div class="2xl:1/2 xl:w-7/12 lg:w-1/2 md:w-8/12 sm:w-7/12">
                        <h1 class="2xl:text-5xl xl:text-5xl md:text-4xl font-normal sm:text-2xl text-2xl text-passou-magenta md:mb-5 mb-2">
                            Primeiro <b>app de descontos</b> que garante benefícios de <b>forma gratuita</b>, sem exigir cartão de crédito.
                        </h1>
                    </div>
                    <div class="2xl:4/12 xl:w-5/12 lg:w-6/12 md:w-8/12 sm:w-9/12">
                        <h2 class="md:mb-12 mb-5">
                            <span class="sm:bg-white md:bg-inherit 2xl:text-2xl xl:text-2xl md:text-4xl lg:text-2xl font-medium sm:text-lg text-md text-passou-cyan">
                                                            Peça sua maquininha de anúncios inteligentes e ofereça essa vantagem exclusiva aos seus clientes.
                            </span>
                        </h2>
                    </div>
                </div>
            </div>
        </section>
        <div class="bg-passou-magenta text-white py-12 flex">
            <a href="{{ $settings->whatsapp }}" class="mx-auto text-2xl font-medium">Peça sua Passou Ganhou!
                <x-icons name="arrow-right" class="fill-white inline mb-1" width="24" height="24" />
            </a>
        </div>

        <section class="bg-passou-light pb-16">
            <div class="container flex flex-col justify-center">
                <div class="text-center w-11/12 sm:w-8/12 self-center py-12">
                    <h2 class="text-3xl sm:text-5xl md:text-5xl lg:text-5xl xl:text-5xl text-passou-magenta">Passou Ganhou é um jeito novo de <b>vender e comprar</b></h2>
                </div>
                <div class="py-2">
                    <picture>
                        <source media="(max-width: 639px)" srcset="{{ Vite::asset('resources/images/mockup-flow-600w.png') }}"> {{--600w--}}
                        <source media="(min-width: 640px)" srcset="{{ Vite::asset('resources/images/mockup-flow.png') }}">
                        <img loading="lazy" src="{{ Vite::asset('resources/images/mockup-flow.png') }}" class="" alt="Vantagens Passou Ganhou">
                    </picture>
                </div>
            </div>
        </section>
        <section class="pt-10 2xl:pt-20 bg-white pb-16 text-center sm:text-start">
            <div class="container flex flex-col sm:flex-row text-white md:px-20">
                <div class="bg-passou-cyan-400 flex flex-col justify-between p-3 sm:p-6 w-full sm:w-1/2">
                    <div class="flex flex-col justify-between gap-6 p-1 sm:p-8">
                        <h2 class="text-3xl sm:text-[2.5rem] leading-none font-bold">Divulge seu produto sem gastar com anúncios</h2>
                        <p class="text-2xl sm:text-3xl">Solicite sua MAI-910 (Maquininha de Anúncios Inteligentes)</p>
                        <p class="text-2xl sm:text-3xl">Baixe o app da “Passou Ganhou Estabelecimento” na PlayStore.</p>
                        <p class="text-2xl sm:text-3xl">Ative as campanhas de anúncios e venda mais. </p>
                    </div>
                    <div class="flex justify-end pt-8 sm:pt-0">
                        <a href="{{ $settings->whatsapp }}" class="text-xl font-bold">Venda com desconto
                            <x-icons name="arrow-right" class="fill-white inline mb-1" width="16" height="16" />
                        </a>
                    </div>
                </div>
                <div class="bg-passou-magenta flex flex-col justify-between p-3 sm:p-6 w-full sm:w-1/2">
                    <div class="flex flex-col justify-between gap-6 p-1 sm:p-8">
                        <h2 class="text-3xl sm:text-[2.5rem] leading-none font-bold">Compre com seu cartão de débito ou crédito na MAI 910</h2>
                        <p class="text-2xl sm:text-3xl">Acumule pontos e troque por descontos e promoções</p>
                        <p class="text-2xl sm:text-3xl">Baixe o app Passou Ganhou e acompanhe as ofertas exclusivas perto de você.</p>
                    </div>
                    <div class="flex justify-end pt-8 sm:pt-0">
                        <a href="{{ $settings->whatsapp }}" class="text-xl font-bold">Compre com desconto
                            <x-icons name="arrow-right" class="fill-white inline mb-1" width="16" height="16" />
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="pt-10 2xl:pt-20 bg-passou-magenta-850">
            <div class="container flex flex-col">
                <div class="w-full sm:w-7/12 mx-auto text-white">
                    <h2 class="text-3xl sm:text-4xl leading-normal text-center">Acompanhe o <b>crescimento das suas vendas</b> com a Tecnologia financeira certa e Gratuita!</h2>
                </div>
                <div class="sm:px-24 my-8 sm:my-2 flex flex-row">
                    <div class="block sm:hidden lg:block -mr-8 z-[1]">
                        <img loading="lazy" src="{{ Vite::asset('resources/images/mockup-pg.png') }}" class="w-11/12 sm:w-full" alt="Aplicativo Passou Ganhou">
                    </div>
                    <div class="flex flex-col gap-4 justify-center">
                        <div class="bg-white px-6 sm:px-12 py-3 sm:py-6 rounded-2xl">
                            <h3 class="text-passou-cyan-400 text-2xl sm:text-4xl font-bold">Geração de valor</h3>
                            <span class="text-passou-magenta-800">(Benefícios exclusivos para todos os participantes da nossa rede)</span>
                        </div>
                        <div class="bg-white px-6 sm:px-12 py-3 sm:py-6 rounded-2xl">
                            <h3 class="text-passou-cyan-400 text-2xl sm:text-4xl font-bold">Consumo consciente</h3>
                            <span class="text-passou-magenta-800">(Compre mais, pague menos e economize)</span>
                        </div>
                        <div class="bg-white px-6 sm:px-12 py-3 sm:py-6 rounded-2xl z-[1] sm:z-[0]">
                            <h3 class="text-passou-cyan-400 text-2xl sm:text-4xl font-bold">Inclusão financeira</h3>
                            <span class="text-passou-magenta-800">(Você não precisa de cartão de crédito para participar)</span>
                        </div>
                    </div>
                </div>
                <div class="flex py-8 sm:py-16 text-white">
                    <a href="{{ $settings->whatsapp }}" class="mx-auto text-2xl font-medium">Peça sua Passou Ganhou!
                        <x-icons name="arrow-right" class="fill-white inline mb-1" width="24" height="24" />
                    </a>
                </div>
            </div>
        </section>

        <section class="bg-white pt-16 pb-20">
            <div class="container lg:px-10 px-4">
                <h2 class="md:text-2.5xl text-xl font-bold text-passou-magenta-850 text-center font-segoe-ui tracking-tight mb-3">Com a gente não tem essa de metas de venda, plano de fidelidade ou domícilio bancário.</h2>
                <h3 class="md:text-5xl text-2xl text-center font-segoe-ui font-bold tracking-tight text-passou-magenta-850">Resumindo: sem complicação.</h3>

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

                <div class="text-center uppercase">
                    <x-btn-magenta href="{{ $settings->whatsapp }}" target="_blank" rel="noopener noreferrer" class="sm:pl-12 pl-6 sm:pr-10 pr-5 font-bold pt-5 pb-6 sm:text-2xl text-lg font-segoe-ui mb-5" :bg="true">
                        Peça sua maquininha
                       <x-slot name="icon">
                            <x-icons name="chevron-right" class="fill-white group-hover:fill-white transition-all duration-200 sm:ml-10 ml-4" width="20" height="20"/>
                        </x-slot>
                    </x-btn-magenta>

                    <p class="font-bold font-segoe-ui text-2xl text-center text-passou-magenta">Sem taxa de adesão</p>
                </div>
            </div>
        </section>

        <section class="py-12">
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
                            Portal do Investidor
                        </x-btn-default>
                    </div>

                    <div class="lg:w-1/2 sm:w-10/12 w-full px-6 mb-12 lg:mb-0 relative">
                        <h3 class="text-2xl font-segoe-ui font-bold text-passou-magenta tracking-tighter text-center leading-none mb-16 sm:px-16 px-0">Conheça o grande banco por trás da incrível maquininha Passou Ganhou</h3>
                        <a  href="https://ebwbank.com.br" target="_blank" rel="noopener noreferrer" class="group">
                            <div class="relative">
                                <img loading="lazy" class="rounded-3xl sm:shadow-[25px_15px_0_0_#461d52] shadow-[4px_4px_0_0_#461d52] group-hover:shadow-[0px_0px_0_0_#461d52] transition-all duration-200 sm:-translate-x-6 sm:-translate-y-4 group-hover:translate-x-0 group-hover:translate-y-0" src="{{ Vite::asset('resources/images/conheca-a-ebw.jpg') }}" alt="Conheça a EBW">
                            </div>
                        </a>
                        <x-btn-default href="https://ebwbank.com.br" target="_blank" rel="noopener noreferrer" class="px-12 whitespace-nowrap absolute bottom-0 font-bold sm:text-xl text-base bg-passou-cyan text-white font-segoe-ui left-1/2 -translate-x-1/2 translate-y-1/2" :chevronRight="true" >
                           Conheça a EBW
                        </x-btn-default>
                    </div>
                </div>
            </div>

            <div class="container bg-[#eaddd7] mx-auto px:8 sm:px-12 pb-12 sm:pb-24 pt-8 sm:pt-16 mt-12 sm:mt-16" id="atendimento">

                <div class="w-full md:w-10/12 lg:w-8/12 my-4 lg:my-0 pb-10 text-center mx-auto">

                    <img loading="lazy" class="mx-auto block" src="{{ Vite::asset('resources/images/icon-business.png') }}" alt="Negocie as suas taxas">

                    <h4 class="text-passou-cyan font-bold my-4 text-3xl">
                        Negocie suas taxas.
                    </h4>

                    <p class="text-lg text-passou-magenta-800">
                        Com a <b>PASSOU GANHOU</b>, você tem o atendimento personalizado
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
                                    <span class="font-bold">
                                        Segunda a Sexta - 8h às 18h Sábados das 8h às 13h
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
