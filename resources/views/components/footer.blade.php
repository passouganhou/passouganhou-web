<footer class="bg-passou-magenta-800 py-16 relative">

    <a
    href="#body"
    class="page-scroller absolute sm:bottom-20 bottom-40 sm:right-12 right-4 w-12 h-12 border border-white rounded-full flex justify-center items-center bg-white bg-opacity-0 hover:bg-opacity-25 transition-all">
        <x-icons name="chevron-up" class="fill-white absolute mb-3" width="20" height="20" />
        <x-icons name="chevron-up" class="fill-white absolute -mb-3" width="20" height="20"  />
    </a>

    <div class="xl:px-36 md:px-16 px-4">
        <div class="flex flex-wrap">
            <div class="lg:w-3/12 md:w-1/2 w-full lg:mb-0 mb-8">
                <img class="xl:w-48" src="{{ Vite::asset('resources/images/logo-passou-ganhou.png') }}" alt="Logo Passou Ganhou">
                <div class="pt-6">
                    <a class="font-segoe-ui text-lg hover:underline font-bold text-white" href="{{ route('politica-de-privacidade') }}">Política de Privacidade</a>
                </div>
                <div class="pt-1">
                    <a class="font-segoe-ui text-lg hover:underline font-bold text-white" href="{{ route('termos-e-condicoes-de-uso') }}">Termos e Condições de Uso</a>
                </div>
            </div>
            <div class="lg:w-6/12 md:w-1/2 w-full  lg:mb-0 mb-8">
                <div class="flex md:justify-center justify-start sm:flex-row flex-col">
                    <h3 class="font-segoe-ui text-lg font-bold text-white mr-5 mt-1">Escritório:</h3>
                    <p class="leading-tight font-segoe-ui text-white">
                        Brasília<br>
                        Ed. Prime Business Setor Bancário Sul, Q 2<br>
                        Salas 09/10 Asa Sul - CEP: 70.070-120
                    </p>
                </div>

            </div>

            <div class="lg:w-3/12 w-full flex flex-col lg:items-end items-start">
                <h3 class="font-bold text-lg text-white mb-3">Siga a Passou Ganhou</h3>

                <div class="flex items-center justify-center">
                    <a href="https://www.facebook.com/passouganhou/" class="mx-3" target="_blank" rel="noopener noreferrer">
                        <x-icons name="facebook" class="fill-white" width="24" height="24" />
                    </a>
                    <a href="https://instagram.com/passouganhou?igshid=YmMyMTA2M2Y=" class="mx-3" target="_blank" rel="noopener noreferrer">
                        <x-icons name="instagram" class="fill-white" width="24" height="24" />
                    </a>
                    {{-- <a href="https://twitter.com/ebwbank " class="mx-3" target="_blank" rel="noopener noreferrer">
                        <x-icons name="twitter" class="fill-white" width="24" height="24" />
                    </a> --}}
                    {{-- <a href="https://youtube.com/channel/UCYIV1S3aPZ0OZ2WL_MTg3yg " class="mx-3" target="_blank" rel="noopener noreferrer">
                        <x-icons name="youtube" class="fill-white" width="24" height="24" />
                    </a> --}}
                    {{-- <a href="https://twitter.com/ebwbank" class="mx-3" target="_blank" rel="noopener noreferrer">
                        <div class="w-[22px] h-[22px] bg-white rounded-sm flex justify-center items-center">
                            <x-icons name="tiktok" class="fill-passou-magenta-800" />
                        </div>
                    </a> --}}
                </div>
            </div>
        </div>

        <div class="border-b-2 border-white pb-8 pt-32">
            <p class="text-white text-xs font-segoe-ui">© PASSOU GANHOU. Todos os direitos reservados. CNPJ 31.663.601/0001-08</p>
        </div>
    </div>
</footer>
