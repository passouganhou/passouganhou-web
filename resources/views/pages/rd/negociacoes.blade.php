<x-base-layout>
    <x-slot name="title">RD Station - Negociacoes</x-slot>
    <x-slot name="main">
        <div class="container">
            <div class="flex flex-row justify-center">
                <div class="w-8/12">
                    <div class="shadow-md rounded-md px-10 py-10 flex flex-col gap-10">
                        <h1 class="text-xl font-bold text-center">Negociacoes aguardando proposta</h1>
                        <div class="flex flex-col gap-4">
                            @foreach($negociacoes as $negociacao)
                                <div class="flex flex-row justify-between">
                                    <div>
                                        <p class="font-semibold">{{$negociacao->name}}</p>
                                        <p>{{$negociacao->deal_stage->name}}</p>
                                    </div>
                                    <div>
                                        {{--
                                        <a href="{{route('negociacoes.proposta', ['id' => $negociacao['id']])}}" class="px-6 py-3 border">Enviar proposta</a>
                                        --}}
                                    </div>
                                </div>
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-base-layout>
