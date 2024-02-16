<footer class="bg-white py-16 relative">

    <a
        href="#body"
        class="page-scroller absolute sm:bottom-20 bottom-40 sm:right-12 right-4 w-12 h-12 border border-black rounded-full flex justify-center items-center bg-black bg-opacity-0 hover:bg-opacity-25 transition-all">
        <x-icons name="chevron-up" class="fill-black absolute mb-3" width="20" height="20" />
        <x-icons name="chevron-up" class="fill-black absolute -mb-3" width="20" height="20"  />
    </a>

    <div class="xl:px-36 md:px-16 px-4">
        <div class="flex flex-wrap">
            <div class="lg:w-3/12 md:w-1/2 w-full lg:mb-0 mb-8">
                <img class="xl:w-48" src="{{ Vite::asset('resources/images/logo-passou-ganhou-inverted.svg') }}" alt="Logo Passou Ganhou">
                <div class="pt-6">
                    <a class="font-segoe-ui text-lg hover:underline font-bold text-black" href="{{ route('politica-de-privacidade') }}">Política de Privacidade</a>
                </div>
                <div class="pt-1">
                    <a class="font-segoe-ui text-lg hover:underline font-bold text-black" href="{{ route('termos-e-condicoes-de-uso') }}">Termos e Condições de Uso</a>
                </div>
                <div class="pt-1">
                    <a class="font-segoe-ui text-lg hover:underline font-bold text-black" href="{{ route('canal-de-transparencia') }}">Canal de Transparência</a>
                </div>
            </div>
            <div class="lg:w-6/12 md:w-1/2 w-full  lg:mb-0 mb-8">
                <div class="flex md:justify-center justify-start sm:flex-row flex-col">
                    <h3 class="font-segoe-ui text-lg font-bold text-black mr-5 mt-1">Escritório:</h3>
                    <p class="leading-tight font-segoe-ui text-black">
                        BRASÍLIA<br>
                        Ed. Prime Business Setor Bancário Sul, Q 2<br>
                        Salas 09/10 Asa Sul - CEP: 70.070-120
                    </p>
                </div>

            </div>

        </div>
        <div class="flex flex-wrap justify-center u-bg-folk-white pb-6 pt-10">
            <div class="w-full lg:w-8/12 flex flex-col lg:flex-row justify-center items-center mb-4 px-4">
                <a class="w-6/12 lg:w-3/12 my-4 lg:my-0 mx-5" href="https://www.cerc.inf.br/" target="_blank" rel="noopener noreferrer">
                    <img loading="lazy" src="{{ Vite::asset('resources/images/logo-cerci.png') }}" alt="Logo Cerci">
                </a>

                <a class="w-6/12 lg:w-3/12 my-4 lg:my-0 mx-5" href="https://www.pcisecuritystandards.org/" target="_blank" rel="noreferrer noopenner">
                    <img loading="lazy" src="{{ Vite::asset('resources/images/logo-pci.png') }}" alt="Logo PCI">
                </a>
            </div>
        </div>
        <div class="border-b-2 border-black pb-8 pt-32">
            <p class="text-black text-xs font-segoe-ui">© PASSOU GANHOU. Todos os direitos reservados. CNPJ 31.663.601/0001-08</p>
        </div>
    </div>
</footer>
