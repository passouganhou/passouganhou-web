<?php

namespace App\Http\Controllers\Simulador;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class WebController extends Controller
{
    public function poc()
    {
        $teamUsers = $this->fetchVendedores();
        return view('pages.dev.poc', compact('teamUsers'));
    }

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
}
