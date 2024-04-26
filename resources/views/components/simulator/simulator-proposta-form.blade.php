<div class=" py-4 hidden" id="simulator-step-2">

    <div class="flex flex-col md:flex-row items-stretch justify-center mb-4 gap-2">

        <div class="border border-gray-300 rounded-lg p-4 flex flex-col gap-2 h-full w-full md:w-1/3">
            <span class="font-semibold text-md">Estabelecimento</span>
            <hr>
            <div>
                <label for="pontos_de_venda">Pontos de Venda</label>
                <input type="number" name="points_of_sale" id="pontos_de_venda" class="border border-slate-300 rounded-lg" value="1" min="1">
            </div>
            <div>
                <label for="maquinas">Máquinas</label>
                <input type="number" name="equipment_quantity" id="maquinas" class="border border-slate-300 rounded-lg" value="1" min="1">
            </div>
            <div>
                <label for="faturamento_mensal">Faturamento Mensal</label>
                <input type="number" name="monthly_income" id="faturamento_mensal" class="border border-slate-300 rounded-lg" min="0" required>
            </div>
            <div>
                <label for="ticket_medio">Ticket Médio</label>
                <input type="number" name="medium_ticket" id="ticket_medio" class="border border-slate-300 rounded-lg" min="0" required>
            </div>
        </div>

        <div class="border border-gray-300 rounded-lg p-4 flex flex-col gap-2 h-full w-full md:w-1/3">
            <span class="font-semibold text-md">(%) Share de produto</span>
            <hr>
            <div>
                <label for="debito">Débito</label>
                <input type="number" name="debit_share" id="debito" class="border border-slate-300 rounded-lg" value="25" min="0" max="100" required>
            </div>
            <div>
                <label for="credito_vista">Crédito à vista</label>
                <input type="number" name="credit_share" id="credito_vista" class="border border-slate-300 rounded-lg" value="25" min="0" max="100" required>
            </div>
            <div>
                <label for="credito_parc_2_6">Crédito até 6x</label>
                <input type="number" name="credit_share_2_6" id="credito_parc_2_6" class="border border-slate-300 rounded-lg" value="25" min="0" max="100" required>
            </div>
            <div>
                <label for="credito_parc_7_12">Crédito de 7x a 12x</label>
                <input type="number" name="credit_share_7_12" id="credito_parc_7_12" class="border border-slate-300 rounded-lg" value="25" min="0" max="100" required>
            </div>
            <div class="hidden" id="share_validation_message">
                <p class="text-red-500">A soma dos shares de produto deve ser igual a 100%.</p>
            </div>
        </div>

    </div>

    <div class="flex flex-row items-stretch justify-center mb-4 gap-2">

        <div class="border border-gray-300 rounded-lg p-4 flex flex-col gap-2 h-full w-full md:w-2/3">
            <legend class="font-bold">Proposta</legend>
            <hr>
            <!-- debit, credit, parc_2_6, parc_7_12, anticipation, monthly_rental -->

            <div class="py-4">
                <span class="font-semibold text-md">VISA/MASTER</span>
                <x-form.simulator.inputs.proposal-diff-input label="Débito (%)" id="p_debit" use-diff="{{$visaMasterDefaultDiff}}"/>
                <x-form.simulator.inputs.proposal-diff-input label="Crédito à vista (%)" id="p_credit" use-diff="{{$visaMasterDefaultDiff}}"/>
                <x-form.simulator.inputs.proposal-diff-input label="Parcelado até 6x (%)" id="p_credit_2_6" use-diff="{{$visaMasterDefaultDiff}}"/>
                <x-form.simulator.inputs.proposal-diff-input label="Parcelado de 7x a 12x (%)" id="p_credit_7_12" use-diff="{{$visaMasterDefaultDiff}}"/>
            </div>

            <hr>

            <div class="pt-4 pb-3">
                <span class="font-semibold text-md">ELO/AMEX</span>
                <x-form.simulator.inputs.proposal-diff-input label="Débito (%)" id="p_debit_elo" use-diff="0.4"/>
                <x-form.simulator.inputs.proposal-diff-input label="Crédito à vista (%)" id="p_credit_elo" use-diff="0.4"/>
                <x-form.simulator.inputs.proposal-diff-input label="Parcelado até 6x (%)" id="p_credit_2_6_elo" use-diff="0.4"/>
                <x-form.simulator.inputs.proposal-diff-input label="Parcelado de 7x a 12x (%)" id="p_credit_7_12_elo" use-diff="0.4"/>
            </div>

            <hr>

            <div class="py-4">
                <x-form.simulator.inputs.proposal-diff-input label="Antecipação Automática (%)" id="p_anticipation" min="1.63"/>
                <x-form.simulator.inputs.proposal-diff-input label="Aluguel Mensal (R$)" id="p_monthly_rental" min="0"/>
            </div>

            <hr>
            <button type="submit" class="bg-passou-magenta text-white px-4 py-2 rounded-lg">Simular Proposta</button>

        </div>

    </div>


</div>
