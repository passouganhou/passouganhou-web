<x-base-layout>
    <x-slot name="title">Dashboard</x-slot>
    <x-slot name="main">
    <x-dashboard.layout>
        <x-slot name="header">
            Teste
        </x-slot>
        <x-slot name="content">
            <div class="shadow-md rounded-md px-10 py-10 flex flex-col gap-10">
                <h1 class="text-xl font-bold text-center">Área do Vendedor</h1>
                <div class="flex flex-col gap-4">
                    <!-- success -->
                    @if(session('success'))
                        <div class="bg-green-500 text-white rounded-md px-4 py-2">
                            {{session('success')}}
                        </div>
                    @endif
                    <p>
                        Bem-vindo, {{auth()->user()->name}}!
                    </p>
                    <div class="flex flex-col gap-4">
                        <a href="{{route('rd.negociacoes')}}" class="px-6 py-3 border w-fit hover:bg-passou-magenta hover:text-white transition">Minhas negociações</a>
                        <a href="{{route('rd.simulador-proposta')}}" class="px-6 py-3 border w-fit hover:bg-passou-magenta hover:text-white transition">Simulador de proposta</a>
                        <a href="{{route('rd.history')}}" class="px-6 py-3 border w-fit hover:bg-passou-magenta hover:text-white transition">Atividade</a>
                        <hr>
                        <form method="POST" action="{{route('logout')}}">
                            @csrf
                            <button type="submit" class="px-6 py-3 border text-red-500 hover:bg-red-500 hover:text-white transition">Sair</button>
                        </form>
                    </div>
                </div>
            </div>
        </x-slot>
    </x-dashboard.layout>
    </x-slot>
</x-base-layout>
