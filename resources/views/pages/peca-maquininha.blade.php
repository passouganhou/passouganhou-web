<x-base-layout>
    <x-slot name="title">Peça a Sua Maquininha - Passou Ganhou</x-slot>
    <x-slot name="main">

        <section class="pt-10 2xl:pt-20 pb-24 bg-center bg-cover bg-no-repeat" style="background-image: url({{ Vite::asset('resources/images/banner-produtos.jpg') }})">
            <div class="container mx-auto px-4">
                <div class="mb-20">
                    <h1 class="md:text-3xl text-2xl leading-tight text-center text-white uppercase font-bold mb-6">
                        A maquininha perfeitinha para cada tipo de negócio. o melhor? Sem taxa de adesão!
                    </h1>
                </div>

                <div class="">
                    <div class="flex flex-wrap">
                        <div class="w-full sm:w-6/12 lg:w-3/12 lg:mb-0 mb-20">
                            <x-maquininha name="Enjoy" image="{{ Vite::asset('resources/images/machine-enjoy.png') }}" white>
                                <x-slot name="list" class="bg-white md:left-16">
                                    <ul class="list-disc  md:whitespace-nowrap text-passou-magenta font-medium">
                                        <li class="md:text-lg md:leading-tight leading-tight">Maquininha leve e portátil</li>
                                        <li class="md:text-lg md:leading-tight leading-tight">Não precisa de celular</li>
                                        <li class="md:text-lg md:leading-tight leading-tight">Bateria de longa duração</li>
                                        <li class="md:text-lg md:leading-tight leading-tight">Envio de comprovante por SMS</li>
                                    </ul>
                                </x-slot>
                            </x-maquininha>
                        </div>

                        <div class="w-full sm:w-6/12 lg:w-3/12 lg:mb-0 mb-20">
                            <x-maquininha name="Revolution" image="{{ Vite::asset('resources/images/machine-revolution.png') }}" white>
                                <x-slot name="list" class="bg-white md:left-0">
                                    <ul class="list-disc  text-passou-magenta font-medium">
                                        <li class="md:text-lg md:leading-tight leading-tight md:whitespace-nowrap">Imprime comprovante</li>
                                        <li class="md:text-lg md:leading-tight leading-tight md:whitespace-nowrap">Permite pagamento por aproximação</li>
                                        <li class="md:text-lg md:leading-tight leading-tight">Portabilidade absoluta: ideal para pagamento dentro e fora do estabelecimento.</li>
                                    </ul>
                                </x-slot>
                            </x-maquininha>
                        </div>

                        <div class="w-full sm:w-6/12 lg:w-3/12 lg:mb-0 mb-20">
                            <x-maquininha name="Ultra" image="{{ Vite::asset('resources/images/machine-ultra.png') }}" white>
                                <x-slot name="list" class="bg-white md:-left-6">
                                    <ul class="list-disc text-passou-magenta font-medium">
                                        <li class="md:text-lg md:leading-tight leading-tight md:whitespace-nowrap">Design compacto e moderno</li>
                                        <li class="md:text-lg md:leading-tight leading-tight md:whitespace-nowrap">Permite pagamento por QRCode e aproximação</li>
                                        <li class="md:text-lg md:leading-tight leading-tight">Portabilidade absoluta: ideal para pagamento dentro e fora do estabelecimento.</li>
                                        <li class="md:text-lg md:leading-tight leading-tight">Conectividade total: 4G, Wi-Fi</li>
                                    </ul>
                                </x-slot>
                            </x-maquininha>
                        </div>

                        <div class="w-full sm:w-6/12 lg:w-3/12 lg:mb-0 mb-20">
                            <x-maquininha name="TEF" image="{{ Vite::asset('resources/images/machine-tef.png') }}" white>
                                <x-slot name="list" class="bg-white 2xl:-left-52 md:-left-96">
                                    <ul class="list-disc text-passou-magenta font-medium">
                                        <li class="md:text-lg md:leading-tight leading-tight">Utilizada para TEF ou soluções de pagamentos proprietários, como bancos ou cooperativas.</li>
                                        <li class="md:text-lg md:leading-tight leading-tight">Possui processador de alta performace, leitores de tarja magnéticos, smart card e, ainda, cabo DUAL (SERIAL + USB).</li>
                                        <li class="md:text-lg md:leading-tight leading-tight md:whitespace-nowrap">Feita para garantir total segurança em todas as transações.</li>
                                    </ul>
                                </x-slot>
                            </x-maquininha>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <section class="bg-[#edebeb] pb-20">
            <div class="flex justify-center">
                <h3 class="bg-passou-soft-cyan text-2xl -translate-y-1/2 font-semibold text-white uppercase px-10 py-2">Peça a sua</h3>
            </div>
            <div class="container pt-12 mb-10">
                <h2 class="text-center text-passou-magenta-700 uppercase text-4xl font-semibold">Preencha seus dados e peça a sua Passou Ganhou</h2>
            </div>

            <livewire:form-contact/>
        </section>
    </x-slot>
</x-base-layout>
