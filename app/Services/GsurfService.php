<?php

namespace App\Services;

use App\Models\DataWarehouse\Gsurf\Payment;
use App\Models\DataWarehouse\Gsurf\Transaction;
use App\Repositories\GsurfRepository;
use DB;
use Exception;
use Illuminate\Support\Facades\Validator;

class GsurfService
{

    public function __construct(GsurfRepository $gsurfRepository)
    {
        $this->gsurfRepository = $gsurfRepository;
    }

    public function getToken(): string
    {
        return $this->gsurfRepository->getToken();
    }

    /*
     * 1. Buscar transações cujo status seja 14 (pendente) nos ultimos 60 dias
     * 2. Listar uuids das transações
     * 3. Buscar no repositorio da gsurf as transações com os uuids
     * 4. Atualizar as transações com os dados do repositorio
     * 5. Buscar no repositorio da gsurf os pagamentos com os uuids
     * 6. Atualizar os pagamentos com os dados do repositorio
     * 7. Retornar a quantidade de transações e pagamentos atualizados
     */
    public function updatePendingTransactionsAndPayments(): array
    {
        $transactions = Transaction::where('status_id', 14)
            ->where('date', '>=', now()->subDays(60))
            ->get();

        $uuids = $transactions->pluck('uuid')->toArray();
        $updatedTransactions = [];
        $updatedPayments = [];

        foreach ($uuids as $uuid){ //9b8fa3c8ec6778101ef0c569be66983a7d9ad69b0076af6d10c1c15cffda4d2e
            $transactionsFromGsurf = $this->gsurfRepository->getTransactionByUuid($uuid);
            $paymentsFromGsurf = $this->gsurfRepository->getPaymentByUniqueId($uuid);
            /*
             * statusCode, body, body.page, body.limit, body.records: array
             */
            $payment = !empty($paymentsFromGsurf->body->records) ? $paymentsFromGsurf->body->records[0] : null;
            $transaction = !empty($transactionsFromGsurf->body->records) ? $transactionsFromGsurf->body->records[0] : null;

            if (!$transaction && !$payment) {
                continue;
            }

            if ($transaction) {
                $transactionData = $this->extractTransactionData($transaction);
                $this->validateTransactionData($transactionData);
                $transaction = Transaction::updateOrCreate(['id' => $transactionData['id']], $transactionData);
                $updatedTransactions[] = $transaction;
            }

            if ($payment) {
                $paymentData = $this->extractPaymentData($payment);
                $paymentData->save();
                $updatedPayments[] = $paymentData;
            }

        }

        return [
            'transactions' => $updatedTransactions,
            'payments' => $updatedPayments,
        ];
    }

    public function getMerchants()
    {
        $response = $this->gsurfRepository->getMerchants();
        return $response->merchant;
    }

    /**
     * @throws Exception
     */
    public function getTransactions(String $dateTimeStart, String $dateTimeEnd, int $page = 1)
    {
        $start = $this->formatDateTime($dateTimeStart, 'start');
        $end = $this->formatDateTime($dateTimeEnd, 'end');
        return $this->gsurfRepository->getTransactionsFromGsurf($start, $end, $page);
    }

    public function getValuesAndQuantityByDay()
    {
        $values = $this->gsurfRepository->getTransactionsValuesByDay();
        $quantity = $this->gsurfRepository->getTransactionsQuantityByDay();

        if ($values->statusCode !== 200 || $quantity->statusCode !== 200) {
            throw new Exception('Erro ao buscar valores e quantidades por dia');
        }

        $times = $values->body->data[0]->times;
        $valuesData = $values->body->data[0]->values;
        $quantityData = $quantity->body->data[0]->values;

        $response = [
            'statusCode' => 200,
            'body' => [
                'description' => 'Valor das Transações, Quantidade por Dia e Ticket Médio',
                'data' => []
            ]
        ];

        foreach ($times as $index => $time) {
            $value = (float) $valuesData[$index] / 100;
            $quantity = $quantityData[$index];
            $medium_ticket = $value > 0 && $quantity > 0 ? $value / $quantity : 0;

            $response['body']['data'][] = [
                'date' => $time,
                'value' => $value,
                'quantity' => $quantity,
                'medium_ticket' => $medium_ticket
            ];
        }

        return $response;
    }

