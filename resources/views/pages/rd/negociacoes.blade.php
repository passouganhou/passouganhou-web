<x-base-layout>
    <x-slot name="title">RD Station - Negociacoes</x-slot>
    <x-slot name="main">
        <x-dashboard.layout>
            <x-slot name="content">

                <div class="shadow-md px-10 py-10 flex flex-col gap-10">
                    <a href="{{route('dashboard')}}" class="float-left inline-flex w-fit gap-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M10 19l-7-7m0 0l7-7m-7 7h18">
                            </path>
                        </svg>
                        Voltar
                    </a>
                    <h1 class="text-xl font-bold text-center">Negociações aguardando proposta</h1>
                    <div class="flex flex-col gap-4">
                        @foreach($negociacoes as $negociacao)

                            <div class="flex flex-col md:flex-row justify-between border">
                                <div class="px-8 py-4 " >
                                    <p class="text-lg font-semibold">{{$negociacao->name}}</p>
                                    <p>{{$negociacao->deal_stage->name}}</p>
                                </div>
                                <div class="px-8 py-4 flex flex-col border-l gap-4 text-center">
                                    <a class="px-4 py-2 bg-passou-cyan text-white hover:shadow transition" href="{{route('rd.proposta', ['id' => $negociacao->_id])}}">
                                        Criar proposta
                                    </a>
                                    <a class="border px-4 py-2 hover:shadow transition hover:border-white" href="https://crm.rdstation.com/app/deals/{{$negociacao->_id}}?view=pipeline" target="_blank">
                                        Ver no RD Station
                                    </a>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            </x-slot>
        </x-dashboard.layout>
    </x-slot>
</x-base-layout>
