<?php

namespace App\Services;

use App\Models\DataWarehouse\Gsurf\Payment;
use Carbon\Carbon;
use DB;
use Exception;

class PaymentService
{
    public function getTotalPayments($startDate, $endDate)
    {
        $startDate = $this->formatDateTime($startDate, 'start');
        $endDate = $this->formatDateTime($endDate, 'end');
        $result = DB::table('gsurf_payments')
            ->select(DB::raw('COUNT(*) as total_payments'), DB::raw('SUM(amount) as total_amount'))
            //->where('transaction_date', '>=', $startDate)
            //->where('transaction_date', '<=', $endDate)
            ->first();

        return $result;
    }

    public function formatPaymentDateTime(String $dateTime, String $startOrEnd): string
    {
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $dateTime)) {
            throw new Exception('Formato de data inválido');
        }
        return $dateTime . ($startOrEnd == 'start' ? '+00:00:00-03:00' : '+23:59:59-03:00');
    }
}
