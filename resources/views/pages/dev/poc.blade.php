<x-base-layout>
    <x-slot name="title">Dev - POC Simulador de Rentabilidade</x-slot>
    <x-slot name="main">
        <div class="container">

            <div class="py-16">
                <form>
                    <fieldset class="border flex flex-col justify-between items-center gap-2">
                        <legend for="mcc_option">Área de Atuação (MCC)</legend>
                        <div class="flex flex-col w-5/12 my-4" >
                            <select class="border" name="mcc_option" id="mcc_option"></select>
                        </div>
                        <div class="flex flex-col w-7/12 rounded-lg my-4 hidden" id="tabela_ac">
                            <h3>Custo Adquirente (Vero)</h3>
                            <table class="table-auto border-collapse border border-slate-400">
                                <thead>
                                    <tr>
                                        <th class="border border-slate-300">MCC</th>
                                        <th class="border border-slate-300" colspan="3">Descrição</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-slate-300" id="ac_mcc">123</td>
                                        <td class="border border-slate-300" id="ac_descricao" colspan="3">Descrição</td>
                                    </tr>
                                </tbody>
                                <thead>
                                    <tr class="text-center">
                                        <th class="border border-slate-300">Débito</th>
                                        <th class="border border-slate-300">Crédito</th>
                                        <th class="border border-slate-300">Parc. até 6x</th>
                                        <th class="border border-slate-300">Parc. de 7x até 12x</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center">
                                        <td class="border border-slate-300" id="ac_debito">1</td>
                                        <td class="border border-slate-300" id="ac_credito">2</td>
                                        <td class="border border-slate-300" id="ac_parc_2_6">3</td>
                                        <td class="border border-slate-300" id="ac_parc_7_12">4</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </fieldset>

                    <div class="hidden" id="simulator-step-2">

                        <div class="flex flex-row items-stretch justify-center mb-4 gap-2">

                            <fieldset class="border border-gray-300 rounded-lg p-4 flex flex-col gap-2 h-full w-1/3">
                                <legend>Estabelecimento</legend>
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
                                <div>
                                    <label for="antecipacao_automatica">Antecipação Automática</label>
                                    <input type="checkbox" name="opt_automatic_anticipation" id="incluir_antecipacao_automatica" class="border border-slate-300 rounded-lg">
                                </div>
                            </fieldset>

                            <fieldset class="border border-gray-300 rounded-lg p-4 flex flex-col gap-2 h-full w-1/3">
                                <legend>(%) Share de produto</legend>
                                <div>
                                    <label for="debito">Débito</label>
                                    <input type="number" name="debit_share" id="debito" class="border border-slate-300 rounded-lg" value="25" min="0" max="100" required>
                                </div>
                                <div>
                                    <label for="credito_vista">Crédito à vista</label>
                                    <input type="number" name="credit_share" id="credito_vista" class="border border-slate-300 rounded-lg" value="25" min="0" max="100" required>
                                </div>
                                <div>
                                    <label for="credito_parc_2_6">Crédito parcelado até 6x</label>
                                    <input type="number" name="credit_share_2_6" id="credito_parc_2_6" class="border border-slate-300 rounded-lg" value="25" min="0" max="100" required>
                                </div>
                                <div>
                                    <label for="credito_parc_7_12">Crédito parcelado de 7x a 12x</label>
                                    <input type="number" name="credit_share_7_12" id="credito_parc_7_12" class="border border-slate-300 rounded-lg" value="25" min="0" max="100" required>
                                </div>
                                <div class="hidden" id="share_validation_message">
                                    <p class="text-red-500">A soma dos shares de produto deve ser igual a 100%.</p>
                                </div>
                                <div class="hidden" id="p_anticipation_value_hideable">
                                    <p>
                                        Valor da Antecipação Automática: <span id="p_anticipation_value">R$ 0,00</span>
                                    </p>
                                </div>
                            </fieldset>

                        </div>

                        <div class="flex flex-row items-stretch justify-center mb-4 gap-2">

                            <fieldset class="border border-gray-300 rounded-lg p-4 flex flex-col gap-2 h-full w-2/3">
                                <legend>Proposta</legend>
                                <!-- debit, credit, parc_2_6, parc_7_12, anticipation, monthly_rental -->

                                <x-form.simulator.inputs.proposal-diff-input label="Débito (%)" id="p_debit" use-diff="true"/>
                                <x-form.simulator.inputs.proposal-diff-input label="Crédito à vista (%)" id="p_credit" use-diff="true"/>
                                <x-form.simulator.inputs.proposal-diff-input label="Parcelado até 6x (%)" id="p_credit_2_6" use-diff="true"/>
                                <x-form.simulator.inputs.proposal-diff-input label="Parcelado de 7x a 12x (%)" id="p_credit_7_12" use-diff="true"/>
                                <x-form.simulator.inputs.proposal-diff-input label="Antecipação Automática (%)" id="p_anticipation" min="1.63"/>
                                <x-form.simulator.inputs.proposal-diff-input label="Aluguel Mensal (R$)" id="p_monthly_rental" min="0"/>


                            </fieldset>

                        </div>

                        <button type="submit" class="bg-passou-magenta text-white px-4 py-2 rounded-lg">Simular</button>

                    </div>

                    <fieldset class="hidden border p-4" id="view-results">
                        <legend class="text-xl">Dados para conferência e validação</legend>

                        <div>
                            <h4 class="text-lg font-bold">Custos Operacionais</h4>

                            <div>
                                <p>
                                    <span class="font-medium bg-red-100">Comissão: </span>
                                    <span class="bg-red-100" id="operational_costs_commission">R$ 0,00</span>
                                </p>
                                <p>
                                    <span class="font-medium bg-red-100">Custo de Transações: </span>
                                    <span class="bg-red-100" id="operational_costs_transaction">R$ 0,00</span>
                                </p>
                                <p>
                                    <span class="font-medium bg-red-100">Impostos: </span>
                                    <span class="bg-red-100" id="operational_costs_taxes">R$ 0,00</span>
                                </p>
                                <p>
                                    <span class="font-medium bg-red-100">Chip: </span>
                                    <span class="bg-red-100" id="operational_costs_chip">R$ 0,00</span>
                                </p>
                                <p>
                                    <span class="font-medium bg-red-100">Entrega: </span>
                                    <span class="bg-red-100" id="operational_costs_delivery">R$ 0,00</span>
                                </p>
                                <p>
                                    <span class="font-medium bg-red-100">Depreciação: </span>
                                    <span class="bg-red-100" id="operational_costs_depreciation">R$ 0,00</span>
                                </p>
                            </div>

                            <p>
                                <span class="font-bold bg-red-100">Total: </span>
                                <span class="bg-red-100" id="operational_costs_total">R$ 0,00</span>
                            </p>

                            <p>
                                <span class="font-bold bg-red-100">Máquinas: </span>
                                <span class="bg-red-100" id="operational_costs_machines">R$ 0,00</span>
                            </p>
                        </div>

                        <hr>

                        <div>
                            <h4 class="text-lg font-bold">Resultados</h4>
                            <!-- Mensal e Anual -->
                            <p>
                                <span class="font-medium bg-green-100">Receita Mensal: </span>
                                <span class="bg-green-100" id="results_revenue_monthly">R$ 0,00</span>
                            </p>
                            <p>
                                <span class="font-medium bg-green-100">Receita Anual: </span>
                                <span class="bg-green-100" id="results_revenue_annual">R$ 0,00</span>
                            </p>

                        </div>
                    </fieldset>


                </form>
            </div>

        </div>
        <script>
            const mccOptionsSelect = document.getElementById('mcc_option');
            const monthlyIncomeInput = document.getElementById('faturamento_mensal');

            const debitShareInput = document.getElementById('debito');
            const creditShareInput = document.getElementById('credito_vista');
            const creditShare2_6Input = document.getElementById('credito_parc_2_6');
            const creditShare7_12Input = document.getElementById('credito_parc_7_12');


            const proposalDebit = document.getElementById('p_debit');
            const proposalCredit = document.getElementById('p_credit');
            const proposalC26 = document.getElementById('p_credit_2_6');
            const proposalC712 = document.getElementById('p_credit_7_12');
            const proposalAnticipation = document.getElementById('p_anticipation');

            const acDebit = document.getElementById('ac_debito');
            const acCredit = document.getElementById('ac_credito');
            const acC26 = document.getElementById('ac_parc_2_6');
            const acC712 = document.getElementById('ac_parc_7_12');

            constIdInputMapping = {
                p_debit: acDebit,
                p_credit: acCredit,
                p_credit_2_6: acC26,
                p_credit_7_12: acC712,
            }

            //mask shares as percentage: 0-100 with 2 decimal places
            //example of code for maskinput: https://stackoverflow.com/questions/469357/html-text-input-allow-only-numeric-input

            const proposalInputs = [proposalDebit, proposalCredit, proposalC26, proposalC712];
            const shareInputs = [debitShareInput, creditShareInput, creditShare2_6Input, creditShare7_12Input];

            document.getElementById('faturamento_mensal').addEventListener('change', function() {
                updateValorDaAntecipacao();
            });

            document.getElementById('incluir_antecipacao_automatica').addEventListener('change', function() {
                //chao de p_antecipa: 1,63%
                document.getElementById('p_anticipation_value_hideable').classList.toggle('hidden')
                if (this.checked) {
                    updateValorDaAntecipacao();
                } else {
                    document.getElementById('p_anticipation_value').innerText = 'R$ 0,00';
                    document.getElementById('p_anticipation').value = 0;
                }
            });

            //fetch select options from '/api/simulator/get-mcc-options'
            fetch('/api/simulator/get-mcc-options')
                .then(response => response.json())
                .then(data => {
                    //first option is a placeholder
                    let option = document.createElement('option');
                    option.value = '';
                    option.text = 'Selecione uma opção';
                    option.disabled = true;
                    option.selected = true;
                    mccOptionsSelect.appendChild(option);
                    //add options to select
                    data.forEach(mccOption => {
                        let option = document.createElement('option');
                        option.value = mccOption.value;
                        option.text = mccOption.value + ' - ' + mccOption.label;
                        mccOptionsSelect.appendChild(option);
                    });

                    mccOptionsSelect.addEventListener('change', function() {
                        fetch('/api/simulator/get-acquirer-costs/' + this.value)
                            .then(response => response.json())
                            .then(data => {
                                if (document.getElementById('simulator-step-2').classList.contains('hidden')){
                                    document.getElementById('simulator-step-2').classList.remove('hidden');
                                }
                                document.getElementById('tabela_ac').classList.remove('hidden');
                                document.getElementById('ac_mcc').innerText = data.mcc;
                                document.getElementById('ac_descricao').innerText = data.descricao;
                                let custosAdquirente = data.custos_adquirente;
                                acDebit.innerText = custosAdquirente.debit + '%';
                                acCredit.innerText = custosAdquirente.credito_vista + '%';
                                acC26.innerText = custosAdquirente.credito_parc_2_6 + '%';
                                acC712.innerText = custosAdquirente.credito_parc_7_12 + '%';
                                //set proposal values
                                proposalDebit.value = custosAdquirente.debit + 0.4;
                                proposalCredit.value = custosAdquirente.credito_vista + 0.4;
                                proposalC26.value = custosAdquirente.credito_parc_2_6 + 0.4;
                                proposalC712.value = custosAdquirente.credito_parc_7_12 + 0.4;
                                proposalAnticipation.value = 1.63;
                            });
                    });
                });

            shareInputs.forEach(shareInput => {
                shareInput.addEventListener('change', function() {
                    let sum = 0;
                    shareInputs.forEach(shareInput => {
                        sum += parseInt(shareInput.value);
                    });
                    if (sum != 100) {
                        //set border color to red
                        shareInputs.forEach(shareInput => {
                            shareInput.classList.add('border-red-500');
                        });
                        document.getElementById('share_validation_message').classList.remove('hidden');
                    } else {
                        //set border color to default
                        shareInputs.forEach(shareInput => {
                            shareInput.classList.remove('border-red-500');
                        });
                        if (!document.getElementById('share_validation_message').classList.contains('hidden')){
                            document.getElementById('share_validation_message').classList.add('hidden');
                        }
                        //chamar atualizar valor da antecipação automática
                        updateValorDaAntecipacao();
                    }
                });
            });

            proposalInputs.forEach(proposalInput => {
                proposalInput.addEventListener('change', function(){
                    let proposalInputId = proposalInput.id;
                    let diffId = proposalInputId + '_diff';
                    let proposalValue = proposalInput.value;
                    //get from idInputMapping
                    let acquirerCost = constIdInputMapping[proposalInputId].innerText;
                    //remove % sign
                    acquirerCost = acquirerCost.replace('%', '');
                    //calculate diff
                    let diff = proposalValue - acquirerCost;
                    //set diff value
                    document.getElementById(diffId).innerText = diff.toFixed(2) + '%';
                    //if diff is negative, set color to red
                    setDiffTextColor(diffId, diff);
                })
            })

            function setDiffTextColor(diffId, diff) {
                if (diff < 0) {
                    if (!document.getElementById(diffId).classList.contains('text-red-500')){
                        document.getElementById(diffId).classList.remove('text-green-500');
                    }
                    if (!document.getElementById(diffId).classList.contains('text-red-500')){
                        document.getElementById(diffId).classList.add('text-red-500');
                    }
                } else if(diff > 0){
                    if (!document.getElementById(diffId).classList.contains('text-green-500')){
                        document.getElementById(diffId).classList.remove('text-red-500');
                    }
                    if (!document.getElementById(diffId).classList.contains('text-green-500')){
                        document.getElementById(diffId).classList.add('text-green-500');
                    }
                } else {
                    if (!document.getElementById(diffId).classList.contains('text-green-500')){
                        document.getElementById(diffId).classList.remove('text-red-500');
                    }
                    if (!document.getElementById(diffId).classList.contains('text-green-500')){
                        document.getElementById(diffId).classList.add('text-green-500');
                    }
                }
            }

            function updateValorDaAntecipacao() {
                let allInputsFilled = true;
                if (!document.getElementById('incluir_antecipacao_automatica').checked) {
                    allInputsFilled = false;
                }

                shareInputs.forEach(shareInput => {
                    if (shareInput.value === '') {
                        allInputsFilled = false;
                    }
                });

                if (monthlyIncomeInput.value === '' || monthlyIncomeInput.value === '0' || monthlyIncomeInput.value === 0) {
                    allInputsFilled = false;
                }

                if (allInputsFilled) {
                    let monthlyIncome = monthlyIncomeInput.value;
                    let creditShare = creditShareInput.value;
                    let creditShare2_6 = creditShare2_6Input.value;
                    let creditShare7_12 = creditShare7_12Input.value;
                    let valorDaAntecipacao = (creditShare/100 + creditShare2_6/100 + creditShare7_12/100) * monthlyIncome;
                    //format as R$ #.###,##
                    document.getElementById('p_anticipation_value').innerText = valorDaAntecipacao.toLocaleString('pt-br', {style: 'currency', currency: 'BRL'});
                }
            }

            document.querySelector('form').addEventListener('submit', function(event) {
                event.preventDefault();
                calculateResult();
            });

            function calculateResult() {
                let mcc = mccOptionsSelect.value;
                let pointsOfSale = document.getElementById('pontos_de_venda').value;
                let equipmentQuantity = document.getElementById('maquinas').value;
                let link = 0;
                let monthlyIncome = monthlyIncomeInput.value;
                let mediumTicket = document.getElementById('ticket_medio').value;
                let optAutomaticAnticipation = document.getElementById('incluir_antecipacao_automatica').checked;
                let productShare = {
                    debit: debitShareInput.value,
                    credit: creditShareInput.value,
                    parc_2_6: creditShare2_6Input.value,
                    parc_7_12: creditShare7_12Input.value,
                };
                let proposal = {
                    debit: proposalDebit.value,
                    credit: proposalCredit.value,
                    parc_2_6: proposalC26.value,
                    parc_7_12: proposalC712.value,
                    anticipation: proposalAnticipation.value,
                    monthly_rental: document.getElementById('p_monthly_rental').value,
                };
                let body = {
                    mcc: mcc,
                    points_of_sale: pointsOfSale,
                    equipment_quantity: equipmentQuantity,
                    link: link,
                    monthly_income: monthlyIncome,
                    medium_ticket: mediumTicket,
                    opt_automatic_anticipation: optAutomaticAnticipation,
                    product_share: productShare,
                    proposal: proposal,
                };
                fetch('/api/simulator/calculate', {
                    method: 'POST',
                    body: JSON.stringify(body),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        //set operational costs
                        document.getElementById('operational_costs_commission').innerText = data.custos.operacional.variavel.comissao.toLocaleString('pt-br', {style: 'currency', currency: 'BRL'});
                        document.getElementById('operational_costs_transaction').innerText = data.custos.operacional.variavel.custo_transacoes.toLocaleString('pt-br', {style: 'currency', currency: 'BRL'});
                        document.getElementById('operational_costs_taxes').innerText = data.custos.operacional.variavel.impostos.toLocaleString('pt-br', {style: 'currency', currency: 'BRL'});
                        document.getElementById('operational_costs_chip').innerText = data.custos.operacional.variavel.chip.toLocaleString('pt-br', {style: 'currency', currency: 'BRL'});
                        document.getElementById('operational_costs_delivery').innerText = data.custos.operacional.variavel.entrega.toLocaleString('pt-br', {style: 'currency', currency: 'BRL'});
                        document.getElementById('operational_costs_machines').innerText = data.custos.operacional.fixo.custo_maquinas.toLocaleString('pt-br', {style: 'currency', currency: 'BRL'});
                        document.getElementById('operational_costs_depreciation').innerText = data.custos.operacional.variavel.depreciacao.toLocaleString('pt-br', {style: 'currency', currency: 'BRL'});
                        document.getElementById('operational_costs_total').innerText = data.custos.operacional.variavel.total_outros_custos.toLocaleString('pt-br', {style: 'currency', currency: 'BRL'});
                        //set results
                        document.getElementById('results_revenue_monthly').innerText = data.resultados.liquido.mensal.toLocaleString('pt-br', {style: 'currency', currency: 'BRL'});
                        document.getElementById('results_revenue_annual').innerText = data.resultados.liquido.anual.toLocaleString('pt-br', {style: 'currency', currency: 'BRL'});
                        //show results
                        document.getElementById('view-results').classList.remove('hidden');
                    });
            }
        </script>
    </x-slot>
</x-base-layout>