    public function checkPaymentsIntegrity(): int
    {
        $yesterdayStartDate = now()->subDays(1)->format('Y-m-d');
        $yesterdayEndDate = now()->subDays(1)->format('Y-m-d');
        $paymentsFromApi = $this->getFormattedPayments($yesterdayStartDate, $yesterdayEndDate);
        $paymentsFromDatabase = Payment::where('payment_date', '>=', $yesterdayStartDate)
            ->where('payment_date', '<=', $yesterdayEndDate)
            ->get();

        $diff = count($paymentsFromApi) - count($paymentsFromDatabase);
        if ($diff === 0) {
            return 0;
        }

        $paymentsFromApi = collect($paymentsFromApi);
        $paymentsFromDatabase = collect($paymentsFromDatabase);

        $paymentsFromApi->each(function ($payment) use ($paymentsFromDatabase) {
            $paymentFromDatabase = $paymentsFromDatabase->where('unique_id', $payment->unique_id)->first();
            if (!$paymentFromDatabase) {
                $payment->save();
            }
        });
        return $diff;
    }

    /**
     * @throws Exception
     */
    public function getFormattedTransactions(String $dateTimeStart, String $dateTimeEnd)
    {
        $start = $this->formatDateTime($dateTimeStart, 'start');
        $end = $this->formatDateTime($dateTimeEnd, 'end');
        try {
            $transactions = $this->gsurfRepository->getAllTransactionsFromGsurf($start, $end, 800);
            return array_map([$this, 'validateAndFormatTransaction'], $transactions);
        }catch (Exception $e) {
            throw new Exception('Erro: ' . $e->getMessage(), 400);
        }
    }
    public function getFormattedPayments(String $dateTimeStart, String $dateTimeEnd)
    {
        $start = $this->formatPaymentDateTime($dateTimeStart, 'start');
        $end = $this->formatPaymentDateTime($dateTimeEnd, 'end');
        try {
            $payments = $this->gsurfRepository->getAllPaymentsFromGsurf($start, $end, 800);
            return array_map([$this, 'validateAndFormatPayment'], $payments);
        }catch (Exception $e) {
            throw new Exception('Erro: ' . $e->getMessage(), 400);
        }
    }
    public function importTransactions(String $dateTimeStart, String $dateTimeEnd): array
    {
        $start = $this->formatDateTime($dateTimeStart, 'start');
        $end = $this->formatDateTime($dateTimeEnd, 'end');
        try {
            $transactions = $this->getFormattedTransactions($start, $end);
            $this->commitData($transactions);
            return [
                'status' => 'success',
                'message' => 'Transações importadas com sucesso',
                'count' => count($transactions),
            ];
        }catch (Exception $e) {
            throw new Exception('Erro: ' . $e->getMessage(), 400);
        }
    }
    public function importPayments(String $dateTimeStart, String $dateTimeEnd): array
    {
        try {
            $payments = $this->getFormattedPayments($dateTimeStart, $dateTimeEnd);
            $this->commitPayments($payments);
            return [
                'status' => 'success',
                'message' => 'Pagamentos importados com sucesso',
                'count' => count($payments),
            ];
        }catch (Exception $e) {
            throw new Exception('Erro: ' . $e->getMessage(), 400);
        }
    }

    public function persistTransactions($transactions) : void
    {
        if (is_array($transactions)) {
            foreach ($transactions as $transaction) {
                $this->persistTransactions($transaction);
            }
        } else {
            $transactions->save();
        }
    }
    public function persistPayments($payments) : void
    {
        if (is_array($payments)) {
            foreach ($payments as $payment) {
                $this->persistTransactions($payment);
            }
        } else {
            $payments->save();
        }
    }

