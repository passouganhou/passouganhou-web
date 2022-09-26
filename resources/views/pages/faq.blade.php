<x-base-layout>
    <x-slot name="title">FAQ - Passou Ganhou</x-slot>
    <x-slot name="main">
        <section class="bg-passou-soft-cyan pt-24 pb-10">
            <div class="container">
                <h1 class="text-center mb-16">
                    <img class="mx-auto" src="{{ Vite::asset('resources/images/faq.png') }}" alt="FAQ Passou Ganhou">
                </h1>

                <div>

                    @foreach ($faqs as $faq)
                        <article class="pb-10"
                        class="font-montserrat"
                        x-data="{open: false}"
                        x-init="
                            $watch('open', function(bool) {
                                const scrollHeight = $refs.content.scrollHeight;
                                $refs.content.style.maxHeight = bool ? `${scrollHeight}px`: '0px';
                            })
                        ">
                            <button class="pb-10 text-left text-white flex justify-between w-full items-center" x-on:click="open = !open">
                                <span class="transition-all" x-bind:class="open ? 'font-bold text-3xl' : 'font-regular text-xl' ">
                                    {!! $faq->question !!}
                                </span>
                                <span class="w-7 h-7 relative items-center justify-center flex">
                                    <span class="w-0.5 bg-passou-magenta h-full rounded-full absolute"
                                    x-transition:enter="transition-all ease-out duration-200"
                                    x-transition:enter-start="scale-0"
                                    x-transition:enter-end="scale-100"
                                    x-transition:leave="transition ease-in duration-200"
                                    x-transition:leave-start="scale-100"
                                    x-transition:leave-end="scale-0"
                                    x-show="!open"></span>
                                    <span class="h-0.5 bg-passou-magenta w-full rounded-full absolute"></span>
                                </span>
                            </button>
                            <div class="max-w-5xl overflow-hidden transition-all" style="max-height: 0" x-ref="content">
                                <p class="text-passou-magenta font-semibold text-lg leading-snug">{!! $faq->answer !!}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>


        <section class="pt-20 pb-16">
            @if($maquininhas)
                <div class="container">
                    <h2 class="text-passou-magenta-700 font-bold text-center font-montserrat text-3xl mb-12">Está com dúvidas sobre o funcionamento<br> das maquininhas passou ganhou? Clique na sua e saiba mais.</h2>

                    <div class="flex justify-between -mx-4">
                        @foreach ($maquininhas as $maquininha)
                            <div class="w-1/3 px-4"
                            x-data="{show: false}"
                            x-init="
                                $watch('show', function(bool) {
                                    const scrollHeight = $refs.content.scrollHeight;
                                    $refs.content.style.maxHeight = bool ? `${scrollHeight}px`: '0px';
                                    if(bool) {
                                        setTimeout(() => {
                                            $refs.content.style.maxHeight = 'unset';
                                        }, 300)
                                    }
                                })
                            ">
                                <div class="border-4 w-60 border-passou-magenta-700 pt-6 pb-10 rounded-5xl relative flex flex-col items-center justify-center px-16">
                                    <img src="{{ Storage::url($maquininha['featured_image']) }}" alt="Maquininha {{ $maquininha['name'] }}">
                                    <h3 class="text-4xl text-passou-magenta-700 font-semibold mt-6">{{ $maquininha['name'] }}</h3>
                                    <button
                                    class="bg-passou-cyan rounded-full absolute bottom-0 translate-y-1/2 py-2 pl-7 pr-4 uppercase text-white font-medium flex items-center hover:bg-passou-magenta transition-all"
                                    x-on:click="show = !show">
                                        Saiba mais
                                        <x-icons name="chevron-right" class="ml-2 fill-white" width="15" height="15" />
                                    </button>
                                </div>
                                <div class="overflow-hidden transition-all duration-300 " x-ref="content" style="max-height: 0;">
                                    <div class="pt-12">
                                        <h3 class="font-medium text-passou-magenta leading-tight text-lg mb-4">
                                            {{ $maquininha['description'] }}
                                        </h3>
                                        <h4 class="text-passou-magenta font-bold font-montserrat text-xl tracking-tight mb-2">Acompanhe.</h4>
                                        <ul class="">
                                            @foreach ($maquininha['operation'] as $operation)
                                                <li class="text-passou-gray text-xl font-medium font-montserrat py-2"
                                                x-data="{open: false}"
                                                x-init="
                                                    $watch('open', function(bool) {
                                                        const scrollHeight = $refs.list.scrollHeight;
                                                        $refs.list.style.maxHeight = bool ? `${scrollHeight}px`: '0px';
                                                    })
                                                ">
                                                    <span class="cursor-pointer block w-full"
                                                    x-on:click="open = !open"
                                                    role="button"
                                                    aria-label="Abrir descrição do item"
                                                    x-bind:class="open ? 'text-passou-magenta font-bold' : ''">
                                                        {{ $operation['title'] }}
                                                        <x-icons name="chevron-right" class="inline-block transition-all" x-bind:class="open ? 'fill-passou-magenta rotate-90' : 'fill-passou-gray'"/>
                                                    </span>
                                                    <ul class="text-base text-passou-magenta tracking-tight font-montserrat overflow-hidden transition-all" x-ref="list" style="max-height: 0;">
                                                        @php
                                                            preg_match_all("#<li>(.+?)</li>#", $operation['items'], $matches );
                                                        @endphp
                                                        @foreach ($matches[0] as $item)
                                                            <li class="pb-1 pt-1 first-of-type:pt-4">
                                                                {{ $loop->index + 1 }} - {{ strip_tags($item) }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </div>
                </div>
            @endif
            <div class="container pt-20">
                <h3 class="font-semibold font-montserrat text-center text-passou-magenta-700 text-5xl mb-16 tracking-tighter">Ainda precisa de ajuda?</h3>

                <div class="flex -mx-4">
                    <div class="w-1/4 px-4 text-center">
                        <a href="#" class="group">
                            <div class="bg-passou-magenta w-24 h-24 rounded-full flex justify-center items-center mx-auto group-hover:bg-passou-cyan transition-all duration-300">
                                <img src="{{ Vite::asset('resources/images/icon-email.png') }}" alt="Email">
                            </div>
                            <span class="mt-3 leading-tight inline-block font-semibold text-passou-magenta text-lg font-montserrat tracking-tight group-hover:underline">E-mail</span>
                        </a>
                    </div>
                    <div class="w-1/4 px-4 text-center">
                        <a href="#" class="group">
                            <div class="bg-passou-magenta w-24 h-24 rounded-full flex justify-center items-center mx-auto group-hover:bg-passou-cyan transition-all duration-300">
                                <img src="{{ Vite::asset('resources/images/icon-central.png') }}" alt="Central de Relacionamento">
                            </div>
                            <span class="mt-3 leading-tight inline-block font-semibold text-passou-magenta text-lg font-montserrat tracking-tight group-hover:underline">Central de <br>Relacionamento</span>
                        </a>
                    </div>
                    <div class="w-1/4 px-4 text-center">
                        <a href="#" class="group">
                            <div class="bg-passou-magenta w-24 h-24 rounded-full flex justify-center items-center mx-auto group-hover:bg-passou-cyan transition-all duration-300">
                                <img src="{{ Vite::asset('resources/images/icon-whatsapp.png') }}" alt="Whatsapp">
                            </div>
                            <span class="mt-3 leading-tight inline-block font-semibold text-passou-magenta text-lg font-montserrat tracking-tight group-hover:underline">Whatsapp</span>
                        </a>
                    </div>
                    <div class="w-1/4 px-4 text-center">
                        <a href="#" class="group">
                            <div class="bg-passou-magenta w-24 h-24 rounded-full flex justify-center items-center mx-auto group-hover:bg-passou-cyan transition-all duration-300">
                                <img src="{{ Vite::asset('resources/images/icon-atendimento.png') }}" alt="Atendimento deficientes auditivos ou de fala">
                            </div>
                            <span class="mt-3 leading-tight inline-block font-semibold text-passou-magenta text-lg font-montserrat tracking-tight group-hover:underline">Atendimento<br> deficientes auditivos<br> ou de fala</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </x-slot>
</x-base-layout>
