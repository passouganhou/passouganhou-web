<x-filament::widget>
    <x-filament::card>
        <h2 class="text-lg sm:text-xl font-bold tracking-tight">
            Exportar formulários enviados
        </h2>
        <form action="{{ route('export.contacts') }}" method="POST">
            @csrf
            <div class="filament-forms-field-wrapper">
                <div class="space-y-2">
                    <div class="flex items-center justify-between space-x-2 rtl:space-x-reverse">
                        <label
                            class="filament-forms-field-wrapper-label inline-flex items-center space-x-3 rtl:space-x-reverse"
                            for="filter">
                            <span class="text-sm font-medium leading-4 text-gray-700">
                                Escolher formulário
                            </span>
                        </label>
                    </div>
                    <div class="filament-forms-select-component flex items-center space-x-1 rtl:space-x-reverse group">
                        <div class="flex-1 min-w-0">
                            <select id="filter" name="filter"
                                class="text-gray-900 block w-full transition duration-75 rounded-lg shadow-sm focus:border-primary-500 focus:ring-1 focus:ring-inset focus:ring-primary-500 disabled:opacity-70 border-gray-300">
                                <option value="all" selected>Todos os formulários</option>


                                <option value="form-peca-a-sua">
                                    Peça sua maquininha
                                </option>
                                <option value="form-venda-pela-internet">
                                    Venda pela internet
                                </option>
                            </select>
                        </div>
                    </div>
                    <button class="filament-button inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 filament-page-button-action">
                        <span class="flex items-center gap-1">
                            <span>
                                Exportar
                            </span>
                        </span>

                    </button>
                </div>
            </div>
        </form>
    </x-filament::card>
</x-filament::widget>
