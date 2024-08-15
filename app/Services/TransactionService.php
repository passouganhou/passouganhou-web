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
            //exclude columns from select
            ->select('id', 'transaction_date', 'amount', 'status_category_description', 'category_description', 'customer_id')
            ->get();
    }

    public function getTransactionsGroupedByCustomerId($startDate, $endDate, $limit = 1000)
    {
        $startDate = $this->formatDateTime($startDate, 'start');
        $endDate = $this->formatDateTime($endDate, 'end');
        return Transaction::select(
            'customer_id',
            DB::raw('SUM(amount) as total_amount'),
            DB::raw('COUNT(*) as transaction_count'),
            DB::raw('MAX(transaction_date) as last_transaction_date'),
            DB::raw('NOW() as query_date'),
            DB::raw('CASE WHEN MAX(transaction_date) < NOW() - INTERVAL 15 DAY THEN 1 ELSE 0 END as more_than_15_days'),
            DB::raw('SUM(CASE WHEN transaction_type_id = 14 THEN amount ELSE 0 END) as debit_share_amount'),
            DB::raw('SUM(CASE WHEN transaction_type_id = 9 THEN amount ELSE 0 END) as credit_vista_share_amount'),
            DB::raw('SUM(CASE WHEN transaction_type_id = 13 AND installments_number > 1 AND installments_number < 7 THEN amount ELSE 0 END) as credit_2_6_share_amount'),
            DB::raw('SUM(CASE WHEN transaction_type_id = 13 AND installments_number > 6 AND installments_number <= 12 THEN amount ELSE 0 END) as credit_7_12_share_amount')
        )
            ->where('status_category_description', 'Confirmada')
            ->whereNotNull('customer_id')
            ->groupBy('customer_id')
            ->orderBy('total_amount', 'desc')
            ->get();
    }

    public function getMostValuableCustomers($startDate, $endDate): \Illuminate\Support\Collection
    {
        $startDate = $this->formatDateTime($startDate, 'start');
        $endDate = $this->formatDateTime($endDate, 'end');
        $customers = DB::table('gsurf_transactions')
            ->select('customer_id', DB::raw('SUM(amount) as total_amount'), DB::raw('COUNT(*) as transaction_count'))
            ->where('status_category_description', 'Confirmada')
            //->where('transaction_date', '>=', $startDate)
            //->where('transaction_date', '<=', $endDate)
            ->whereNotNull('customer_id')
            ->groupBy('customer_id')
            ->orderBy('total_amount', 'desc')
            //->limit(100)
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
            //->where('transaction_date', '>=', $startDate)
            //->where('transaction_date', '<=', $endDate)
            ->whereNotNull('customer_id')
            ->groupBy('customer_id')
            ->orderBy('total_amount', 'asc')
            //->limit(100)
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
            //->where('transaction_date', '>=', $startDate)
            //->where('transaction_date', '<=', $endDate)
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
