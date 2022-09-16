<footer class="bg-passou-magenta-800 py-16 relative">

    <button class="absolute bottom-16 right-12 w-12 h-12 border border-white rounded-full flex justify-center items-center bg-white bg-opacity-0 hover:bg-opacity-25 transition-all">
        <x-icon name="chevron-up" class="fill-white absolute mb-3" width="20" height="20" />
        <x-icon name="chevron-up" class="fill-white absolute -mb-3" width="20" height="20"  />
    </button>

    <div class="px-36">
        <div class="flex justify-between">
            <div>
                <img class="w-48" src="{{ Vite::asset('resources/images/logo-passou-ganhou.png') }}" alt="Logo Passou Ganhou">
            </div>
            <div class="flex">
                <h3 class="font-segoe-ui text-lg font-bold text-white mr-3">Escritório:</h3>
                <p class="leading-tight font-segoe-ui text-white">
                    Brasília<br>
                    Ed. Prime Business Setor Bancário Sul, Q 2<br>
                    Salas 09/10 Asa Sul - CEP: 70.070-120
                </p>
            </div>

            <div>
                <h3 class="font-bold text-lg text-white mb-3">Siga a Passou, Ganhou</h3>

                <div class="flex items-center justify-center">
                    <a href="#" class="mx-3" target="_blank" rel="noopener noreferrer">
                        <x-icon name="facebook" class="fill-white" width="24" height="24" />
                    </a>
                    <a href="#" class="mx-3" target="_blank" rel="noopener noreferrer">
                        <x-icon name="instagram" class="fill-white" width="24" height="24" />
                    </a>
                    <a href="#" class="mx-3" target="_blank" rel="noopener noreferrer">
                        <x-icon name="linkedin" class="fill-white" width="24" height="24" />
                    </a>
                    <a href="#" class="mx-3" target="_blank" rel="noopener noreferrer">
                        <div class="w-[22px] h-[22px] bg-white rounded-sm flex justify-center items-center">
                            <x-icon name="tiktok" class="fill-passou-magenta-800" />
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="border-b-2 border-white pb-8 pt-32">
            <p class="text-white text-xs font-segoe-ui">© PASSOU GANHOU. Todos os direitos reservados. EBW BANK | CNPJ 31.663.601/0001-08</p>
        </div>
    </div>
</footer>
