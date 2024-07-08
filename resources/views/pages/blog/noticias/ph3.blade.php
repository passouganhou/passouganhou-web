<x-blog.base-layout :metadata="$metadata">
    <x-slot name="title">{{$metadata->title}}</x-slot>
    <x-slot name="main">
        <article class="container article py-8">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="w-full md:w-8/12 lg:w-7/12">
                    <header>
                        <span class="text-sm text-passou-cyan py-1 font-semibold"></span>
                        <h1>Passou Ganhou elimina meia tonelada de plástico na Feira do Sebrae com copos de fibra de arroz</h1>
                        <p class="text-sm text-gray-500">Postado em 5 de junho de 2024</p>
                    </header>
                    <section class="flex flex-col gap-4">
                        <div class="w-full">
                            <figure>
                                <img class="h-auto max-w-full rounded-md"
                                     src="{{Vite::asset('resources/images/posts/3/copos-feira-sebrae.webp')}}"
                                     alt="copos-sendo-oferecidos-durante-a-feira-sebrae">
                            </figure>
                        </div>
                        <div>
                            <p>Oferecemos, gratuitamente, copos ecológicos feitos de fibra de arroz durante a Feira do
                                Sebrae, um evento com cerca de 25 mil pessoas, como parte do nosso compromisso em
                                reduzir o impacto ambiental causado pelo uso excessivo de copos descartáveis.<br></p>
                        </div>

                    </section>

                    <section class="">
                        <h2>O evento</h2>
                        <p>A Feira do Empreendedor Sebrae Pernambuco, um dos maiores eventos de empreendedorismo do
                            estado, reuniu milhares de participantes em busca de conhecimento, networking e
                            oportunidades de negócio. O evento abordou temas como inovação, sustentabilidade e gestão
                            eficiente, com destaque para a Unidade de Serviço Gerencial (USG) como modelo de gestão
                            inovador. A USG é um modelo que divide a empresa em unidades menores e autônomas, permitindo
                            uma gestão mais ágil e focada em resultados.</p>
                        <p><br></p>
                        <h2>O desafio dos copos descartáveis</h2>
                        <p>No Brasil, a produção de copos plásticos descartáveis gera um desafio ambiental, atingindo
                            cerca de 100 mil toneladas por ano (<a href="https://www.meucopoeco.com.br/site/post/4-motivos-para-nao-usar-copos-descartaveis/18" target="_blank">link para um estudo sobre a produção de copos descartáveis no Brasil</a>).
                            Durante eventos, estima-se que cada pessoa utilize, em média,
                            quatro copos plásticos descartáveis por dia. Em um evento como a Feira do Sebrae, com 25 mil
                            participantes, isso poderia resultar no uso de 100 mil copos plásticos em um único dia.</p>
                        <p><br></p>
                        <h2>Nossa solução: copos de fibra de arroz</h2>
                        <p>Em resposta a esse desafio, introduzimos copos de fibra de arroz durante a Feira do Sebrae.
                            Esses copos biodegradáveis são uma solução prática e ambientalmente responsável, refletindo
                            nossa dedicação à sustentabilidade e à inovação. Ao optar por copos reutilizáveis de fibra
                            de arroz, estamos não apenas reduzindo o impacto ambiental, mas também inspirando outras
                            empresas a adotarem práticas mais ecológicas.</p>
                        <p><br></p>
                        <h2>Nosso Impacto na Feira do Sebrae</h2>
                        <p>Durante a Feira do Sebrae, a distribuição dos nossos copos ecológicos de fibra de arroz
                            ajudou a reduzir drasticamente o uso de copos plásticos descartáveis. Se cada um dos 25 mil
                            participantes utilizasse em média quatro copos plásticos descartáveis por dia, isso
                            resultaria em 100 mil copos plásticos. Ao substituir esses copos por opções de fibra de
                            arroz, evitamos que aproximadamente meia tonelada de resíduos plásticos fosse gerada
                            (considerando que 400 copos plásticos equivalem a cerca de um quilo de plástico).</p>
                        <p><br></p>
                        <p>Vimos participantes adotando com entusiasmo essa inovação, o que reforça nosso compromisso
                            com a sustentabilidade. Acreditamos que pequenas ações, como a escolha de um copo
                            reutilizável, podem gerar um impacto significativo no nosso meio ambiente.</p>
                        <p><br></p>
                        <h2>Nossa Visão para o Futuro</h2>
                        <p>Estamos entusiasmados com o futuro e continuaremos a promover práticas sustentáveis em todos
                            os nossos eventos e iniciativas. A ação na Feira do Sebrae é apenas o começo. Queremos
                            inspirar mais empresas e pessoas a adotarem alternativas ecológicas que beneficiem nosso
                            planeta.</p>
                        <p><br></p>
                        <p>Quer saber mais sobre como a Passou Ganhou está contribuindo para um futuro mais sustentável?
                            Nos acompanhe nas redes sociais para ficar por dentro das nossas ações e novidades.</p>
                    </section>
                </div>
                <div class="w-full md:w-4/12 text-start md:px-5">
                    <div class="flex flex-col">
                        <div class="flex self-start flex-col w-full py-2">

                            <h3 class="font-medium text-lg text-black">Nossas redes sociais</h3>
                            <hr class="mb-3">

                            <div class="flex items-center justify-center gap-2">
                                <a href="https://www.facebook.com/passouganhou/" class="bg-passou-cyan p-2 rounded-full"
                                   target="_blank" rel="noopener noreferrer">
                                    <x-icons name="facebook" class="fill-white" width="24" height="24"/>
                                </a>
                                <a href="https://instagram.com/passouganhou?igshid=YmMyMTA2M2Y="
                                   class="bg-passou-cyan p-2 rounded-full" target="_blank" rel="noopener noreferrer">
                                    <x-icons name="instagram" class="fill-white" width="24" height="24"/>
                                </a>
                            </div>

                        </div>
                        <div class="flex self-start flex-col w-full py-2">
                            <h3 class="font-medium text-lg text-black">Sobre a Passou Ganhou</h3>
                            <hr class="mb-3">

                            <p>
                                O Passou Ganhou é uma solução de pagamento virtual e físico do EBW Bank, um banco
                                digital. O aplicativo tem versões para consumidores e comerciantes.

                            </p>

                        </div>

                    </div>
                </div>
            </div>
        </article>
    </x-slot>
</x-blog.base-layout>
