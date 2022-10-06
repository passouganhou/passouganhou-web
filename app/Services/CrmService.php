<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CrmService
{
    protected $configs = [
        'serviceId' => '',
        'landingPageId' => ''
    ];

    public function __construct(protected array $data, $serviceId = '', $landingPageId = '')
    {
        if ($serviceId) {
            $this->configs['serviceId'] = $serviceId;
        }
        if ($landingPageId) {
            $this->configs['landingPageId'] = $landingPageId;
        }
    }

    public function serviceId($serviceId)
    {
        $this->configs['serviceId'] = $serviceId;

        return $this;
    }

    public function landingPageId($landingPageId)
    {
        $this->configs['landingPageId'] = $landingPageId;

        return $this;
    }

    public function send()
    {
        $data = array_merge($this->data, $this->configs);

        dd($data);

        $response = Http::ebw_crm()->post('/target/register', $data);

        if ($response->successful()) {
            return;
        }

        if ($response->failed()) {
            Log::channel('ebw-crm')->warning($response->body(), ['status' => $response->status(), 'form' => $this->data['form'], 'id' => $this->data['email']]);
            return;
        }
    }
}
