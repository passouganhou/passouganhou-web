<?php

namespace App\Repositories;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Enumerable;

class GsurfRepository
{
    private Client $client;
    private String $client_id = '519be47c-a7a6-4988-b73e-75d2b3137e22';
    private String $client_secret = 'Kos0kgMl56N5583P6vEd0tJh2NAIuMYC';

    private Enumerable $frequencies;

    private String $token;

    public function __construct()
    {
        $this->client = new Client();
        $this->frequencies = collect([
            'DAILY' => 2,
            'MONTHLY' => 3
        ]);
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
    public function getAllTerminalsFromGsurf()
    {
        $result = [];
        $totalPages = 0;
        $page = 0;
        $limit = 1500;
        do {
            sleep(60);
            $page++;
            $terminals = $this->getTerminalsFromGsurf($page, $limit);
            //dd($terminals, $terminals->terminals, $terminals->pages, $terminals->limit, $terminals->total, $terminals->currentPage);
            $records = $terminals->terminals;
            $limit = $terminals->limit;
            if (!empty($records)){
                $result = array_merge($result, $records);
            }
            $total = $terminals->total;
            $totalPages++;
        } while ($totalPages < $terminals->pages);
        return $result;
    }

    public function getTerminalsFromGsurf($page = 1, $limit = 300)
    {
        $apiUrl = 'https://api.gsurfnet.com/sc3-mtm-v2/terminals';
        $response = $this->client->request('GET', $apiUrl, [
            'headers' => [ 'Authorization' => 'Bearer ' . $this->getToken() ],
            'query' => [
                'page' => $page,
                'limit' => $limit
            ]
        ]);
        $body = $response->getBody();
        $content = $body->getContents();
        return json_decode($content);
    }

    public function getTransactionsFromGsurf(String $dateTimeStart, String $dateTimeEnd, int $page = 1, $limit = 100)
    {
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

    public function getPaymentsFromGsurf(String $dateTimeStart, String $dateTimeEnd, int $page = 1, $limit = 1000)
    {
        $apiUrl = 'https://api.gsurfnet.com/transactions-v2/payments?initial_date=' . $dateTimeStart . '&final_date=' . $dateTimeEnd . '&status_id=2&limit=' . $limit . '&page=' . $page . '&return_count=1&response_utc_offset=-03:00';
        $response = $this->client->request('GET', $apiUrl, [
            'headers' => [ 'Authorization' => 'Bearer ' . $this->getToken() ]
        ]);
        $body = $response->getBody();
        $content = $body->getContents();
        return json_decode($content);
    }

    public function getAllPaymentsFromGsurf(String $dateTimeStart, String $dateTimeEnd, $limit = 1000)
    {
        ini_set('max_execution_time', 600);
        $result = [];
        $totalPages = 0;
        $page = 0;
        do {
            sleep(10);
            $page++;
            $payments = $this->getPaymentsFromGsurf($dateTimeStart, $dateTimeEnd, $page, $limit);
            $body = $payments->body;
            $records = $body->records;
            $limit = $body->limit;
            if (!empty($records)){
                $result = array_merge($result, $records);
            }
            $totalPages++;
        } while (count($records) == $limit);
        return $result;
    }

    public function getAllTransactionsFromGsurf(String $dateTimeStart, String $dateTimeEnd, $limit = 1000): array
    {
        ini_set('max_execution_time', 600);
        $result = [];
        $totalPages = 0;
        $page = 0;
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

    public function getAllTransactionsFromGsurfV2(string $dateTimeStart, string $dateTimeEnd, $limit = 1000): array
    {
        ini_set('max_execution_time', 600);
        $result = [];
        $page = 0;

        do {
            try {
                $page++;
                $transactions = $this->getTransactionsFromGsurf($dateTimeStart, $dateTimeEnd, $page, $limit);

                if ($transactions->statusCode !== 200) {
                    // Log the error or handle it accordingly
                    throw new Exception('Failed to fetch transactions: ' . $transactions->status);
                }

                $body = $transactions->body;
                $records = $body->records ?? [];
                $limit = $body->limit ?? 0;

                if (!empty($records)){
                    $result = array_merge($result, $records);
                }

                if (count($records) < $limit) {
                    break; // Exit the loop if fewer records are returned than the limit
                }

                sleep(54); // Optional: you may reduce the sleep time or implement exponential backoff

            } catch (Exception $e) {
                // Handle exceptions: log, retry, or break loop
                break;
            }

        } while (true);

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

    public function getTransactionsValuesAndQuantityByDay()
    {

    }

    public function getTransactionsValuesByDay()
    {
        $dataWarehouseId = 2;
        $frequencyId = $this->frequencies->get('DAILY');
        return $this->getWarehouseFacts($frequencyId, $dataWarehouseId);
    }

    public function getTransactionsQuantityByDay()
    {
        $dataWarehouseId = 1;
        $frequencyId = $this->frequencies->get('DAILY');
        return $this->getWarehouseFacts($frequencyId, $dataWarehouseId);
    }

    public function getWarehouseFacts($frequencyId, $dataWarehouseId)
    {
        $apiUrl = 'https://api.gsurfnet.com/transactions-v2/transactions/dw/' . $dataWarehouseId;
        $response = $this->client->request('GET', $apiUrl, [
            'headers' => [ 'Authorization' => 'Bearer ' . $this->getToken() ],
            'query' => [
                'initial_date' => '2024-01-01',
                'final_date' => '2024-12-31',
                'frequency_id' => $frequencyId,
                'dimension_3' => 9
            ]
        ]);
        $body = $response->getBody();
        $content = $body->getContents();
        return json_decode($content);
    }

}
