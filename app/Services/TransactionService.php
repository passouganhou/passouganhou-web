<?php

namespace App\Services;

use App\Models\DataWarehouse\Gsurf\Transaction;
use Carbon\Carbon;
use DB;
use Exception;

class TransactionService
{
    public function getAllTransactionsSlim(){
        return Transaction::select(
            'uuid',
            'nsu_sitef',
            'merchant_code_sitef',
            'merchant_code_subacquirer',
            'response_code',
            'installments_number',
            'channel',
            'nsu_host',
            'entry_mode',
            'logic_number',
            'type',
            'transaction_date',
            'reconciliation_status',
            'export_date',
            'original_authorization_code',
            'original_installments_number',
            'order_id',
            'reconciliation_nsu',
            'reconciliation_date',
            'original_transaction_usn',
            'status_id',
            'status_description',
            'original_status_id',
            'original_status_description',
            'transaction_type_id',
            'transaction_type_description',
            'card_brand_id',
            'card_brand_description',
            'acquirer_id',
            'acquirer_description',
            'category_id',
            'category_description',
            'status_category_id',
            'status_category_description',
            'sale_type_id',
            'sale_type_description',
            'response_code_detailing_category',
            'response_code_detailing_reason',
            'response_code_detailing_note',
            'antifraud_data_code',
            'antifraud_data_reviewer_comments',
            'antifraud_data_category',
            'antifraud_data_reason',
            'antifraud_data_note',
        )
            ->whereIn('status_id', [8,9])
            ->get();
    }
    public function getAllTransactionsWithAllColumns($startDate, $endDate, $limit = 1000)
    {
        $startDate = $this->formatDateTime($startDate, 'start');
        $endDate = $this->formatDateTime($endDate, 'end');
        return Transaction::whereDate('date', '>=', $startDate)
            ->whereDate('date', '<=', $endDate)
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
            ->whereIn('status_id', [8,9])
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
            ->whereIn('status_id', [8,9])
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
            ->whereIn('status_id', [8,9])
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
            ->whereIn('status_id', [8,9])
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
