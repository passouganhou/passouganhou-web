<x-base-layout>
    <x-slot name="title">Venda pela internet - Passou Ganhou</x-slot>
    <x-slot name="main">

        <section class="xl:pt-32 sm:pt-20 pt-12 pb-40 lg:bg-center bg-left bg-cover bg-no-repeat" style="background-image: url({{ Vite::asset('resources/images/banner-venda-pela-internet.jpg') }})">
            <div class="container mx-auto">
                <h1 class="sm:text-4xl text-xl flex items-center leading-tight text-center text-passou-magenta uppercase font-bold mb-7">
                    <img class="xl:w-auto sm:w-24 w-16"
                    src="{{ Vite::asset('resources/images/icon-venda-pela-internet.png') }}" alt="Venda pela Internet">
                    <span class="ml-4">A sua loja é online</span>
                </h1>
                <div class="max-w-xl leading-none">
                    <p class="sm:text-[40px] text-lg text-white sm:mb-8 mb-5">Não se preocupe, a gente também é.</p>
                    <p class="sm:text-[40px] text-lg text-white sm:mb-8 mb-5">Venda sem <b>fronteiras</b> com <b>rapidez, segurança</b> e as <b>melhores taxas.</b></p>

                    <p class="font-bold text-passou-magenta-700 text-[28px] sm:pr-40">Preencha seus dados e comece a vender mais pela internet</p>
                </div>
            </div>
        </section>

        <section class="bg-[#edebeb] pb-20">
            <div class="container pt-12 mb-10">
                <h2 class="text-center text-passou-magenta-700 uppercase sm:text-4xl text-2xl font-semibold">Preencha seus dados e venda pela internet com segurança</h2>
            </div>

            <livewire:form-contact form="form-venda-pela-internet" />
        </section>
    </x-slot>
</x-base-layout>
