<div>
    @if(!$sucess)
        <form wire:submit.prevent="debug">
            @csrf
            <div class="flex flex-col gap-4 pt-8 pb-12">
                <!-- Nome, Telefone, E-mail, Estado/Cidade, Tipo de negócio, Faturamento -->
                <x-form.inputs.floating-label name="name" label="Nome" wireModel="name"/>
                <x-form.inputs.floating-label name="telephone" label="Telefone" wireModel="telephone"/>
                <x-form.inputs.floating-label name="email" label="E-mail" wireModel="email"/>
                <div class="relative">
                    <label for="state" class="pl-1 absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] start-2.5 peer-focus:text-passou-magenta peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
                    Estado
                    </label>
                    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                            <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" />
                        </svg>
                    </div>
                    <select wire:model.defer="state" id="state" name="state" class="block px-2.5 pb-2.5 pt-5 w-full text-sm text-gray-900 bg-gray-50 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-passou-magenta peer">
                        <option value="" selected disabled>Selecione sua UF</option>
                        @foreach ($statesList as $key => $option)
                            <option value="{{$key}}">{{$option}}</option>
                        @endforeach
                    </select>
                    @error('state') <span class="text-red-700 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="relative">
                    <label for="businessMcc" class="pl-1 absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] start-2.5 peer-focus:text-passou-magenta peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
                    Tipo de negócio
                    </label>
                    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                            <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" />
                        </svg>
                    </div>
                    <select wire:model.defer="businessMcc" id="businessMcc" name="businessMcc" class="block px-2.5 pb-2.5 pt-5 w-full text-sm text-gray-900 bg-gray-50 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-passou-magenta peer">
                        <option value="" selected disabled>Selecione uma atividade</option>
                        @foreach ($mccList as $key => $option)
                            <option value="{{$key}}">{{$option}}</option>
                        @endforeach
                    </select>
                    @error('businessMcc') <span class="text-red-700 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="relative">
                    <label for="invoicing" class="pl-1 absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] start-2.5 peer-focus:text-passou-magenta peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
                    Faturamento
                    </label>
                    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                            <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" />
                        </svg>
                    </div>
                    <select wire:model.defer="invoicing" id="invoicing" name="invoicing" class="block px-2.5 pb-2.5 pt-5 w-full text-sm text-gray-900 bg-gray-50 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-passou-magenta peer">
                        <option value="" selected disabled>Selecione uma faixa</option>
                        @foreach ($invoicingList as $key => $option)
                            <option value="{{$key}}">{{$option}}</option>
                        @endforeach
                    </select>
                    @error('invoicing') <span class="text-red-700 text-sm">{{ $message }}</span> @enderror
                </div>

            </div>
            <div class="flex flex-col self-center pb-2">
                <div id="captcha" class="self-center my-4" wire:ignore></div>
                @error('captcha')
                <p class="my-3 text-sm text-red-600 text-left">
                    {{ $message }}
                </p>
                @enderror
                <button type="submit" class="flex items-center justify-center rounded-full py-3 uppercase transition-all duration-200 group cursor-pointer bg-passou-cyan text-white hover:bg-passou-magenta hover:text-white normal-case whitespace-nowrap sm:pl-10 pl-5 sm:pr-8 pr-4 font-medium pt-4 pb-5 sm:text-2xl text-lg font-segoe-ui mb-4 rounded-none">
                    Quero a minha Passou Ganhou
                </button>
            </div>
        </form>
    @else
        <div class="flex flex-col gap-4 pt-8 pb-12 bg-passou-cyan">
            <h2 class="text-center text-white font-bold text-2xl">Formulário enviado, logo entraremos em contato!</h2>
        </div>
    @endif
        <script src="https://www.google.com/recaptcha/api.js?onload=handle&render=explicit"
                async
                defer>
        </script>

        <script>
            var  handle = function(e) {
                widget = grecaptcha.render('captcha', {
                    'sitekey': '{{ $siteKey }}',
                    'theme': 'light',
                    'callback': verify
                });

            }
            var verify = function (response) {
                @this.set('captcha', response)
            }
        </script>
</div>
