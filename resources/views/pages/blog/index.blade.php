<x-blog.base-layout>
    <x-slot name="title">Blog</x-slot>
    <x-slot name="main">
        <div class="container article py-8">
            <div class="flex flex-col md:flex-row">
                <div class="w-full md:w-8/12 lg:w-7/12">
                    <section class="flex flex-col divide-y">
                        @foreach($posts as $post)
                            <x-pg.blog.list-item
                                title="{{ $post->title }}"
                                description="{{ $post->summary }}"
                                imgSrc="{{ $post->cover }}"
                                href="/blog/{{$post->slug}}"/>
                        @endforeach
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
        </div>
    </x-slot>
</x-blog.base-layout>
