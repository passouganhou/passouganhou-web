<?php

namespace App\Http\Controllers\Api;

use App\Helpers\RdHelper;
use App\Http\Controllers\Controller;
use App\Models\MerchantService;
use App\Models\Simulacao;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class SimulatorController extends Controller
{

    protected float $cdi = 1.09;
    protected float $incomeTax = 14.25, $transactionTax = 1.70;
    protected float $equipmentCost = 1100.00, $deliveryAnualCost = 84.00, $chipCost = 5.00;
    protected float $comissionPercentage = 20.00;

    protected function getAnticipationTax() {
        //cdi + 0,35%
        return $this->cdi + 0.35;
    }

    protected function getAnticipatedValue(array $productShare, float $monthlyIncome)
    {
        if(!empty($productShare) && !empty($monthlyIncome)){
            if (($productShare['debit'] + $productShare['credit'] + $productShare['parc_2_6'] + $productShare['parc_7_12']) != 100.00){
                return false; //error: a soma das taxas deve ser igual a 100%
            }
            return ($productShare['credit'] + $productShare['parc_2_6'] + $productShare['parc_7_12'])/100 * $monthlyIncome;
        }
        return false; //error: productShare ou monthlyIncome vazio
    }

    protected function getMdr($diff, $productShare, $merchantInfo)
    {
        $debitMdr = $diff['debit']/100 * $productShare['debit']/100 * $merchantInfo['faturamento_mensal'];
        $creditMdr = $diff['credit']/100 * $productShare['credit']/100 * $merchantInfo['faturamento_mensal'];
        $parc2a6Mdr = $diff['parc_2_6']/100 * $productShare['parc_2_6']/100 * $merchantInfo['faturamento_mensal'];
        $parc7a12Mdr = $diff['parc_7_12']/100 * $productShare['parc_7_12']/100 * $merchantInfo['faturamento_mensal'];
        $sum = $debitMdr + $creditMdr + $parc2a6Mdr + $parc7a12Mdr;
        return (float) $sum;
    }

    public function index()
    {
        $merchantServices = MerchantService::all();

        return response()->json($merchantServices);
    }

    public function show($mcc)
    {
        $merchantService = MerchantService::where('mcc', $mcc)->first();

        if (!$merchantService) {

            header("HTTP/1.0 404 Not Found");
            echo "MCC não encontrado";
            exit;
        }

        $merchantService->makeHidden(['created_at', 'updated_at', 'deleted_at']);
        $mediumTaxes = $merchantService->getMediumTaxes();
        $eloTaxes = $merchantService->getEloTaxes();
        $anticipationTax = $this->getAnticipationTax();
        $mediumTaxes['anticipation'] = $anticipationTax;
        $merchantService->custos_adquirente = $mediumTaxes;
        $merchantService->custos_adquirente['elo'] = $eloTaxes;

        return response()->json($merchantService);
    }

    public function getMCCOptions()
    {
        $merchantServicesOptions = MerchantService::all(['mcc as value', 'description as label']);
        //ordenar por label
        $merchantServicesOptions = $merchantServicesOptions->sortBy('label')->values()->all();

        return response()->json($merchantServicesOptions);
    }
    protected function getOperationCosts($merchantInfo, $bruteResults)
    {
        $equipmentQuantity = $merchantInfo['quantidade_maquinas'];
        $monthlyIncome = $merchantInfo['faturamento_mensal'];
        $monthlyEarnings = $bruteResults['receita_total'];
        $mediumTicket = $merchantInfo['ticket_medio'];

        $response = [
            'fixo' => [
                'comissao_percentagem' => $this->comissionPercentage,
                'custo_maquinas' => $this->equipmentCost, // custo fixo
            ],
            'variavel' => [
                'impostos' => round($this->incomeTax/100 * $monthlyEarnings, 2), // 14,25% * receita total
                'custo_transacoes' => round($this->transactionTax/100 * ($monthlyIncome/$mediumTicket), 2), //0.017 * (faturamento mensal/ticket medio) onde 0.017 é o custo por transação
                'comissao' => round($monthlyEarnings/100 * $this->comissionPercentage, 2), // receita total * 20%
                'chip' => $this->chipCost * $equipmentQuantity, // 5 * numero maquinas
                'entrega' => $this->deliveryAnualCost/12 * $equipmentQuantity, // 84/12 * numero maquinas
                'depreciacao' => round($this->equipmentCost/60 * $equipmentQuantity, 2), // custo maquinas / 60 * numero maquinas
            ]
        ];

        return $response;
    }

    protected function getBrutResult($merchantInfo, $merchantOptions, $productShare, $proposal, $diff, $anticipatedValue = null)
    {
        $mdr = $this->getMdr($diff, $productShare, $merchantInfo);
        $anticipation = $merchantOptions['automatic_anticipation'] && $anticipatedValue !== null ? $anticipatedValue * $diff['anticipation']/100 : 0;
        $monthlyRent = round($proposal['rent'] * $merchantInfo['quantidade_maquinas'], 2);
        $totalIncome = $mdr + $anticipation + $monthlyRent;

        //Caro prestador de serviço, por favor, não invente moda

        $response = [
            'mdr' => $mdr,
            'antecipacao' => $anticipation,
            'aluguel_mensal' => $monthlyRent,
            'receita_total' => $totalIncome,
            'receita_percentual' => round($totalIncome/$merchantInfo['faturamento_mensal']*100, 3)
        ];

        return $response;
    }

    public function simulateResults(Request $request)
    {
        $merchantData = $this->getAcquirerCosts($request->mcc);

        $merchantInfo = [
            'mcc' => $merchantData['mcc'],
            'segmento' => $merchantData['descricao'],
            'pontos_de_venda' => $request->points_of_sale ?? 1,
            'quantidade_maquinas' => $request->equipment_quantity ?? 1,
            'links' => $request->link ?? 0,
            'faturamento_mensal' => $request->monthly_income,
            'ticket_medio' => $request->medium_ticket,
        ];

        $merchantOptions = [
            'automatic_anticipation' => $request->opt_automatic_anticipation ?? false,
        ];

        $productShare = [
            'debit' => $request->product_share['debit'],
            'credit' => $request->product_share['credit'],
            'parc_2_6' => $request->product_share['parc_2_6'],
            'parc_7_12' => $request->product_share['parc_7_12'],
        ];

        $proposal = [
            'debit' => $request->proposal['debit'],
            'credit' => $request->proposal['credit'],
            'parc_2_6' => $request->proposal['parc_2_6'],
            'parc_7_12' => $request->proposal['parc_7_12'],
            'anticipation' => $request->proposal['anticipation'],
            'rent' => $request->proposal['monthly_rental'],
        ];

        $anticipatedValue = $this->getAnticipatedValue($productShare, $merchantInfo['faturamento_mensal']);
        $diff = $this->calculateProposalCostDifferences($proposal, $merchantData['custos_adquirente']);
        $brutResults = $this->getBrutResult($merchantInfo, $merchantOptions, $productShare, $proposal, $diff, $anticipatedValue);
        $operationCosts = $this->getOperationCosts($merchantInfo, $brutResults);

        $operationCosts['variavel']['total_outros_custos'] = array_reduce($operationCosts['variavel'], function($carry, $item) {
            $carry += $item;
            return $carry;
        });

        $liquidMonthlyResults = $brutResults['receita_total'] - $operationCosts['variavel']['total_outros_custos'];

        $acquireCosts = $merchantData['custos_adquirente'];

        $response = [
            'dados' => $merchantInfo,
            'diferenca' => [
                'debito' => $diff['debit'].'%',
                'credito' => $diff['credit'].'%',
                'parcelado_2_6' => $diff['parc_2_6'].'%',
                'parcelado_7_12' => $diff['parc_7_12'].'%',
                'antecipacao' => $diff['anticipation'].'%',
        ],
            'custos' => [
                'adquirente' => [
                    'debito' => $acquireCosts['debit'].'%',
                    'credito_a_vista' => $acquireCosts['credito_vista'].'%',
                    'credito_parcelado_2_6' => $acquireCosts['credito_parc_2_6'].'%',
                    'credito_parcelado_7_12' => $acquireCosts['credito_parc_7_12'].'%',
                    'antecipacao' => $acquireCosts['anticipation'].'%',
                ],
                'elo' => [],
                'operacional' => $operationCosts
            ],
            'resultados' => [
                'liquido' => [
                    'mensal' => round($liquidMonthlyResults ,2),
                    'anual' => round($liquidMonthlyResults * 12 ,2)
                ],
                'bruto' => [
                    'mensal' => $brutResults
                ]
            ]
        ];

        if ($liquidMonthlyResults < 100){
            $response['observacoes'][] = 'Receita líquida mensal é INFERIOR a R$ 100,00';
            $response['needs_approval'] = true;
        }

        return response()->json($response);
    }

    public function submitSimulation(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'anticipation' => 'required|numeric',
                'credit' => 'required|numeric',
                'deal' => 'required|string',
                'debit' => 'required|numeric',
                'elo_credit' => 'required|numeric',
                'elo_debit' => 'required|numeric',
                'elo_parc_2_6' => 'required|numeric',
                'elo_parc_7_12' => 'required|numeric',
                'monthly_rental' => 'required|numeric',
                'parc_2_6' => 'required|numeric',
                'parc_7_12' => 'required|numeric',
                'vendedor' => 'required|string',
            ]);

            $merchantData = $request->merchantData;

            $vendedor = User::where('rd_crm_user_id', $validatedData['vendedor'])->first(['id', 'name', 'email', 'rd_crm_token', 'rd_crm_user_id']);
            \Cache::forget('user_'.$vendedor->id.'_negociacoes');
            $deal = RdHelper::getNegociacao($validatedData['deal'], $vendedor->rd_crm_token);
            $dealProposalFieldId = $deal->proposalField['id'];

            //proposalText:
            /* Seguir o seguinte exemplo: Visa/Master: Débito: 1.40% | Crédito à vista: 2.31% | Crédito parcelado até 6x: 2.61% | Crédito parcelado de 7x a 12x: 3.08%; Elo/Amex: Débito: 1.97% | Crédito à vista: 3.14% | Crédito parcelado até 6x: 3.52% | Crédito parcelado de 7x a 12x: 3.99%; Pix: 0,50%; Antecipação Automática: 1.69%
             * */
            $proposalText = "Visa/Master: Débito: {$validatedData['debit']}% | Crédito à vista: {$validatedData['credit']}% | Crédito parcelado até 6x: {$validatedData['parc_2_6']}% | Crédito parcelado de 7x a 12x: {$validatedData['parc_7_12']}%; Elo/Amex: Débito: {$validatedData['elo_debit']}% | Crédito à vista: {$validatedData['elo_credit']}% | Crédito parcelado até 6x: {$validatedData['elo_parc_2_6']}% | Crédito parcelado de 7x a 12x: {$validatedData['elo_parc_7_12']}%; Pix: 0,50%; Antecipação Automática: {$validatedData['anticipation']}%";
            //$proposalText = '[TESTE GERADO PELA API]:'.$proposalText;
            //$response = true;
            $response = RdHelper::updateNegociacaoCustomField($validatedData['deal'], $dealProposalFieldId, $proposalText, $vendedor->rd_crm_token);
            if ($response) {
                RdHelper::moveDealToNextStage($validatedData['deal'], $vendedor->rd_crm_token);
                RdHelper::createAnnotationToDeal($validatedData['deal'], $vendedor->rd_crm_token, 'Proposta enviada via simulador');
                $this->registerSubmission($vendedor->rd_crm_user_id, $validatedData['deal'], $validatedData, $merchantData);
                return response()->json(['message' => 'Proposta enviada com sucesso']);
            } else {
                throw new Exception('Erro ao enviar proposta');
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

    }

    /**
     * @throws Exception
     */
    public function registerSubmission($vendedorId, $dealId, $proposal, $merchantData)
    {
        //dd($merchantData);
        $productShare = $merchantData['product_share'];

        $proposalElo = [
            'debit' => $proposal['elo_debit'],
            'credit' => $proposal['elo_credit'],
            'parc_2_6' => $proposal['elo_parc_2_6'],
            'parc_7_12' => $proposal['elo_parc_7_12'],
        ];
        $proposalVisaMaster = [
            'debit' => $proposal['debit'],
            'credit' => $proposal['credit'],
            'parc_2_6' => $proposal['parc_2_6'],
            'parc_7_12' => $proposal['parc_7_12'],
        ];

        $simulacao = new Simulacao();
        $simulacao->negociacao_id = $dealId;
        $simulacao->vendedor_id = $vendedorId;
        $simulacao->mcc = $merchantData['mcc'];
        $simulacao->pontos_venda = (int) $merchantData['points_of_sale'];
        $simulacao->maquinas = (int) $merchantData['equipment_quantity'];
        $simulacao->faturamento_mensal = (int) $merchantData['medium_ticket'];
        $simulacao->ticket_medio = (int) $merchantData['medium_ticket'];
        $simulacao->share_debito = (int) $productShare['debit'];
        $simulacao->share_credito = (int) $productShare['credit'];
        $simulacao->share_2_6 = (int) $productShare['parc_2_6'];
        $simulacao->share_7_12 = (int) $productShare['parc_7_12'];
        $simulacao->prop_visa_master = $proposalVisaMaster;
        $simulacao->prop_elo_amex = $proposalElo;
        $simulacao->prop_antecipacao = $proposal['anticipation'];
        $simulacao->prop_aluguel = $proposal['monthly_rental'];
        $simulacao->opt_antecipacao = $merchantData['opt_automatic_anticipation'];
        try {
            $simulacao->save();
        } catch (Exception $e) {
            throw new Exception('Erro ao salvar simulação');
        }
    }

    public function getAcquirerCosts($mcc)
    {
        $merchantService = MerchantService::where('mcc', $mcc)->first();

        if (!$merchantService) {
            //return status 404
            header("HTTP/1.0 404 Not Found");
            echo "MCC não encontrado";
            exit;
        }

        $mediumTaxes = $merchantService->getMediumTaxes();
        $eloTaxes = $merchantService->getEloTaxes();
        $anticipationTax = $this->getAnticipationTax();
        $mediumTaxes['anticipation'] = $anticipationTax;
        $mediumTaxes['elo'] = $eloTaxes;

        return [
            'mcc' => $merchantService->mcc,
            'descricao' => $merchantService->description,
            'custos_adquirente' => $mediumTaxes
        ];

    }

    public function fetchAcquirerCosts($mcc = null)
    {
        if (!$mcc) {
            return response()->json(['error' => 'MCC não informado'], 400);
        }

        if (!is_numeric($mcc)) {
            return response()->json(['error' => 'MCC inválido'], 422);
        }

        $response = $this->getAcquirerCosts($mcc);

        return response()->json($response);
    }

    public function calculateProposalCostDifferences(array $proposal, array $costs) : array | bool
    {
        return [
            'debit' => (float) number_format((float) $proposal['debit'] - $costs['debit'], 2, '.', ''),
            'credit' => (float) number_format((float) $proposal['credit'] - $costs['credito_vista'], 2, '.', ''),
            'parc_2_6' => (float) number_format((float) $proposal['parc_2_6'] - $costs['credito_parc_2_6'], 2, '.', ''),
            'parc_7_12' => (float) number_format((float) $proposal['parc_7_12'] - $costs['credito_parc_7_12'], 2, '.', ''),
            'anticipation' => (float) number_format((float) $proposal['anticipation'] - $costs['anticipation'], 2, '.', ''),
        ];
    }
}

/*
 * TODO: Fazer a interface pra consumir a API
 * TODO: 1. Seletor de MCC, 2. Mostrar tarifas do mcc e mostrar campos para preencher dados da empresa, product share, e proposta, 3. Mostrar resultado
 * */