    /**
     * @throws Exception
     */
    public function commitData(array $transactions): void
    {
        DB::beginTransaction();

        $actualTransaction = null;
        try {
            foreach ($transactions as $transaction) {
                $actualTransaction = $transaction;
                if ($transaction instanceof Transaction) {
                    $transaction->save();
                } else {
                    $newTransaction = new Transaction($transaction);
                    $newTransaction->save();
                }
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            //delete actual transaction from $transactions
            $transactions = array_filter($transactions, function ($t) use ($actualTransaction) {
                return $t['id'] !== $actualTransaction['id'];
            });
            $this->commitData($transactions);
            //if (str_contains($e->getMessage(), 'Duplicate entry')) {
            //    $duplicatedId = explode('\'', explode('for key', $e->getMessage())[0])[1];
            //    Transaction::where('id', $duplicatedId)->delete();
            //} else {
            //    throw new Exception('Erro ao salvar transações: ' . $e->getMessage());
            //}
        }
    }
    public function commitPayments(array $payments)
    {
        DB::beginTransaction();
        $total = count($payments);
        $counter = 0;
        while (count($payments) > 0) {
            try {
                foreach ($payments as $key => $payment) {
                    if ($payment instanceof Payment) {
                        $payment->save();
                    } else {
                        $newPayment = new Payment($payment);
                        $newPayment->save();
                    }
                    $counter++;
                    unset($payments[$key]);
                }
                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                unset($payments[$key]);
                DB::beginTransaction();
            }
        }

        return $counter;
    }

    public function getAllTerminalsFromGsurf()
    {
        return $this->gsurfRepository->getAllTerminalsFromGsurf();
    }

    /**
     * @throws Exception
     */
    public function formatDateTime(String $dateTime, String $startOrEnd): string
    {
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $dateTime)) {
            throw new Exception('Formato de data inválido');
        }
        return $dateTime . ($startOrEnd == 'start' ? 'T00:00:00' : 'T23:59:59');
    }

    public function validateAndFormatTransaction($response): array
    {
        $transactionData = $this->extractTransactionData($response);
        $this->validateTransactionData($transactionData);
        return $transactionData;
    }
    public function validateAndFormatPayment($response): Payment
    {
        return $this->extractPaymentData($response);
    }

    public function extractTransactionData($response): array
    {
        if (is_array($response)) {
            $transactionData = [
                'id' => $response['id'],
                'date' => $response['date'],
                'nsu_sitef' => $response['nsu_sitef'],
                'merchant_code_sitef' => $response['merchant_code_sitef'],
                'merchant_code_subacquirer' => $response['merchant_code_subacquirer'],
                'response_code' => $response['response_code'] ?? '',
                'authorization_code' => $response['authorization_code'],
                'fiscal_coupon' => $response['fiscal_coupon'],
                'installments_number' => $response['installments_number'],
                'terminal_number' => $response['terminal_number'],
                'channel' => $response['channel'],
                'nsu_host' => $response['nsu_host'],
                'entry_mode' => $response['entry_mode'],
                'logic_number' => $response['logic_number'],
                'fiscal_date' => $response['fiscal_date'],
                'customer_id' => $response['customer_id'],
                'import_date' => $response['import_date'],
                'type' => $response['type'],
                'transaction_date' => $response['transaction_date'],
                'reconciliation_status' => $response['reconciliation_status'],
                'export_date' => $response['export_date'],
                'original_authorization_code' => $response['original_authorization_code'],
                'original_installments_number' => $response['original_installments_number'],
                'order_id' => $response['order_id'],
                'merchant_usn' => $response['merchant_usn'],
                'nit' => $response['nit'],
                'gsetef_merchant_id' => $response['gsetef_merchant_id'],
                'uuid' => $response['uuid'],
                'reconciliation_nsu' => $response['reconciliation_nsu'],
                'reconciliation_date' => $response['reconciliation_date'],
                'dynamic_data' => $response['dynamic_data'],
                'split_data' => $response['split_data'],
                'original_transaction_usn' => $response['original_transaction_usn'],
                'status_id' => $response['status']['id'],
                'status_description' => $response['status']['description'],
                'original_status_id' => $response['original_status']['id'],
                'original_status_description' => $response['original_status']['description'],
                'transaction_type_id' => $response['transaction_type']['id'],
                'transaction_type_description' => $response['transaction_type']['description'],
                'card_brand_id' => $response['card_brand']['id'],
                'card_brand_description' => $response['card_brand']['description'],
                'acquirer_id' => $response['acquirer']['id'],
                'acquirer_description' => $response['acquirer']['description'],
                'category_id' => $response['category']['id'],
                'category_description' => $response['category']['description'],
                'status_category_id' => $response['status_category']['id'],
                'status_category_description' => $response['status_category']['description'],
                'sale_type_id' => $response['sale_type']['id'],
                'sale_type_description' => $response['sale_type']['description'],
                'amount' => $response['amount']['amount'],
                'amount_currency' => $response['amount']['currency'],
                'original_amount' => $response['original_amount']['amount'],
                'original_amount_currency' => $response['original_amount']['currency'],
                'response_code_detailing_category' => $response['response_code_detailing']['category'],
                'response_code_detailing_reason' => $response['response_code_detailing']['reason'],
                'response_code_detailing_note' => $response['response_code_detailing']['note'],
                'antifraud_data_code' => $response['antifraud_data']['code'],
                'antifraud_data_reviewer_comments' => $response['antifraud_data']['reviewer_comments'],
                'antifraud_data_category' => $response['antifraud_data']['category'],
                'antifraud_data_reason' => $response['antifraud_data']['reason'],
                'antifraud_data_note' => $response['antifraud_data']['note'],
            ];
        } else {
            $transactionData = [
                'id' => $response->id,
                'date' => $response->date,
                'nsu_sitef' => $response->nsu_sitef,
                'merchant_code_sitef' => $response->merchant_code_sitef,
                'merchant_code_subacquirer' => $response->merchant_code_subacquirer,
                'response_code' => $response->response_code ?? '',
                'authorization_code' => $response->authorization_code,
                'fiscal_coupon' => $response->fiscal_coupon,
                'installments_number' => $response->installments_number,
                'terminal_number' => $response->terminal_number,
                'channel' => $response->channel,
                'nsu_host' => $response->nsu_host,
                'entry_mode' => $response->entry_mode,
                'logic_number' => $response->logic_number,
                'fiscal_date' => $response->fiscal_date,
                'customer_id' => $response->customer_id,
                'import_date' => $response->import_date,
                'type' => $response->type,
                'transaction_date' => $response->transaction_date,
                'reconciliation_status' => $response->reconciliation_status,
                'export_date' => $response->export_date,
                'original_authorization_code' => $response->original_authorization_code,
                'original_installments_number' => $response->original_installments_number,
                'order_id' => $response->order_id,
                'merchant_usn' => $response->merchant_usn,
                'nit' => $response->nit,
                'gsetef_merchant_id' => $response->gsetef_merchant_id,
                'uuid' => $response->uuid,
                'reconciliation_nsu' => $response->reconciliation_nsu,
                'reconciliation_date' => $response->reconciliation_date,
                'dynamic_data' => $response->dynamic_data,
                'split_data' => $response->split_data,
                'original_transaction_usn' => $response->original_transaction_usn,
                'status_id' => $response->status->id,
                'status_description' => $response->status->description,
                'original_status_id' => $response->original_status->id,
                'original_status_description' => $response->original_status->description,
                'transaction_type_id' => $response->transaction_type->id,
                'transaction_type_description' => $response->transaction_type->description,
                'card_brand_id' => $response->card_brand->id,
                'card_brand_description' => $response->card_brand->description,
                'acquirer_id' => $response->acquirer->id,
                'acquirer_description' => $response->acquirer->description,
                'category_id' => $response->category->id,
                'category_description' => $response->category->description,
                'status_category_id' => $response->status_category->id,
                'status_category_description' => $response->status_category->description,
                //'sale_type_id' => $response->sale_type ? $response->sale_type->id : null,
                //'sale_type_description' => $response->sale_type ? $response->sale_type->description : null,
                'amount' => $response->amount?->amount,
                'amount_currency' => $response->amount->currency,
                'original_amount' => $response->original_amount->amount,
                'original_amount_currency' => $response->original_amount->currency,
                'response_code_detailing_category' => $response->response_code_detailing->category,
                'response_code_detailing_reason' => $response->response_code_detailing->reason,
                'response_code_detailing_note' => $response->response_code_detailing->note,
                'antifraud_data_code' => $response->antifraud_data->code,
                'antifraud_data_reviewer_comments' => $response->antifraud_data->reviewer_comments,
                'antifraud_data_category' => $response->antifraud_data->category,
                'antifraud_data_reason' => $response->antifraud_data->reason,
                'antifraud_data_note' => $response->antifraud_data->note,
            ];
        }
        return $transactionData;
    }

    public function extractPaymentData($record) : Payment
    {
                $paymentInstance = new Payment();

                $paymentInstance->unique_id = $record->unique_id;
                $paymentInstance->creation_date = $record->creation_date;
                $paymentInstance->payment_date = $record->payment_date;
                $paymentInstance->terminal_number = $record->terminal_number;
                $paymentInstance->channel = $record->channel;
                $paymentInstance->customer_id = $record->customer_id;
                $paymentInstance->import_date = $record->import_date;
                $paymentInstance->order_id = $record->order_id;
                $paymentInstance->merchant_usn = $record->merchant_usn;
                $paymentInstance->payer_id = $record->payer_id;
                $paymentInstance->payer_name = $record->payer_name;
                $paymentInstance->gsetef_merchant_id = $record->gsetef_merchant_id;
                $paymentInstance->last_settlement_date = $record->last_settlement_date;
                $paymentInstance->settlement_status = $record->settlement_status;
                $paymentInstance->dynamic_data = $record->dynamic_data;
                $paymentInstance->split_data = $record->split_data;
                $paymentInstance->status_id = $record->status->id;
                $paymentInstance->status_description = $record->status->description;
                $paymentInstance->type_id = $record->type->id;
                $paymentInstance->type_description = $record->type->description;
                $paymentInstance->sale_type_id = $record->sale_type->id;
                $paymentInstance->sale_type_description = $record->sale_type->description;
                $paymentInstance->amount = $record->amount->amount;
                $paymentInstance->amount_currency = $record->amount->currency;
                $paymentInstance->original_amount = $record->original_amount->amount;
                $paymentInstance->original_amount_currency = $record->original_amount->currency;
                $paymentInstance->amount_paid = $record->amount_paid->amount;
                $paymentInstance->amount_paid_currency = $record->amount_paid->currency;
                $paymentInstance->merchant_amount = $record->merchant_amount->amount;
                $paymentInstance->merchant_amount_currency = $record->merchant_amount->currency;
                $paymentInstance->merchant_amount_paid = $record->merchant_amount_paid->amount;
                $paymentInstance->merchant_amount_paid_currency = $record->merchant_amount_paid->currency;
                $paymentInstance->adjustment_amount = $record->adjustment_amount->amount;
                $paymentInstance->adjustment_amount_currency = $record->adjustment_amount->currency;


        return $paymentInstance;
    }
    protected function validateTransactionData(array $transactionData): void
    {
        $rules = [
            'id' => 'required|integer',
            'uuid' => 'required|string|min:24',
            'logic_number' => 'required|string|max:255',
            'reconciliation_date' => 'required|date',
            'date' => 'required|date',
        ];
        $data = [
            'id' => $transactionData['id'],
            'uuid' => $transactionData['uuid'],
            'logic_number' => $transactionData['logic_number'],
            'reconciliation_date' => $transactionData['reconciliation_date'],
            'date' => $transactionData['date'],
        ];
        Validator::make($data, $rules)->validate();
    }

    public function formatPaymentDateTime(String $dateTime, String $startOrEnd): string
    {
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $dateTime)) {
            throw new Exception('Formato de data inválido');
        }
        return $dateTime . ($startOrEnd == 'start' ? '+00:00:00-03:00' : '+23:59:59-03:00');
    }

}
