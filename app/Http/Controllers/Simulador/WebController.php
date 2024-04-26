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

    public function seedUsers()
    {
        $json = '{
    "users": [
        {
            "id": "66143ae79d4f0b00181b0ea3",
            "_id": "66143ae79d4f0b00181b0ea3",
            "name": "Andriele",
            "email": "andrielecavalcanti@ebwbank.com.br",
            "created_at": "2024-04-08T15:43:51.061-03:00",
            "updated_at": "2024-04-08T15:48:30.316-03:00",
            "last_login": "2024-04-08T15:47:25.467-03:00",
            "active": true,
            "hidden": false
        },
        {
            "id": "65f88e4380e9bd00181e4f43",
            "_id": "65f88e4380e9bd00181e4f43",
            "name": "Camila ",
            "email": "camilaoliveira@ebwbank.com.br",
            "created_at": "2024-03-18T15:56:03.348-03:00",
            "updated_at": "2024-04-23T16:54:33.413-03:00",
            "last_login": "2024-04-25T08:54:16.557-03:00",
            "active": true,
            "hidden": false
        },
        {
            "id": "66143651b72620001d61fc9d",
            "_id": "66143651b72620001d61fc9d",
            "name": "Cristiana Farias",
            "email": "cristianafarias@ebwbank.com.br",
            "created_at": "2024-04-08T15:24:17.464-03:00",
            "updated_at": "2024-04-09T18:21:35.955-03:00",
            "last_login": "2024-04-09T16:36:24.822-03:00",
            "active": true,
            "hidden": false
        },
        {
            "id": "65df4a23e8a761001af5809d",
            "_id": "65df4a23e8a761001af5809d",
            "name": "Fabiana",
            "email": "fabianateste@ebwbank.com.br",
            "created_at": "2024-02-28T11:58:43.665-03:00",
            "updated_at": "2024-02-29T13:40:17.803-03:00",
            "last_login": "2024-04-17T09:52:59.902-03:00",
            "active": true,
            "hidden": false
        },
        {
            "id": "65dddf5eca9a9e00112c0416",
            "_id": "65dddf5eca9a9e00112c0416",
            "name": "Henrique",
            "email": "henriquesilva@ebwbank.com.br",
            "created_at": "2024-02-27T10:10:54.565-03:00",
            "updated_at": "2024-02-29T02:01:08.404-03:00",
            "last_login": "2024-04-08T18:04:36.797-03:00",
            "active": true,
            "hidden": false
        },
        {
            "id": "6614363ba553130020c4672d",
            "_id": "6614363ba553130020c4672d",
            "name": "Ian carlos",
            "email": "iancarlos@ebwbank.com.br",
            "created_at": "2024-04-08T15:23:55.097-03:00",
            "updated_at": "2024-04-08T15:48:20.965-03:00",
            "last_login": "2024-04-25T17:46:20.566-03:00",
            "active": true,
            "hidden": false
        },
        {
            "id": "660d37f0f42dac0014b00e50",
            "_id": "660d37f0f42dac0014b00e50",
            "name": "Igor Gouveia",
            "email": "igorgouveia@ebwbank.com.br",
            "created_at": "2024-04-03T08:05:20.976-03:00",
            "updated_at": "2024-04-08T15:48:24.575-03:00",
            "last_login": "2024-04-03T08:13:44.805-03:00",
            "active": true,
            "hidden": false
        },
        {
            "id": "65cd4c2c8961dd001492264e",
            "_id": "65cd4c2c8961dd001492264e",
            "name": "Jennifer",
            "email": "jenniferqueiroz@ebwbank.com.br",
            "created_at": "2024-02-14T20:26:36.949-03:00",
            "updated_at": "2024-04-23T17:00:06.738-03:00",
            "last_login": "2024-04-23T09:10:06.492-03:00",
            "active": true,
            "hidden": false
        },
        {
            "id": "661d8f9cb304ba0016bee35d",
            "_id": "661d8f9cb304ba0016bee35d",
            "name": "LUCIENE CORDEIRO DA SILVA",
            "email": "lucienecordeiro@ebwbank.com.br",
            "created_at": "2024-04-15T17:35:40.264-03:00",
            "updated_at": "2024-04-17T16:28:15.273-03:00",
            "last_login": "2024-04-16T11:23:21.474-03:00",
            "active": true,
            "hidden": false
        },
        {
            "id": "661d72dbda7e3900172b9b6b",
            "_id": "661d72dbda7e3900172b9b6b",
            "name": "Leobueri",
            "email": "leandersonbueri@ebwbank.com.br",
            "created_at": "2024-04-15T15:32:59.356-03:00",
            "updated_at": "2024-04-15T15:32:59.356-03:00",
            "last_login": null,
            "active": true,
            "hidden": false
        },
        {
            "id": "65ddeda08fd4940014e8085a",
            "_id": "65ddeda08fd4940014e8085a",
            "name": "Lucas Mendes",
            "email": "lucasmendes@ebwbank.com.br",
            "created_at": "2024-02-27T11:11:44.456-03:00",
            "updated_at": "2024-03-18T19:28:55.642-03:00",
            "last_login": "2024-03-18T17:38:49.626-03:00",
            "active": true,
            "hidden": false
        },
        {
            "id": "65dddf8791bfef0018bd3ac5",
            "_id": "65dddf8791bfef0018bd3ac5",
            "name": "Lucas Oliani",
            "email": "lucaspinheiro@ebwbank.com.br",
            "created_at": "2024-02-27T10:11:35.365-03:00",
            "updated_at": "2024-04-24T14:48:45.597-03:00",
            "last_login": "2024-04-24T08:23:47.551-03:00",
            "active": true,
            "hidden": false
        },
        {
            "id": "661f0f3ebccef2000e02e8da",
            "_id": "661f0f3ebccef2000e02e8da",
            "name": "Maiara teste ",
            "email": "jennifermaiaraqueiroz@gmail.com",
            "created_at": "2024-04-16T20:52:30.071-03:00",
            "updated_at": "2024-04-16T20:52:53.273-03:00",
            "last_login": "2024-04-22T16:35:21.747-03:00",
            "active": true,
            "hidden": false
        },
        {
            "id": "66016eed719fc20014949c67",
            "_id": "66016eed719fc20014949c67",
            "name": "Marcelo  Bezerra",
            "email": "marcelosouza@ebwbank.com.br",
            "created_at": "2024-03-25T09:32:45.837-03:00",
            "updated_at": "2024-04-09T16:21:59.616-03:00",
            "last_login": "2024-04-10T08:12:14.009-03:00",
            "active": true,
            "hidden": false
        },
        {
            "id": "66105c689dcd85001b606f82",
            "_id": "66105c689dcd85001b606f82",
            "name": "Talmai Zanini Junior",
            "email": "talmai@ebwbank.com.br",
            "created_at": "2024-04-05T17:17:44.883-03:00",
            "updated_at": "2024-04-08T15:00:51.717-03:00",
            "last_login": "2024-04-05T17:19:47.002-03:00",
            "active": true,
            "hidden": false
        }
    ]
}';

        $parsed = json_decode($json, true);
        $users = [];
        foreach ($parsed['users'] as $user) {
            $users[] = [
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => $user['email']
            ];
        }

        foreach ($users as $user){
            $user = User::where('email', $user['email'])->first();
            if($user){
                $user->password = Hash::make($user['email']);
                $user->save();
                continue;
            }
            $user = new User();
            $user->name = $user['name'];
            $user->email = $user['email'];
            $user->password = Hash::make($user['email']);
            $user->save();
        }
        return 'done';
    }
}
