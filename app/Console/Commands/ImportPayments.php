<?php

namespace App\Console\Commands;

use App\Models\DataWarehouse\Gsurf\Payment;
use App\Models\DataWarehouse\Gsurf\Transaction;
use App\Services\GsurfService;
use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class ImportPayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payments:import {startDate?} {endDate?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import payments from GsurfService';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $gsurfService;

    public function __construct(GsurfService $gsurfService)
    {
        parent::__construct();
        $this->gsurfService = $gsurfService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     * @throws \Exception
     */
    public function handle(): int
    {
        $this->info('Importing payments...');
        $startDate = $this->argument('startDate');
        $endDate = $this->argument('endDate');

        if (!$startDate || !$endDate) {
            $endDate = Carbon::now()->format('Y-m-d');
            $startDate = Carbon::now()->format('Y-m-d');
        }
        try {
            $transactions = $this->gsurfService->getFormattedPayments($startDate, $endDate);
        } catch (\Exception $e) {
            $this->error('Error while trying to get payments: ' . $e->getMessage());
            return CommandAlias::FAILURE;
        }

        $this->info('Payments fetched successfully.');

        try {
            $count = $this->insertBatch($transactions);
            if ($count === 0) {
                $this->error('No payments saved.');
                return CommandAlias::FAILURE;
            }
            $this->info('Total payments saved: ' . $count);
            if ($this->clearFiles()){
                $this->regenerateJsonCache();
            }
            return CommandAlias::SUCCESS;
        }
        catch (\Exception $e) {
            $this->error('Error while trying to save payments: ' . $e->getMessage());
            return CommandAlias::FAILURE;
        }

    }

    private function clearFiles()
    {
        try {
            $directory = storage_path('app/json');
            $path = $directory . '/payments.json';
            if (file_exists($path)){
                unlink($path);
                $this->info('File deleted successfully.');
            } else {
                $this->info('File not found.');
            }
            return true;
        } catch (\Exception $e) {
            $this->error('Error while trying to delete files: ' . $e->getMessage());
            return false;
        }
    }

    private function regenerateJsonCache()
    {
        $paymentsInCache = $this->jsonRemember('payments', function () {
            return Payment::all();
        }, 1300);
        $this->info('Payments in cache: ' . count($paymentsInCache));
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

    public function commitData(array $payments)
    {
        DB::beginTransaction();
        $total = count($payments);
        $this->info('Total payments to save: ' . $total);
        $counter = 0;

        $this->info('Saving payments...');
        $this->output->progressStart($total);

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
                    $this->output->progressAdvance();
                    unset($payments[$key]);  // Remove the transaction after successful save
                }

                DB::commit();
                $this->output->progressFinish();
                $this->info('Transactions saved successfully.');

            } catch (Exception $e) {
                DB::rollBack();
                $this->error('Error while trying to save payment: ' . $e->getMessage());

                // Log the error and remove the transaction that caused the error
                if ($payment instanceof Payment) {
                    $this->error('Failed payment unique_id: ' . $payment->unique_id);
                } else {
                    $this->error('Failed payment data: ' . json_encode($payment));
                }

                // Remove the transaction that caused the error
                unset($payments[$key]);

                // Start a new transaction to try again with the remaining transactions
                DB::beginTransaction();
            }
        }

        return $counter;
    }

    public function mountBatchInsert(array $payments)
    {
        $batchInsert = [];

        foreach ($payments as $payment) {
            $batchInsert[] = [
                'unique_id' => $payment->unique_id,
                'creation_date' => $payment->creation_date,
                'payment_date' => $payment->payment_date,
                'terminal_number' => $payment->terminal_number,
                'channel' => $payment->channel,
                'customer_id' => $payment->customer_id,
                'import_date' => $payment->import_date,
                'order_id' => $payment->order_id,
                'merchant_usn' => $payment->merchant_usn,
                'payer_id' => $payment->payer_id,
                'payer_name' => $payment->payer_name,
                'gsetef_merchant_id' => $payment->gsetef_merchant_id,
                'last_settlement_date' => $payment->last_settlement_date,
                'settlement_status' => $payment->settlement_status,
                'dynamic_data' => $payment->dynamic_data,
                'split_data' => $payment->split_data,
                'status_id' => $payment->status_id,
                'status_description' => $payment->status_description,
                'type_id' => $payment->type_id,
                'type_description' => $payment->type_description,
                'sale_type_id' => $payment->sale_type_id,
                'sale_type_description' => $payment->sale_type_description,
                'amount' => $payment->amount,
                'amount_currency' => $payment->amount_currency,
                'original_amount' => $payment->original_amount,
                'original_amount_currency' => $payment->original_amount_currency,
                'amount_paid' => $payment->amount_paid,
                'amount_paid_currency' => $payment->amount_paid_currency,
                'merchant_amount' => $payment->merchant_amount,
                'merchant_amount_currency' => $payment->merchant_amount_currency,
                'merchant_amount_paid' => $payment->merchant_amount_paid,
                'merchant_amount_paid_currency' => $payment->merchant_amount_paid_currency,
                'adjustment_amount' => $payment->adjustment_amount,
                'adjustment_amount_currency' => $payment->adjustment_amount_currency,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }

        return $batchInsert;
    }

    public function insertBatch(array $payments)
    {
        $this->info('Total payments to save: ' . count($payments));
        // Dividindo o array de pagamentos em lotes menores
        $batchSize = 700; // Defina o tamanho do lote de acordo com as limitações do seu servidor/banco de dados
        $batches = array_chunk($payments, $batchSize);
        $this->info('Total batches to save: ' . count($batches));
        $this->info('Batch size: ' . $batchSize);
        $this->info('Inserting batches...');
        $this->output->progressStart(count($batches));

        $totalInserted = 0;

        foreach ($batches as $batch) {
            $this->output->progressAdvance();
            $batchInsert = $this->mountBatchInsert($batch);
            $this->info('Inserting batch of size: ' . count($batchInsert));
            DB::table('gsurf_payments')->insert($batchInsert);
            $this->info('Batch inserted successfully.');
            $totalInserted += count($batchInsert);
        }
        $this->output->progressFinish();
        $this->info('Total payments saved: ' . $totalInserted);
        return $totalInserted;
    }
}
