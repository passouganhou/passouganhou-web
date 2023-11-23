<?php

namespace App\Services\v2;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CrmService
{
    protected array $configs = [
        'rulerId' => '',
        'serviceId' => ''
    ];

    private string $bearerToken = 'Bearer ZWJ3YmFuay1hcGktY2xpZW50LWtleTo4a2IuITVyNllDamFnUFJYQmRyMlU2LXMuYl9oRUM2WWl6bmUudUZQNUQ=';

    protected string $baseUrl = 'https://codecycleplatformapi.azurewebsites.net/api/crm/ebwbank';

    public function __construct(protected array $data, $rulerId, $serviceId = '')
    {
        if ($rulerId) {
            $this->configs['rulerId'] = $rulerId;
        }

        if ($serviceId) {
            $this->configs['serviceId'] = $serviceId;
        }
    }

    public function setServiceId($serviceId): static
    {
        $this->configs['serviceId'] = $serviceId;

        return $this;
    }

    public function setRulerId($rulerID): static
    {
        $this->configs['rulerId'] = $rulerID;

        return $this;
    }

    public function send()
    {
        $data = array_merge($this->data, $this->configs);
        try {
            if (empty($data['rulerId'])) {
                throw new \Exception('Ruler ID is required', 400);
            }

            if (empty($data['serviceId'])) {
                unset($data['serviceId']);
            }

            $response = Http::post($this->baseUrl . '/target/register', $data, [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Authorization' => $this->bearerToken
            ]);
            return $response;
        } catch (\Exception $e) {
            Log::channel('ebw-crm')->warning($e->getMessage(), ['status' => $e->getCode(), 'id' => $this->data['email']]);
            return;
        }
    }
}
