<x-base-layout>
    <x-slot name="title">RD Station - Histórico </x-slot>
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
                    <h1 class="text-xl font-bold text-center">Histórico de Simulações</h1>
                    <div class="flex flex-col gap-4">
                        @forelse($simulations as $simulacao)
                        @dd($simulacao)
                            <div class="shadow-md rounded-md px-10 py-10 flex flex-col gap-10">
                                <h1 class="text-xl font-bold text-center">Simulação #{{$simulacao->id}}</h1>
                                <div class="flex flex-col gap-4">
                                    <div>
                                        <span class="font-semibold" for="vendedor">Vendedor</span>
                                        <span class="border px-2">{{$simulacao->vendedor->name}}</span>
                                    </div>
                                    <div>
                                        <span class="font-semibold" for="cliente">Cliente</span>
                                        <span class="border px-2">{{$simulacao->deal_name ?? ''}}</span>
                                    </div>
                                    <div>
                                        <span class="font-semibold" for="mcc_option">Área de Atuação (MCC)</span>
                                        <span class="border px-2">{{$simulacao->segmento->description}} ({{$simulacao->mcc}})</span>
                                    </div>
                                    <div>
                                        <span class="font-semibold" for="created_at">Data da simulação</span>
                                        <span class="border px-2">{{$simulacao->created_at->format('d/m/Y H:i')}}</span>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-4">
                                    <div>
                                        <a href="https://crm.rdstation.com/app/deals/{{ $simulacao->negociacao_id }}?view=pipeline" target="_blank" class="px-6 py-3 border w-fit hover:bg-passou-magenta hover:text-white transition">Ver negociação</a>
                                    </div>
                                </div>
                            </div>

                        @empty
                            <p>Nenhuma simulação realizada.</p>
                        @endforelse
                    </div>
                </div>
            </x-slot>
        </x-dashboard.layout>
    </x-slot>
</x-base-layout>
