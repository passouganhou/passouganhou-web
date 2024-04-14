<?php

namespace App\Http\Controllers\Simulador;

use App\Http\Controllers\Controller;
use App\Models\Rd\Deal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use JetBrains\PhpStorm\NoReturn;

class WebController extends Controller
{
    public function poc()
    {
        $teamUsers = $this->fetchVendedores();
        return view('pages.dev.poc', compact('teamUsers'));
    }
    public function simuladorProposta()
    {
        $teamUsers = $this->fetchVendedores();
        dd($teamUsers);
        return view('pages.dev.poc', [
            'teamUsers' => $teamUsers
        ]);
    }

    public function negociacoes()
    {
        $uid = '65f88e4380e9bd00181e4f43';
        $response = $this->fetchNegociacoesFromUser($uid);
        $negociacoesArr = $response['deals'];
        $negociacoes = Deal::hydrate($negociacoesArr);
        $inject = ['negociacoes' => $negociacoes];
        return view('pages.rd.negociacoes', $inject);
    }

    public function login()
    {
        return view('pages.rd.login', ['rd_auth_url' => $this->generateRdAuthUrl()]);
    }

    #[NoReturn] public function callback(Request $request)
    {
        dd($request);
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

    private function fetchNegociacoesFromUser($userId)
    {
        $negociacoesUrl = 'https://crm.rdstation.com/api/v1/deals?token=65ddeda08fd4940014e8085c&user_id='.$userId;
        $negociacoes = Http::get($negociacoesUrl)->json();
        return $negociacoes;
    }

    public function generateRdAuthUrl()
    {
        $rd_client_id = config('rdstation.rd_client_id');
        $rd_client_secret = config('rdstation.rd_client_secret');
        $app_url = getenv('APP_URL');
        $rd_auth_uri = config('rdstation.rd_auth_uri');
        return $rd_auth_uri.'client_id='.$rd_client_id.'&redirect_uri='.$app_url.'/rd/callback&state=';
    }
}
