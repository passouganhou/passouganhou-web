<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Services\GsurfService;

class GsurfController extends Controller
{

    public function __construct(GsurfService $gsurfService)
    {
        $this->gsurfService = $gsurfService;
    }
    public function importar()
    {
        $request = request();
        $this->validateRequest($request);
        $dateStart = $request->get('start_date');
        $dateEnd = $request->get('end_date');
        $response = $this->gsurfService->importTransactions($dateStart, $dateEnd);
        return response()->json($response);
    }

    public function syncPendingTransactions()
    {
        return $this->gsurfService->updatePendingTransactionsAndPayments();
    }

    public function getValuesAndQuantityByDay()
    {
        $response = $this->gsurfService->getValuesAndQuantityByDay();
        return response()->json($response);
    }
    public function getMerchants()
    {
        $response = $this->gsurfService->getMerchants();
        return response()->json($response);
    }

    public function getTerminals()
    {
        $response = $this->jsonRemember('terminals_all', function () {
            return $this->gsurfService->getAllTerminalsFromGsurf();
        }, 1200);
        return response()->json($response);
    }

    private function jsonRemember(String $key, $callback, $expirationMinutes = 60)
    {
        $directory = storage_path('app/json');
        $path = $directory . '/' . $key . '.json';

        // Verifica se o diretório existe, se não, cria o diretório
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }

        if (file_exists($path)) {
            $content = file_get_contents($path);
            $data = json_decode($content, true);
            if (isset($data['timestamp']) && (time() - $data['timestamp']) < ($expirationMinutes * 60)) {
                return $data['value'];
            }
        }
        $value = $callback();
        $data = [
            'timestamp' => time(),
            'value' => $value
        ];
        file_put_contents($path, json_encode($data));
        return $value;
    }

    public function validateRequest($request)
    {
        if (!$request->has('start_date')) {
            $request->merge(['start_date' => date('Y-m-d')]);
        }
        if (!$request->has('end_date')) {
            $request->merge(['end_date' => date('Y-m-d')]);
        }
        $rules = [
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ];
        try {
            $request->validate($rules);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        return true;
    }
}
