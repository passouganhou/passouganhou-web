<x-base-layout>
    <x-slot name="title">RD Station - Login</x-slot>
    <x-slot name="main">
        <div class="container">
            <div class="flex flex-row justify-center">
                <div class="py-5 w-full md:w-8/12">
                    <div class="shadow-md px-10 py-10 flex flex-col gap-10">
                        <!-- voltar -->
                        <a href="{{route('dashboard')}}" class="float-left inline-flex w-fit gap-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18">
                                </path>
                            </svg>
                            Voltar
                        </a>
                        <div class="w-full flex flex-row justify-around">
                            <img
                                src="{{ Vite::asset('resources/images/logo-passou-ganhou-inverted.svg') }}" alt="Passou Ganhou Logo"
                                class="w-1/3 max-w-ss">
                            <svg class="w-1/3" width="297" height="69" viewBox="0 0 297 69" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-labelledby="logo-title-tangram-166205"><title id="logo-title-tangram-166205">rdstation-crm-logo</title><path d="M86.6187 51.1189C86.6187 56.6388 90.878 60.6183 96.3579 60.6183C99.9679 60.6183 102.305 58.9238 103.682 57.1523C104.513 56.151 105.136 54.9957 105.578 53.6863H102.591C102.279 54.4565 101.838 55.1497 101.267 55.7402C100.306 56.7672 98.7473 57.7942 96.3579 57.7942C92.4622 57.7942 89.7353 55.0984 89.7353 51.1189C89.7353 47.1394 92.4622 44.4436 96.3579 44.4436C98.7213 44.4436 100.228 45.3935 101.163 46.3178C101.708 46.8569 102.15 47.4731 102.461 48.1663H105.448C105.084 46.9596 104.513 45.8556 103.734 44.9057C102.409 43.2625 100.098 41.6194 96.3579 41.6194C90.878 41.6194 86.6187 45.5989 86.6187 51.1189Z" fill="black"></path><path d="M109.595 60.1049H112.582V53.6863H116.607L120.893 60.1049H124.399L119.854 53.4295C122.84 52.685 124.529 50.477 124.529 47.9096C124.529 44.7003 121.932 42.1329 117.516 42.1329H109.595V60.1049ZM112.582 50.8621V44.957H117.516C120.243 44.957 121.412 46.0867 121.412 47.9096C121.412 49.7325 120.243 50.8621 117.516 50.8621H112.582Z" fill="black"></path><path d="M128.825 60.1049H131.812V47.5245L131.552 45.0854H131.812L136.616 55.997H141.291L146.096 45.0854H146.356L146.096 47.5245V60.1049H149.083V42.1329H144.278L139.343 53.3012H138.694L133.76 42.1329H128.825V60.1049Z" fill="black"></path><path d="M150.908 25.6093C151.107 26.3005 151.44 26.9259 151.94 27.4525C152.839 28.3741 154.27 29.2629 156.901 29.2629C160.763 29.2629 162.328 27.7158 162.328 26.2017C162.328 23.7659 158.566 23.1735 154.77 22.3835C150.974 21.5935 147.212 20.0135 147.212 15.6687C147.212 12.015 150.508 8.78931 156.701 8.78931C161.03 8.78931 163.56 10.5009 164.992 12.2455C165.858 13.2658 166.424 14.4179 166.79 15.7016H162.129C161.929 15.2079 161.629 14.7141 161.163 14.2862C160.397 13.5621 159.032 12.838 156.701 12.838C153.172 12.838 151.873 13.99 151.873 15.5041C151.873 17.2157 154.004 18.0386 156.635 18.5653C161.096 19.454 166.99 20.5073 166.99 26.0371C166.99 29.8553 163.527 33.3115 156.901 33.3115C151.973 33.3115 149.243 31.4353 147.744 29.4933C146.879 28.3741 146.313 27.0905 146.046 25.6751H150.908V25.6093Z" fill="black"></path><path d="M168.155 9.51367H189.265V13.7269H180.941V32.4889H176.479V13.7269H168.155V9.51367Z" fill="black"></path><path d="M205.148 22.7458L202.617 13.7598H198.355L195.825 22.7458H205.148ZM195.225 9.51367H205.78L212.339 32.4889H207.878L206.313 26.9261H194.692L193.127 32.4889H188.666L195.225 9.51367Z" fill="black"></path><path d="M211.74 9.51367H232.85V13.7269H224.526V32.4889H220.064V13.7269H211.74V9.51367Z" fill="black"></path><path d="M240.409 9.51367H235.947V32.4889H240.409V9.51367Z" fill="black"></path><path d="M257.656 29.0654C262.484 29.0654 265.98 25.6092 265.98 21.0339C265.98 16.4257 262.484 13.0025 257.656 13.0025C252.828 13.0025 249.332 16.4586 249.332 21.0339C249.299 25.6092 252.795 29.0654 257.656 29.0654ZM257.656 8.75635C265.214 8.75635 270.642 14.1217 270.642 21.0011C270.642 27.8804 265.214 33.2457 257.656 33.2457C250.098 33.2457 244.67 27.8804 244.67 21.0011C244.67 14.1217 250.098 8.75635 257.656 8.75635Z" fill="black"></path><path d="M274.87 9.51367H280.897L291.552 26.7616H291.918L291.552 23.7004V9.51367H296.014V32.4889H289.987L279.332 15.2739H278.966L279.332 18.3351V32.4889H274.87V9.51367Z" fill="black"></path><path d="M98.8652 20.3427H93.6709V14.7799H98.8652C100.663 14.7799 102.028 15.965 102.028 17.5449C102.028 19.1578 100.663 20.3427 98.8652 20.3427ZM105.258 24.6218C106.024 24.2597 106.756 23.733 107.389 23.0418C108.854 21.5606 109.587 19.7173 109.587 17.5778C109.587 12.3771 105.458 8.75635 99.5644 8.75635H86.2458V33.2786H93.6376V26.2017H98.1659L102.195 33.2786H109.653L104.825 24.8192L105.258 24.6218Z" fill="black"></path><path d="M120.774 27.0575V14.9775H123.571C127.467 14.9775 129.864 17.2816 129.864 21.0011C129.864 24.7205 127.467 27.0246 123.571 27.0246H120.774V27.0575ZM137.656 21.0011C137.656 13.8913 131.829 8.75635 123.804 8.75635H113.416V33.2786H123.804C131.829 33.2786 137.656 28.1109 137.656 21.0011Z" fill="black"></path><path d="M34.8607 49.9411L69.1219 62.6185V51.2516L34.8607 38.5742L0.626343 51.2516V62.6185L34.8607 49.9411Z" fill="black"></path><path d="M34.8607 49.9414L0.626343 62.6188L13.3335 68.7435L34.8607 60.7734L56.4147 68.7435L69.1219 62.6188L34.8607 49.9414Z" fill="#19C1CE"></path><path d="M34.8607 19.0501L0.626343 6.37256V17.7395L34.8607 30.417L69.1219 17.7395V6.37256L34.8607 19.0501Z" fill="black"></path><path d="M34.8607 19.0501L69.1219 6.37253L56.4147 0.247803L34.8607 8.21808L13.3335 0.247803L0.626343 6.37253L34.8607 19.0501Z" fill="#19C1CE"></path></svg>
                        </div>
                        <h1 class="text-xl font-bold text-center">Insira o token de autorização</h1>
                        <form action="{{route('rd.check-token')}}" method="POST">
                            @csrf
                            <div class="flex flex-col gap-4">
                                <p>
                                    Insira o token de autorização (Token da instância) para acessar os recursos integrados do RD Station CRM.
                                </p>
                                <p>
                                    O token de autorização é um código de segurança que permite a integração entre o Passou Ganhou e o RD Station CRM.
                                </p>
                                <p class="font-semibold">
                                    Você só precisa inserir o token de autorização uma vez.
                                </p>
                                <div class="flex flex-col gap-4">
                                    <label for="input_rd_crm_token">Token de autorização</label>
                                    <input type="text" name="input_rd_crm_token" id="input_rd_crm_token" class="border rounded-md px-4 py-2">
                                    <button type="submit" class="px-6 py-3 bg-passou-magenta text-white">Verificar</button>
                                </div>

                                <!-- Preciso de ajuda para obter meu token-->
                                <a href="https://ajuda.rdstation.com/s/article/Gerar-e-visualizar-Token?language=pt_BR" target="_blank" class="text-passou-cyan w-fit font-semibold">Preciso de ajuda para obter meu token</a>
                                <!-- Erro -->
                                @if($errors->any())
                                    <div class="bg-red-500 text-white rounded-md px-4 py-2">
                                        {{$errors->first()}}
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-base-layout>
