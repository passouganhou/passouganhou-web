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
                    <div class="border flex flex-col justify-between items-center gap-2">
                        <label class="font-semibold" for="vendedor">Vendedor</label>
                        <select class="border" name="vendedor" id="vendedor">
                            <option value="">Selecione um vendedor</option>
                            @foreach($teamUsers as $user)
                                <option value="{{$user['id']}}">{{$user['name']}}</option>
                            @endforeach
                        </select>
                        <hr>
                        <div class="flex flex-col w-5/12 my-4" >
                            <label class="font-semibold" for="mcc_option">Área de Atuação (MCC)</label>
                            <select class="border" name="mcc_option" id="mcc_option"></select>
                        </div>
                        @include('components.simulator.acquirer-costs-table')
                    </div>

                    @include('components.simulator.simulator-proposta-form')

                    @include('components.simulator.results')

                    @include('components.simulator.resumo', ['sendToRD' => false])

                </form>
            </div>

        </div>
        <script>
            const canVisualizarCustosOperacionais = false;
            const visaMasterDefaultDiff = {{$visaMasterDefaultDiff}};
            const eloAmexDefaultDiff = {{$eloAmexDefaultDiff}};
            const token = 'PG9uZ2l0aW9uPjx0b2tlbj5hY2Nlc3M8L3Rva2VuPjwvb25naXRpb24+';
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
            const proposalDebitElo = document.getElementById('p_debit_elo');
            const proposalCreditElo = document.getElementById('p_credit_elo');
            const proposalC26Elo = document.getElementById('p_credit_2_6_elo');
            const proposalC712Elo = document.getElementById('p_credit_7_12_elo');
            const proposalAnticipation = document.getElementById('p_anticipation');

            const acDebit = document.getElementById('ac_debito');
            const acCredit = document.getElementById('ac_credito');
            const acC26 = document.getElementById('ac_parc_2_6');
            const acC712 = document.getElementById('ac_parc_7_12');
            const acDebitElo = document.getElementById('elo_ac_debito');
            const acCreditElo = document.getElementById('elo_ac_credito');
            const acC26Elo = document.getElementById('elo_ac_parc_2_6');
            const acC712Elo = document.getElementById('elo_ac_parc_7_12');

            constIdInputMapping = {
                p_debit: acDebit,
                p_credit: acCredit,
                p_credit_2_6: acC26,
                p_credit_7_12: acC712,
                p_debit_elo: acDebitElo,
                p_credit_elo: acCreditElo,
                p_credit_2_6_elo: acC26Elo,
                p_credit_7_12_elo: acC712Elo,
            }

            const proposalInputs = [
                proposalDebit,
                proposalCredit,
                proposalC26,
                proposalC712,
                proposalDebitElo,
                proposalCreditElo,
                proposalC26Elo,
                proposalC712Elo,

            ];
            const shareInputs = [debitShareInput, creditShareInput, creditShare2_6Input, creditShare7_12Input];

            document.getElementById('faturamento_mensal').addEventListener('change', function() {
                updateValorDaAntecipacao();
            });

            /*document.getElementById('incluir_antecipacao_automatica').addEventListener('change', function() {
                document.getElementById('p_anticipation_value_hideable').classList.toggle('hidden')
                if (this.checked) {
                    updateValorDaAntecipacao();
                } else {
                    document.getElementById('p_anticipation_value').innerText = 'R$ 0,00';
                    document.getElementById('p_anticipation').value = 0;
                }
            });*/

            //use header "Api-Token" to authenticate with token variable

            fetch('/api/simulator/get-mcc-options', {
                headers: {
                    'Api-Token': token
                }
            })
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
                        fetch('/api/simulator/get-acquirer-costs/' + this.value, {
                            headers: {
                                'Api-Token': token
                            }
                        })
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
                                acDebitElo.innerText = custosAdquirente.elo.debit + '%';
                                acCreditElo.innerText = custosAdquirente.elo.credito_vista + '%';
                                acC26Elo.innerText = custosAdquirente.elo.credito_parc_2_6 + '%';
                                acC712Elo.innerText = custosAdquirente.elo.credito_parc_7_12 + '%';

                                //garantir que os custos adquirente são números
                                custosAdquirente.debit = parseFloat(custosAdquirente.debit);
                                custosAdquirente.credito_vista = parseFloat(custosAdquirente.credito_vista);
                                custosAdquirente.credito_parc_2_6 = parseFloat(custosAdquirente.credito_parc_2_6);
                                custosAdquirente.credito_parc_7_12 = parseFloat(custosAdquirente.credito_parc_7_12);

                                let proposalDebitValue = getValorPropostaComMargem(custosAdquirente.debit, visaMasterDefaultDiff)
                                let proposalCreditValue = getValorPropostaComMargem(custosAdquirente.credito_vista, visaMasterDefaultDiff);
                                let proposalC26Value = getValorPropostaComMargem(custosAdquirente.credito_parc_2_6, visaMasterDefaultDiff);
                                let proposalC712Value = getValorPropostaComMargem(custosAdquirente.credito_parc_7_12, visaMasterDefaultDiff);

                                let proposalDebitEloValue = getValorPropostaComMargem((custosAdquirente.elo.debit - custosAdquirente.debit), proposalDebitValue);
                                let proposalCreditEloValue = getValorPropostaComMargem((custosAdquirente.elo.credito_vista - custosAdquirente.credito_vista), proposalCreditValue)
                                let proposalC26EloValue = getValorPropostaComMargem((custosAdquirente.elo.credito_parc_2_6 - custosAdquirente.credito_parc_2_6), proposalC26Value);
                                let proposalC712EloValue = getValorPropostaComMargem((custosAdquirente.elo.credito_parc_7_12 - custosAdquirente.credito_parc_7_12), proposalC712Value);

                                //set proposal values
                                proposalDebit.value = proposalDebitValue;
                                proposalCredit.value = proposalCreditValue;
                                proposalC26.value = proposalC26Value;
                                proposalC712.value = proposalC712Value;
                                proposalDebitElo.value = proposalDebitEloValue;
                                proposalCreditElo.value = proposalCreditEloValue;
                                proposalC26Elo.value = proposalC26EloValue;
                                proposalC712Elo.value = proposalC712EloValue;
                                proposalAnticipation.value = 1.63;
                            });
                    });
                });

            function getValorPropostaComMargem(taxa, margem) {
                let taxaFloat = parseFloat(taxa);
                let margemFloat = parseFloat(margem);
                let valor = taxaFloat + margemFloat;
                let fixed = valor.toFixed(2);
                return parseFloat(fixed);
            }

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
                    console.log(proposalInputId, acquirerCost)
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
                    opt_automatic_anticipation: true,
                    product_share: productShare,
                    proposal: proposal,
                    vendedor: document.getElementById('vendedor').value ?? 0
                };
                fetch('/api/simulator/calculate', {
                    method: 'POST',
                    body: JSON.stringify(body),
                    headers: {
                        'Content-Type': 'application/json',
                        'Api-Token': token
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (canVisualizarCustosOperacionais) {
                        setCustosOperacionais(data)
                    }
                    });


                setResumo(proposalDebit, proposalCredit, proposalC26, proposalC712, proposalDebitElo, proposalCreditElo, proposalC26Elo, proposalC712Elo)
            }

            function setCustosOperacionais(data) {
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
            }

            function setResumo(proposalDebit, proposalCredit, proposalC26, proposalC712, proposalDebitElo, proposalCreditElo, proposalC26Elo, proposalC712Elo) {

                const resumoVisaMasterId = document.getElementById('resumo_visa_master');
                const resumoEloAmexId = document.getElementById('resumo_elo_amex');
                const resumoPixId = document.getElementById('resumo_pix');

                //garantir que os valores são números
                proposalDebit = parseFloat(proposalDebit.value);
                proposalCredit = parseFloat(proposalCredit.value);
                proposalC26 = parseFloat(proposalC26.value);
                proposalC712 = parseFloat(proposalC712.value);
                proposalDebitElo = parseFloat(proposalDebitElo.value);
                proposalCreditElo = parseFloat(proposalCreditElo.value);
                proposalC26Elo = parseFloat(proposalC26Elo.value);
                proposalC712Elo = parseFloat(proposalC712Elo.value);

                let resumo = document.getElementById('resumo');

                if (!resumo) {
                    console.error("Elemento com o ID 'resumo' não encontrado na página.");
                    return;
                }

                let visaMasterP = `Débito: ${proposalDebit.toFixed(2)}% | Crédito à vista: ${proposalCredit.toFixed(2)}% | Crédito parcelado até 6x: ${proposalC26.toFixed(2)}% | Crédito parcelado de 7x a 12x: ${proposalC712.toFixed(2)}%`;
                let eloAmexP = `Débito: ${proposalDebitElo.toFixed(2)}% | Crédito à vista: ${proposalCreditElo.toFixed(2)}% | Crédito parcelado até 6x: ${proposalC26Elo.toFixed(2)}% | Crédito parcelado de 7x a 12x: ${proposalC712Elo.toFixed(2)}%`;
                let pixP = 'Pix: 0,50%';

                resumoVisaMasterId.innerText = visaMasterP;
                resumoEloAmexId.innerText = eloAmexP;
                resumoPixId.innerText = pixP;

                document.getElementById('resumo-wrapper').classList.remove('hidden');
            }

        </script>
    </x-slot>
</x-base-layout>
