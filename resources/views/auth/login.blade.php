
<x-base-layout>
    <x-slot name="title">Login</x-slot>
    <x-slot name="main">
        <div class="container">
            <div class="flex flex-row justify-center">
                <div class="w-full md:w-8/12">
                    <div class="shadow-md rounded-md px-10 py-10 flex flex-col gap-10">
                        <h1 class="text-xl font-bold text-center">Login</h1>
                        <form class="flex flex-col gap-4" action="{{route('login.post')}}" method="POST">
                            @csrf
                            <label for="email">E-mail</label>
                            <input type="email" name="email" id="email" class="border px-4 py-2">
                            <label for="password">Senha</label>
                            <input type="password" name="password" id="password" class="border px-4 py-2">
                            <button type="submit" class="px-6 py-3 bg-passou-magenta text-white ">Entrar</button>
                            <!-- Erro -->
                            @if($errors->any())
                                <div class="bg-red-500 text-white px-4 py-2">
                                    {{$errors->first()}}
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
    </x-slot>
</x-base-layout>
