<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DataWarehouse\Gsurf\Payment;
use App\Repositories\GsurfRepository;
use App\Services\GsurfService;
use App\Services\PaymentService;
use App\Services\TransactionService;
use Exception;

class PaymentController extends Controller
{

    private PaymentService $service;

    public function __construct(PaymentService $service)
    {
        $this->service = $service;
    }
    public function index()
    {
        return $this->jsonRemember('payments', function () {
            return Payment::all();
        }, 720);
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

    public function formatPaymentDateTime(String $dateTime, String $startOrEnd): string
    {
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $dateTime)) {
            throw new Exception('Formato de data inválido');
        }
        return $dateTime . ($startOrEnd == 'start' ? '+00:00:00-03:00' : '+23:59:59-03:00');
    }
}
