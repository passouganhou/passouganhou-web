<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TransactionService;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{
    private TransactionService $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function debugar()
    {
        return $this->jsonRemember('transactions', function () {
            //começo e final do ano atual
            $startDate = date('Y-01-01');
            $endDate = date('Y-12-31');
            return $this->transactionService->getAllTransactions($startDate, $endDate);
        }, 1200);
    }

    public function debugarAll()
    {
        return $this->jsonRemember('transactions_all', function () {
            $startDate = date('Y-01-01');
            $endDate = date('Y-12-31');
            return $this->transactionService->getAllTransactionsWithAllColumns($startDate, $endDate);
        }, 1200);
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

    public function index()
    {
        $request = request();
        $this->normalizeRequest($request);
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $transactions = $this->transactionService->getAllTransactions($startDate, $endDate);
        return response()->json($transactions);
    }
    public function getAll()
    {
        $request = request();
        $this->validateRequest($request);
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $transactions = $this->transactionService->getAllTransactionsWithAllColumns($startDate, $endDate);
        return response()->json($transactions);
    }

    public function transactionsByCustomer()
    {
        $request = request();
        $this->normalizeRequest($request);
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $transactions = $this->transactionService->getTransactionsGroupedByCustomerId($startDate, $endDate);
        return response()->json($transactions);
    }

    public function getMostValuableCustomers()
    {
        $request = request();
        $this->normalizeRequest($request);
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $transactions = $this->transactionService->getMostValuableCustomers($startDate, $endDate);
        return response()->json($transactions);
    }

    public function getLessValuableCustomers()
    {
        $request = request();
        $this->normalizeRequest($request);
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $transactions = $this->transactionService->getLessValuableCustomers($startDate, $endDate);
        return response()->json($transactions);
    }

    public function getTotalTransactions()
    {
        $request = request();
        $this->normalizeRequest($request);
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $transactions = $this->transactionService->getTotalTransactions($startDate, $endDate);
        return response()->json($transactions);
    }

    public function validateRequest($request)
    {
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
    public function normalizeRequest($request)
    {
        if (!$request->has('start_date')) {
            $request->merge(['start_date' => date('Y-m-01')]);
        }
        if (!$request->has('end_date')) {
            $request->merge(['end_date' => date('Y-m-t')]);
        }
        return $this->validateRequest($request);
    }
}
