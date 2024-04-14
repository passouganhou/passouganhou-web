<x-base-layout>
    <x-slot name="title">RD Station - Login</x-slot>
    <x-slot name="main">
        <div class="container">
            <div class="flex flex-row justify-center">
                <div class="w-8/12">
                    <div class="shadow-md rounded-md px-10 py-10 flex flex-col gap-10">
                        <h1 class="text-xl font-bold text-center">Login</h1>
                        <a href="{{$rd_auth_url}}" class="px-6 py-3 border">Entrar com <span class="font-semibold">RD Station</span></a>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-base-layout>
