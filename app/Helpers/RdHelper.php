<?php

namespace App\Helpers;

use App\Models\Rd\Deal;
use App\Models\User;
use Auth;
use Cache;
use Http;

class RdHelper
{
    private string $baseUrl = 'https://crm.rdstation.com/api/v1/';
    private static array $dealSimulationNextStagesByPipelineId = [
        '65fb65728d8f4b000d6a1730' => '65fb65728d8f4b000d6a1734',
        '65cd4c5148745700149f283b' => '65cd4c5148745700149f283f'
    ];

    /**
     * @return array
     */
    protected static function getDealSimulationNextStagesByPipelineId(string $pipelineId): string
    {
        return self::$dealSimulationNextStagesByPipelineId[$pipelineId];
    }

    public static function getNegociacao($id, $token = null)
    {
        $token = $token ?? session('rd_crm_token');
        $negociacaoUrl = 'https://crm.rdstation.com/api/v1/deals/'.$id.'?token='.$token;
        $negociacao = Http::get($negociacaoUrl)->json();
        return Deal::hydrate([$negociacao])->first();
    }

    public static function fetchNegociacoesByStageId($stageId = null)
    {
        $token = session('rd_crm_token');
        $rdCrmUserId = Auth::user()->rd_crm_user_id;
        $negociacoesUrl = 'https://crm.rdstation.com/api/v1/deals?token='.$token.'&user_id='.$rdCrmUserId;
        if ($stageId) {
            $negociacoesUrl .= '&deal_stage_id='.$stageId;
        }
        $cacheKey = 'negociacoes_'.$rdCrmUserId;
        return Cache::remember($cacheKey, now()->addMinutes(2), function () use ($negociacoesUrl) {
            return Http::get($negociacoesUrl)->json();
        });
    }

    public static function fetchNegociacoesByStageIds(array $stageId)
    {
        $token = session('rd_crm_token');
        $rdCrmUserId = Auth::user()->rd_crm_user_id;
        $negociacoesUrl = 'https://crm.rdstation.com/api/v1/deals?token='.$token.'&user_id='.$rdCrmUserId;
        $responseArr = [];

        foreach ($stageId as $id) {
            $negociacoesUrl .= '&deal_stage_id='.$id;
            $response = Http::get($negociacoesUrl)->json();
            $rawDeals = $response['deals'];
            $responseArr[] = $rawDeals;
        }

        //merge arrays
        $responseArr = array_merge(...$responseArr);
        return ['deals' => $responseArr];
    }

    public static function updateNegociacaoCustomField($dealId, $customFieldId, $value, $token = null) : bool
    {
        $token = $token  ?? session('rd_crm_token');
        $negociacaoUrl = 'https://crm.rdstation.com/api/v1/deals/'.$dealId.'?token='.$token;
        $data = [
            'deal' => [
                'deal_custom_fields' => [
                    [
                        'custom_field_id' => $customFieldId,
                        'value' => $value,
                    ],
                ],
            ],
        ];
        $response = Http::put($negociacaoUrl, $data);
        return $response->status() === 200;
    }

    public static function getCrmUserId($token = null)
    {
        $rdCrmUsers = self::getCrmActiveUsers($token);
        $loggedUserEmail = Auth::user()->email;
        foreach ($rdCrmUsers as $user) {
            if ($user['email'] === $loggedUserEmail) {
                return $user['_id'];
            }
        }
        return null;
    }

    public static function getCrmActiveUsers($token = null)
    {
        if ($token === null) $token = session('rd_crm_token');
        $url = 'https://crm.rdstation.com/api/v1/users?token='.$token.'&active=true';
        $response = Http::get($url);
        return $response->json('users');
    }

    public static function checkCrmToken($token)
    {
        $url = 'https://crm.rdstation.com/api/v1/token/check?token='.$token;
        $response = Http::get($url);
        return $response->json();
    }

    public static function registerRDUserOnSession()
    {
        // $token = Auth::user()->rd_crm_token;
    }

    public static function createAnnotationToDeal(mixed $deal, mixed $rd_crm_token, string $text) : bool
    {
        $user = User::where('rd_crm_token', $rd_crm_token)->first();
        $url = 'https://crm.rdstation.com/api/v1/activities';
        $data = [
            'activity' => [
                'deal_id' => $deal,
                'text' => $text,
                'user_id' => $user->rd_crm_user_id
            ]
        ];
        $response = Http::post($url, $data);
        return $response->status() === 200;
    }

    public static function moveDealToNextStage(mixed $dealId, mixed $rd_crm_token) : bool
    {
        $token = $rd_crm_token;
        $deal = self::getNegociacao($dealId, $token);
        $deal_pipeline_id = $deal->deal_stage->deal_pipeline_id;
        $nextStageId = self::getDealSimulationNextStagesByPipelineId($deal_pipeline_id);

        $negociacaoUrl = 'https://crm.rdstation.com/api/v1/deals/'.$dealId.'?token='.$token;

        $data = [
            'deal' => [
                'deal_stage_id' => $nextStageId
            ],
        ];

        $response = Http::put($negociacaoUrl, $data);
        return $response->status() === 200;
    }
}
