<?php

namespace App\Repositories;

use GuzzleHttp\Client;

class GsurfRepository
{
    private Client $client;
    private String $client_id = '519be47c-a7a6-4988-b73e-75d2b3137e22';
    private String $client_secret = 'Kos0kgMl56N5583P6vEd0tJh2NAIuMYC';

    private String $token;

    public function __construct()
    {
        $this->client = new Client();
    }
    public function getToken()
    {
        return \Cache::remember('gsurf_token_debug_1', now()->addMinutes(110), function ()
        {
            $response = $this->client->request('POST', 'https://api.gsurfnet.com/gmac-v1/oauth2/token', [
                'auth' => [$this->client_id, $this->client_secret],
                'form_params' => [
                    'grant_type' => 'client_credentials'
                ]
            ]);
            $body = $response->getBody();
            $content = $body->getContents();
            return json_decode($content)->access_token;
        });
    }

    public function getTransactionsFromGsurf(String $dateTimeStart, String $dateTimeEnd, int $page = 1, $limit = 100)
    {
        /*
         * curl --location 'https://api.gsurfnet.com/transactions-v2/transactions?initial_date=2024-07-16T00%3A00%3A00&final_date=2024-07-16T23%3A59%3A59'
         */
        $apiUrl = 'https://api.gsurfnet.com/transactions-v2/transactions';
        $response = $this->client->request('GET', $apiUrl, [
            'headers' => [ 'Authorization' => 'Bearer ' . $this->getToken() ],
            'query' => [
                'initial_date' => $dateTimeStart,
                'final_date' => $dateTimeEnd,
                'page' => $page,
                'limit' => $limit
            ]
        ]);
        $body = $response->getBody();
        $content = $body->getContents();
        return json_decode($content);
    }

    public function getAllTransactionsFromGsurf(String $dateTimeStart, String $dateTimeEnd): array
    {
        ini_set('max_execution_time', 600);
        $result = [];
        $totalPages = 0;
        $page = 0;
        $limit = 1000;
        do {
            sleep(30);
            $page++;
            $transactions = $this->getTransactionsFromGsurf($dateTimeStart, $dateTimeEnd, $page, $limit);
            $body = $transactions->body;
            $records = $body->records;
            $limit = $body->limit;
            if (!empty($records)){
                $result = array_merge($result, $records);
            }
            $totalPages++;
        } while (count($records) == $limit);
        return $result;
    }

    public function getMerchants()
    {
        $response = \Cache::remember('gsurf_merchants', now()->addMinutes(30), function () {
            $apiUrl = 'https://api.gsurfnet.com/sc3-mtm-v2/merchants';
            $response = $this->client->request('GET', $apiUrl, [
                'headers' => [ 'Authorization' => 'Bearer ' . $this->getToken() ],
                'query' => [
                    'page' => 1,
                    'limit' => 1500
                ]
            ]);
            $body = $response->getBody();
            return $body->getContents();
        });
        return json_decode($response);
    }

}
