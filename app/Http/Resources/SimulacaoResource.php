<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Simulacao */
class SimulacaoResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'id' => $this->id,
            'negociacao_id' => $this->negociacao_id,
            'vendedor_id' => $this->vendedor_id,
            'mcc' => $this->mcc,
            'pontos_venda' => $this->pontos_venda,
            'maquinas' => $this->maquinas,
            'faturamento_mensal' => $this->faturamento_mensal,
            'ticket_medio' => $this->ticket_medio,
            'share_debito' => $this->share_debito,
            'share_credito' => $this->share_credito,
            'share_2_6' => $this->share_2_6,
            'share_7_12' => $this->share_7_12,
            'prop_visa_master' => $this->prop_visa_master,
            'prop_elo_amex' => $this->prop_elo_amex,
            'prop_antecipacao' => $this->prop_antecipacao,
            'prop_aluguel' => $this->prop_aluguel,
            'opt_antecipacao' => $this->opt_antecipacao,
        ];
    }
}
