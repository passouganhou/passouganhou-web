<?php

namespace App\Services;

use App\Models\DataWarehouse\Gsurf\Transaction;
use DB;
use Exception;

class TransactionService
{
    public function getAllTransactions($startDate, $endDate, $limit = 1000)
    {
        $startDate = $this->formatDateTime($startDate, 'start');
        $endDate = $this->formatDateTime($endDate, 'end');
        return Transaction::where('status_category_description', 'Confirmada')
            ->where('transaction_date', '>=', $startDate)
            ->where('transaction_date', '<=', $endDate)
            ->limit($limit)
            ->get();
    }

    public function getTransactionsGroupedByCustomerId($startDate, $endDate)
    {
        $startDate = $this->formatDateTime($startDate, 'start');
        $endDate = $this->formatDateTime($endDate, 'end');
        /*
         * 'total_customers', 'total_transactions', 'total_amount', 'customers' => [customer_id => ['total_amount', 'transaction_count', 'most_recent_transaction_date', 'most_recent_transaction_amount']]
         * */
        $transactions = Transaction::select('customer_id', DB::raw('SUM(amount) as total_amount'), DB::raw('COUNT(*) as transaction_count'), DB::raw('MAX(transaction_date) as most_recent_transaction_date'), DB::raw('MAX(amount) as most_recent_transaction_amount'))
            ->where('status_category_description', 'Confirmada')
            ->where('transaction_date', '>=', $startDate)
            ->where('transaction_date', '<=', $endDate)
            ->whereNotNull('customer_id')
            ->groupBy('customer_id')
            ->orderBy('total_amount', 'desc')
            ->get();

        $totalCustomers = $transactions->count();
        $totalTransactions = $transactions->sum('transaction_count');
        $totalAmount = $transactions->sum('total_amount');
        $customers = $transactions->mapWithKeys(function ($item) {
            return [$item->customer_id => [
                'total_amount' => $item->total_amount,
                'transaction_count' => $item->transaction_count,
                'most_recent_transaction_date' => $item->most_recent_transaction_date,
                'most_recent_transaction_amount' => $item->most_recent_transaction_amount
            ]];
        });

        return collect([
            'total_customers' => $totalCustomers,
            'total_transactions' => $totalTransactions,
            'total_amount' => $totalAmount,
            'data' => $customers
        ]);
    }

    public function getMostValuableCustomers($startDate, $endDate): \Illuminate\Support\Collection
    {
        $startDate = $this->formatDateTime($startDate, 'start');
        $endDate = $this->formatDateTime($endDate, 'end');
        $customers = DB::table('gsurf_transactions')
            ->select('customer_id', DB::raw('SUM(amount) as total_amount'), DB::raw('COUNT(*) as transaction_count'))
            ->where('status_category_description', 'Confirmada')
            ->where('transaction_date', '>=', $startDate)
            ->where('transaction_date', '<=', $endDate)
            ->whereNotNull('customer_id')
            ->groupBy('customer_id')
            ->orderBy('total_amount', 'desc')
            ->limit(100)
            ->get();

        return $customers;

    }

    public function getLessValuableCustomers($startDate, $endDate): \Illuminate\Support\Collection
    {
        $startDate = $this->formatDateTime($startDate, 'start');
        $endDate = $this->formatDateTime($endDate, 'end');
        $customers = DB::table('gsurf_transactions')
            ->select('customer_id', DB::raw('SUM(amount) as total_amount'), DB::raw('COUNT(*) as transaction_count'))
            ->where('status_category_description', 'Confirmada')
            ->where('transaction_date', '>=', $startDate)
            ->where('transaction_date', '<=', $endDate)
            ->whereNotNull('customer_id')
            ->groupBy('customer_id')
            ->orderBy('total_amount', 'asc')
            ->limit(100)
            ->get();

        return $customers;
    }

    public function getTotalTransactions($startDate, $endDate)
    {
        $startDate = $this->formatDateTime($startDate, 'start');
        $endDate = $this->formatDateTime($endDate, 'end');
        $result = DB::table('gsurf_transactions')
            ->select(DB::raw('COUNT(*) as total_transactions'), DB::raw('SUM(amount) as total_amount'))
            ->where('status_category_description', 'Confirmada')
            ->where('transaction_date', '>=', $startDate)
            ->where('transaction_date', '<=', $endDate)
            ->first();

        return $result;
    }

    public function formatDateTime(String $dateTime, String $startOrEnd): string
    {
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $dateTime)) {
            throw new Exception('Formato de data inválido');
        }
        return $dateTime . ($startOrEnd == 'start' ? 'T00:00:00' : 'T23:59:59');
    }
}
