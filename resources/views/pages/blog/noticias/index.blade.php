<x-bf-base-layout>
    <x-slot name="title">Notícias em destaque</x-slot>
    <x-slot name="main">
        <div class="my-8 sm:w-9/12 mx-auto py-4 sm:pt-24 sm:pb-8">
            <section class="container">
                <div class="py-8">
                    <h1 class="text-3xl font-bold">Notícias em destaque</h1>
                </div>
                <hr>
                <div class="py-8 flex flex-col gap-8">
                    @foreach($articles as $noticia)
                        <x-blog.noticias.card :noticia="$noticia" />
                    @endforeach
                </div>
                <div>
                    {{$articles->links('pagination::tailwind-pg')}}
                </div>
            </section>
        </div>
        <div class="my-8 py-4 sm:pt-24 sm:pb-8 bg-black text-white">
            <section class="container flex flex-col justify-around gap-8 py-8">
                <h1 class="text-3xl sm:text-4xl font-bold"><span class="overline decoration-passou-cyan decoration-8">Fale</span> com nossa imprensa</h1>
                <div>
                    <p>E-mail: <a href="mailto:imprensa@passouganhou.com.br">imprensa@passouganhou.com.br</a></p>
                </div>
                <div class="flex flex-row gap-4">
                    <a href="https://www.facebook.com/passouganhou/" class="" target="_blank" rel="noopener noreferrer">
                        <x-icons name="facebook" class="fill-white" width="24" height="24" />
                    </a>
                    <a href="https://instagram.com/passouganhou?igshid=YmMyMTA2M2Y=" class="" target="_blank" rel="noopener noreferrer">
                        <x-icons name="instagram" class="fill-white" width="24" height="24" />
                    </a>
                </div>
            </section>
        </div>
    </x-slot>
</x-bf-base-layout>
