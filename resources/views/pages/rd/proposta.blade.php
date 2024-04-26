<x-base-layout>
    <x-slot name="title">RD Station - Proposta</x-slot>
    <x-slot name="main">
        <div class="container">
            <div class="flex flex-row justify-center">
                <div class="w-8/12">
                    <div class="shadow-md rounded-md px-10 py-10 flex flex-col gap-10">
                        <h1 class="text-xl font-bold text-center">Fazer proposta</h1>
                        <div class="flex flex-col gap-4">
                            Nome da negociação: {{$negociacao->name}}
                        </div>
                    </div>
                </div>
            </div>
    </x-slot>
</x-base-layout>
