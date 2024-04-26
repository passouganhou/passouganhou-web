<?php

namespace App\Http\Controllers;

use App\Http\Resources\SimulacaoResource;
use App\Models\Simulacao;
use Illuminate\Http\Request;

class SimulacaoController extends Controller
{
    public function index()
    {
        return SimulacaoResource::collection(Simulacao::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'negociacao_id' => ['nullable'],
            'vendedor_id' => ['nullable'],
            'mcc' => ['required', 'integer'],
            'pontos_venda' => ['required', 'integer'],
            'maquinas' => ['required', 'integer'],
            'faturamento_mensal' => ['required', 'integer'],
            'ticket_medio' => ['required', 'integer'],
            'share_debito' => ['required', 'integer'],
            'share_credito' => ['required', 'integer'],
            'share_2_6' => ['required', 'integer'],
            'share_7_12' => ['required', 'integer'],
            'prop_visa_master' => ['required'],
            'prop_elo_amex' => ['required'],
            'prop_antecipacao' => ['required', 'numeric'],
            'prop_aluguel' => ['required', 'numeric'],
            'opt_antecipacao' => ['nullable', 'boolean'],
        ]);

        return new SimulacaoResource(Simulacao::create($data));
    }

    public function show(Simulacao $simulacao)
    {
        return new SimulacaoResource($simulacao);
    }

    public function update(Request $request, Simulacao $simulacao)
    {
        $data = $request->validate([
            'negociacao_id' => ['nullable'],
            'vendedor_id' => ['nullable'],
            'mcc' => ['required', 'integer'],
            'pontos_venda' => ['required', 'integer'],
            'maquinas' => ['required', 'integer'],
            'faturamento_mensal' => ['required', 'integer'],
            'ticket_medio' => ['required', 'integer'],
            'share_debito' => ['required', 'integer'],
            'share_credito' => ['required', 'integer'],
            'share_2_6' => ['required', 'integer'],
            'share_7_12' => ['required', 'integer'],
            'prop_visa_master' => ['required'],
            'prop_elo_amex' => ['required'],
            'prop_antecipacao' => ['required', 'numeric'],
            'prop_aluguel' => ['required', 'numeric'],
            'opt_antecipacao' => ['nullable', 'boolean'],
        ]);

        $simulacao->update($data);

        return new SimulacaoResource($simulacao);
    }

    public function destroy(Simulacao $simulacao)
    {
        $simulacao->delete();

        return response()->json();
    }
}
