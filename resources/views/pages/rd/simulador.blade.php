@php
    $visaMasterDefaultDiff = 0.40;
    $eloAmexDefaultDiff = 0.80;
@endphp
<x-base-layout>
    <x-slot name="title">Dev - POC Simulador de Rentabilidade</x-slot>
    <x-slot name="main">
        <div class="container">

            <div class="py-16">
                <form>
                    <div class="shadow flex flex-col justify-between gap-2">
                        <a href="{{isset($deal) ? route('rd.negociacoes') : route('dashboard')}}" class="px-6 pt-6 h-fit float-left inline-flex w-fit gap-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M10 19l-7-7m0 0l7-7m-7 7h18">
                                </path>
                            </svg>
                            Voltar
                        </a>
                        <div class="items-center flex flex-col justify-between gap-2">
                            <div>
                                <div class="py-5">
                                    <h1 class="text-2xl font-bold">Simulador de Rentabilidade</h1>
                                    <p class="text-sm">Preencha os campos abaixo para simular a rentabilidade de uma proposta.</p>
                                </div>
                                <hr>
                                <div class="py-5 flex flex-col gap-4">
                                    <div>
                                        <span class="font-semibold" for="vendedor">Vendedor</span>
                                        <span class="border px-2">{{Auth::user()->name}}</span>
                                        <input type="hidden" name="vendedor" id="vendedor" value="{{Auth::user()->rd_crm_user_id}}">
                                    </div>
                                    @if(isset($deal))
                                        <div>
                                            <span class="font-semibold" for="cliente">Cliente</span>
                                            <span class="border px-2">{{$deal->name}}</span>
                                        </div>
                                    @endif
                                </div>

                            </div>
                            <div class="flex flex-col w-5/12 my-4" >
                                <label class="font-semibold" for="mcc_option">Área de Atuação (MCC)</label>
                                <select class="border" name="mcc_option" id="mcc_option"></select>
                            </div>
                            @include('components.simulator.acquirer-costs-table')
                        </div>

                        @include('components.simulator.simulator-proposta-form')

                        @include('components.simulator.results')

                        @include('components.simulator.resumo', ['sendToRD' => isset($deal)])

                    </div>
                </form>
            </div>

        </div>
        @include('components.simulator.script', ['sendToRD' => isset($deal)])
    </x-slot>
</x-base-layout>
