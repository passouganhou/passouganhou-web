<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CrmService
{
    protected $configs = [
        'serviceId' => '',
        'rulerId' => '326DDC56-C915-48CB-A0B0-7D823CBE3131'
    ];

    public function __construct(protected array $data, $serviceId = '')
    {
        if ($serviceId) {
            $this->configs['serviceId'] = $serviceId;
        }
    }

    public function serviceId($serviceId)
    {
        $this->configs['serviceId'] = $serviceId;

        return $this;
    }

    public function send()
    {
        $data = array_merge($this->data, $this->configs);

        $response = Http::ebw_crm()->post('/target/register', $data);

        if ($response->successful()) {
            return;
        }

        if ($response->failed()) {
            Log::channel('ebw-crm')->warning($response->body(), ['status' => $response->status(), 'id' => $this->data['email']]);
            return;
        }
    }
}
