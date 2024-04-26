<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Simulacao extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'negociacao_id',
        'vendedor_id',
        'mcc',
        'pontos_venda',
        'maquinas',
        'faturamento_mensal',
        'ticket_medio',
        'share_debito',
        'share_credito',
        'share_2_6',
        'share_7_12',
        'prop_visa_master',
        'prop_elo_amex',
        'prop_antecipacao',
        'prop_aluguel',
        'opt_antecipacao',
        'deal_name',
        'deal_organization_name',
        'deal_funnel'
    ];

    protected $casts = [
        'prop_visa_master' => 'array',
        'prop_elo_amex' => 'array',
    ];

    public function segmento()
    {
        return $this->belongsTo(MerchantService::class, 'mcc', 'mcc');
    }

    public function vendedor()
    {
        return $this->belongsTo(User::class, 'vendedor_id', 'rd_crm_user_id');
    }
}
