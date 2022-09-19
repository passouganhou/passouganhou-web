<div x-data="{
    open: @entangle('open')
}"
x-show="open"
x-cloak
x-on:open-contact-form.window="open = true"
x-on:keydown.escape.prevent.stop="open = false" role="dialog" aria-modal="true"
    aria-labelledby="auth-modal-title" class="fixed inset-0 z-[99] overflow-y-auto">
    <div x-show="open" x-transition.opacity="" class="fixed inset-0 bg-black bg-opacity-50" aria-hidden="true"></div>

    <div x-show="open" x-transition="" x-on:click="open = false"
        class="relative flex min-h-screen items-center justify-center p-4">
        <div x-on:click.stop="" x-trap.noscroll.inert="open"
            class="w-full max-w-xl rounded-xl bg-white py-8 px-6 sm:p-12 relative">
            <button x-on:click.prevent="open = false"
                class="absolute top-4 right-4 inline-flex h-6 w-6 items-center justify-center">
                <span class="sr-only">Close dialog</span>
                <span class="text-3xl font-light text-gray-500 transition-colors hover:text-gray-600"
                    aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </span>
            </button>

            <div class="flex inset-0 absolute justify-center items-center z-10" wire:loading.flex>
                <div class="inset-0 absolute bg-white opacity-60"></div>
                <div class="lds-ring opacity-90"><div></div><div></div><div></div><div></div></div>
            </div>

            @if (!$success)
                <h2 class="text-center font-segoe-ui text-2xl text-passou-magenta-800 leading-tight mb-5">Preencha os dados e peça a sua <b class="uppercase">Passou Ganhou</b>!</h2>

                <form wire:submit.prevent="submit">
                    @csrf

                    <div class="mt-4">
                        <label class="block font-medium text-sm text-dark-black" for="name">
                            Nome
                        </label>
                        <input
                            class="border-golden border-2 p-2 focus:border-cyan-400 focus:ring focus:ring-cyan-400 focus:ring-opacity-50 mt-1 block w-full rounded-lg"
                            wire:model.defer="name" id="name" type="text" name="name" placeholder="Seu Nome">
                        @error('name') <span class="text-red-700 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mt-4">
                        <label class="block font-medium text-sm text-dark-black" for="email">
                            Email
                        </label>
                        <input
                            class="border-golden border-2 p-2 focus:border-cyan-400 focus:ring focus:ring-cyan-400 focus:ring-opacity-50 mt-1 block w-full rounded-lg"
                            wire:model.defer="email" id="email" type="text" name="email" placeholder="Seu Email">
                        @error('email') <span class="text-red-700 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mt-4">
                        <label class="block font-medium text-sm text-dark-black" for="phone">
                            Telefone
                        </label>
                        <input
                            class="border-golden border-2 p-2 focus:border-cyan-400 focus:ring focus:ring-cyan-400 focus:ring-opacity-50 mt-1 block w-full rounded-lg"
                            wire:model.defer="phone" id="phone" type="text" name="phone" placeholder="Seu telefone" x-mask="(99) 99999-9999">
                            @error('phone') <span class="text-red-700 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mt-4">
                        <div>
                            <input type="checkbox" id="chkMobileOptin" wire:model.defer="mobileOptIn" name="mobileOptIn" value="yes">
                            <label for="chkMobileOptin">Aceito receber comunicação no meu celular </label>
                        </div>

                        <div>
                            <input type="checkbox" id="chkEmailOptin" wire:model.defer="emailOptIn" name="emailOptIn" value="yes">
                            <label for="chkEmailOptin">Aceito receber comunicação no meu e-mail </label>
                        </div>
                    </div>

                    <div class="flex justify-center pt-8">
                        <button type="submit"
                            class="transition-colors duration-200 rounded-full flex justify-center items-center font-bold py-4 text-white bg-passou-cyan hover:bg-passou-magenta px-16"
                            wire:loading.attr.disabled="true">
                            Enviar
                        </button>
                    </div>
                </form>
            @else
                <h2 class="text-center text-golden font-bold text-xl">Formulário enviado, logo entraremos em contato!</h2>
            @endif
        </div>
    </div>
</div>
