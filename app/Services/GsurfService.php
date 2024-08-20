<?php

namespace App\Services;

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

    /**
     * @throws Exception
     */
    public function importTransactions(String $dateTimeStart, String $dateTimeEnd): array
    {
        $start = $this->formatDateTime($dateTimeStart, 'start');
        $end = $this->formatDateTime($dateTimeEnd, 'end');
        try {
            $transactions = $this->gsurfRepository->getAllTransactionsFromGsurf($start, $end);
            $transactionModels = array_map([$this, 'validateAndFormatTransaction'], $transactions);
            $this->commitData($transactionModels);
            return [
                'status' => 'success',
                'message' => 'Transações importadas com sucesso',
                'count' => count($transactionModels),
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

    /**
     * @throws Exception
     */
    public function commitData(array $transactions): void
    {
        DB::beginTransaction();

        try {
            foreach ($transactions as $transaction) {
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
            if (str_contains($e->getMessage(), 'Duplicate entry')) {
                $duplicatedId = explode('\'', explode('for key', $e->getMessage())[0])[1];
                Transaction::where('id', $duplicatedId)->delete();
                $this->commitData($transactions);
            } else {
                throw new Exception('Erro ao salvar transações: ' . $e->getMessage());
            }
        }
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
}
