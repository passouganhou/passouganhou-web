<x-blog.base-layout :metadata="$metadata">
    <x-slot name="title">{{$metadata->title}}</x-slot>
    <x-slot name="main">
        <article class="container article py-8">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="w-full md:w-8/12 lg:w-7/12">
                    <header>
                        <span class="text-sm text-passou-cyan py-1 font-semibold">Empreendedorismo</span>
                        <h1>Mulheres empreendedoras: histórias de sucesso no mundo dos negócios</h1>
                        <p class="text-sm text-gray-500">Postado em 28 de fevereiro de 2024</p>
                    </header>
                    <section class="flex flex-col gap-4">
                        <div class="w-full">
                            <figure>
                                <img class="h-auto max-w-full rounded-md" src="{{Vite::asset('resources/images/posts/2/vista-frontal-mulheres-modernas-trabalhando-juntos.webp')}}" alt="tres-mulheres-empreendedoras-alegres">
                                <figcaption class="py-1 text-xs text-center bg-gray-50 text-gray-500 dark:text-gray-400">
                                    Imagem de <a href="https://br.freepik.com/fotos-gratis/vista-frontal-mulheres-modernas-trabalhando-juntos_6616842.htm#page=2&query=mulheres%20trabalhando&position=1&from_view=search&track=ais&uuid=42fa4b96-19f6-439f-8f1c-3bb462ef262d">Freepik</a>
                                </figcaption>
                            </figure>
                        </div>
                        <div>
                            <p>Uau, temos um marco histórico ecoando pelo mundo dos negócios brasileiros: mais de 10 milhões de mulheres empreendedoras estão à frente de empresas no país. É o que apontam os dados da última pesquisa feita pelo IBGE (Instituto Brasileiro de Geografia e Estatística).</p>
                            <p>Esses números demonstram como o empreendedorismo feminino reflete uma mudança significativa no cenário empresarial do país.</p>
                            <p>Enquanto o Dia das Mulheres se aproxima, lembramos da importância de reconhecer o impacto que essas mulheres estão gerando, quebrando barreiras, desafiando estereótipos e impulsionando inovações.</p>
                            <p>Fique com a gente até o fim deste artigo, e vamos juntos explorar as histórias e grandes marcos de empreendedoras do país, que são parte do crescimento exponencial do empreendedorismo no Brasil.</p>
                        </div>

                    </section>

                    <section class="">
                        <h2>Histórias de Sucesso</h2>

                        <h3>Chieko Aoki - Blue Tree Hotels:</h3>

                        <p>Chieko Aoki é uma empreendedora brasileira de descendência japonesa, fundadora da rede de hotéis Blue Tree. Com sua visão empreendedora e dedicação ao serviço de excelência, Chieko transformou a Blue Tree em uma das maiores redes hoteleiras do Brasil. Seu percurso motiva mulheres empreendedoras a superarem desafios e alcançarem o sucesso em seus negócios.</p>

                        <h3>Luiza Helena Trajano - Magazine Luiza:</h3>

                        <p>Luiza Helena Trajano é uma das empresárias mais bem-sucedidas do Brasil, conhecida por sua liderança no Magazine Luiza. Ela transformou a empresa familiar em uma das maiores varejistas do país, com uma visão voltada para a inovação e a inclusão social. O seu legado inspira outras mulheres empreendedoras a perseguirem seus sonhos com determinação e coragem.</p>

                        <h3>Leila Velez - Beleza Natural:</h3>

                        <p>Leila Velez é uma empreendedora brasileira conhecida por sua atuação no setor de beleza e estética. Fundadora do Beleza Natural, um dos maiores salões de beleza especializado em cabelos crespos e cacheados, Leila revolucionou o mercado de beleza no Brasil, promovendo a valorização da beleza natural e a autoestima das mulheres. O seu trajeto tem inspirado empreendedoras a apostarem em negócios que promovam a diversidade e a inclusão.</p>

                        <h3>Camila Achutti - Mastertech:</h3>

                        <p>Camila Achutti é uma empresária brasileira que fundou a Mastertech, uma escola de tecnologia que tem como objetivo capacitar profissionais para o mercado de trabalho digital. Com sua paixão pela tecnologia e educação, Camila está transformando vidas por meio da formação de talentos na área de TI. Sua história estimula mulheres empreendedoras a explorarem o potencial transformador da tecnologia.</p>

                        <h2>Empoderando negócios: o apoio da Passou Ganhou às mulheres empreendedoras</h2>

                        <p>As histórias dessas mulheres empreendedoras brasileiras mostram o poder da determinação, coragem e visão de futuro. Elas são um exemplo inspirador de como é possível superar desafios e alcançar o sucesso nos negócios. É notável o avanço do empreendedorismo feminino, evidenciado pelo crescimento do número de mulheres à frente de negócios. </p>

                        <p>Esse movimento não apenas transforma o cenário econômico, mas promove uma mudança positiva na sociedade. Se você também tem um sonho empreendedor, esperamos que essas histórias tenham te inspirado a seguir em frente e buscar o seu lugar no mundo dos negócios.</p>

                        <p>E lembre-se, na jornada empreendedora, você não está sozinha! A Passou Ganhou está aqui para oferecer suporte e incentivo a todas as empreendedoras. Juntas, podemos transformar sonhos em realidade e construir um futuro empreendedor ainda mais promissor. </p>

                        <p>Para obter mais informações sobre como impulsionar o seu negócio, <a href="https://www.passouganhou.com.br/">visite o site da Passou Ganhou</a>. E para explorar dados sobre o crescimento do empreendedorismo feminino no Brasil, confira o <a href="https://agenciasebrae.com.br/dados/infografico-n-de-donas-de-negocios-chega-ao-recorde-de-103-milhoes/">estudo completo do Sebrae</a>.</p>

                    </section>
                </div>
                <div class="w-full md:w-4/12 text-start md:px-5">
                    <div class="flex flex-col">
                        <div class="flex self-start flex-col w-full py-2">

                            <h3 class="font-medium text-lg text-black">Nossas redes sociais</h3>
                            <hr class="mb-3">

                            <div class="flex items-center justify-center gap-2">
                                <a href="https://www.facebook.com/passouganhou/" class="bg-passou-cyan p-2 rounded-full" target="_blank" rel="noopener noreferrer">
                                    <x-icons name="facebook" class="fill-white" width="24" height="24" />
                                </a>
                                <a href="https://instagram.com/passouganhou?igshid=YmMyMTA2M2Y=" class="bg-passou-cyan p-2 rounded-full" target="_blank" rel="noopener noreferrer">
                                    <x-icons name="instagram" class="fill-white" width="24" height="24" />
                                </a>
                                {{-- <a href="https://twitter.com/ebwbank " class="mx-3" target="_blank" rel="noopener noreferrer">
                                    <x-icons name="twitter" class="fill-black" width="24" height="24" />
                                </a> --}}
                                {{-- <a href="https://youtube.com/channel/UCYIV1S3aPZ0OZ2WL_MTg3yg " class="mx-3" target="_blank" rel="noopener noreferrer">
                                    <x-icons name="youtube" class="fill-black" width="24" height="24" />
                                </a> --}}
                                {{-- <a href="https://twitter.com/ebwbank" class="mx-3" target="_blank" rel="noopener noreferrer">
                                    <div class="w-[22px] h-[22px] bg-black rounded-sm flex justify-center items-center">
                                        <x-icons name="tiktok" class="fill-passou-magenta-800" />
                                    </div>
                                </a> --}}
                            </div>

                        </div>
                        <div class="flex self-start flex-col w-full py-2">
                            <h3 class="font-medium text-lg text-black">Sobre a Passou Ganhou</h3>
                            <hr class="mb-3">

                            <p>
                                O Passou Ganhou é uma solução de pagamento virtual e físico do EBW Bank, um banco digital. O aplicativo tem versões para consumidores e comerciantes.

                            </p>

                        </div>

                    </div>
                </div>
            </div>
        </article>
    </x-slot>
</x-blog.base-layout>
