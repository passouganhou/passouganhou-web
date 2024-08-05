<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TransactionService;

class TransactionController extends Controller
{
    private TransactionService $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function index()
    {
        $request = request();
        $this->validateRequest($request);
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $transactions = $this->transactionService->getAllTransactions($startDate, $endDate);
        return response()->json($transactions);
    }

    public function transactionsByCustomer()
    {
        $request = request();
        $this->validateRequest($request);
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $transactions = $this->transactionService->getTransactionsGroupedByCustomerId($startDate, $endDate);
        return response()->json($transactions);
    }

    public function getMostValuableCustomers()
    {
        $request = request();
        $this->validateRequest($request);
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $transactions = $this->transactionService->getMostValuableCustomers($startDate, $endDate);
        return response()->json($transactions);
    }

    public function getLessValuableCustomers()
    {
        $request = request();
        $this->validateRequest($request);
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $transactions = $this->transactionService->getLessValuableCustomers($startDate, $endDate);
        return response()->json($transactions);
    }

    public function getTotalTransactions()
    {
        $request = request();
        $this->validateRequest($request);
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $transactions = $this->transactionService->getTotalTransactions($startDate, $endDate);
        return response()->json($transactions);
    }

    public function validateRequest($request)
    {
        if (!$request->has('start_date')) {
            $request->merge(['start_date' => '2024-05-01']);
            //$request->merge(['start_date' => date('Y-m-d')]);
        }
        if (!$request->has('end_date')) {
            $request->merge(['end_date' => '2024-05-02']);
            //$request->merge(['end_date' => date('Y-m-d')]);
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
    }
}
