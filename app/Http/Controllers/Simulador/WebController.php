<?php

namespace App\Http\Controllers\Simulador;

use App\Helpers\RdHelper;
use App\Http\Controllers\Controller;
use App\Models\Rd\Deal;
use App\Models\Simulacao;
use App\Models\User;
use Auth;
use Cache;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use JetBrains\PhpStorm\NoReturn;

class WebController extends Controller
{

    private RdHelper $rdHelper;

    public function __construct()
    {
        $this->rdHelper = new RdHelper();
    }

    public function poc()
    {
        $teamUsers = $this->fetchVendedores();
        return view('pages.dev.poc', compact('teamUsers'));
    }
    public function simuladorProposta()
    {
        return view('pages.rd.simulador');
    }

    public function negociacoes()
    {
        $oportunidade = '65e0ae2ed6fbfc0020b02cba';
        $negociacoes =  Cache::remember('user_'.Auth::id().'_negociacoes', now()->addMinute(), function () {
            $simulacao = ['65cd4c5148745700149f283e', '6627a17a828b91000f5ec954'];
            $response = $this->rdHelper->fetchNegociacoesByStageIds($simulacao);
            $negociacoesArr = $response['deals'];
            return Deal::hydrate($negociacoesArr);
        });

        //dd($negociacoes);
        $inject = ['negociacoes' => $negociacoes];
        return view('pages.rd.negociacoes', $inject);
    }

    public function proposta($id)
    {
        $deal = $this->rdHelper->getNegociacao($id);
        /*
         *
         * todo: vende no pix?
         * todo: condição comercial
         * todo: simulação de proposta
         * todo: faixa de faturamento
         *
         */
        return view('pages.rd.simulador', ['deal' => $deal]);
    }

    public function simulationHistory()
    {
        $simulations = Simulacao::all()->load(['vendedor', 'segmento']);
        return view('pages.rd.history', ['simulations' => $simulations]);
    }

    public function login()
    {;
        return view('pages.rd.login');
    }

    public function checkToken(Request $request)
    {
        $user = Auth::user();
        $rd_crm_token = $request->input_rd_crm_token;
        $tokenData = $this->rdHelper->checkCrmToken($rd_crm_token);
        if (is_array($tokenData) && array_key_exists('email', $tokenData) && $tokenData['email'] === $user->email) {
            $user->rd_crm_token = $rd_crm_token;
            $rd_crm_user_id = $this->rdHelper->getCrmUserId($rd_crm_token);
            if (empty($rd_crm_user_id)) {
                return back()->withErrors([
                    'input_rd_crm_token' => 'Token inválido'
                ]);
            }
            $user->rd_crm_user_id = $rd_crm_user_id;
            $user->save();
            $request->session()->put('rd_crm_token', $rd_crm_token);
            return redirect()->route('dashboard')->with('success', 'Token salvo com sucesso');
        } else {
            return back()->withErrors([
                'input_rd_crm_token' => 'Token inválido'
            ]);
        }
    }

    #[NoReturn] public function callback(Request $request)
    {
        echo 'Este serviço foi descontinuado. Code:'.' '.$request->code??'';
    }

    //vai pro repositorio

    private function fetchVendedores()
    {
        return \Cache::remember('rd-vendedores', now()->addMinutes(30), function () {
            return $this->fetchVendedoresFromApi();
        });
    }

    private function fetchVendedoresFromApi()
    {
        $rdTeamsUrl = 'https://crm.rdstation.com/api/v1/teams?token=65ddeda08fd4940014e8085c';
        $rdTeams = Http::get($rdTeamsUrl)->json();
        $teamUsers = [];
        $teamsToPick = [
            '65e00ef11a93400014bf1144', '65e0b2a195b5f6000d6cb143', '65f722a9d3165a000d55413d'
        ];
        //users em $rdTeams.teams.team_users.name
        foreach ($rdTeams['teams'] as $team) {
            if (in_array($team['id'], $teamsToPick)) {
                foreach ($team['team_users'] as $user) {
                    $teamUsers[] = ['name' => $user['name'], 'id' => $user['id']];
                }
            }
        }
        //make team users unique by id
        return collect($teamUsers)->unique('id')->values()->all();
    }

    public function rdDebug()
    {
        $loggedUser = Auth::user();
        $vendedores = $this->fetchVendedores();
        $users = User::all();
        //echo in json
        $all = [
            'loggedUser' => $loggedUser,
            'vendedores' => $vendedores,
            'users' => $users
        ];

        return response()->json($all);
    }
}
