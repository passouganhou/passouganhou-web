<?php

namespace App\Console\Commands;

use App\Models\DataWarehouse\Gsurf\Transaction;
use App\Services\GsurfService;
use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class ImportTransactions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transactions:import {startDate?} {endDate?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import transactions from GsurfService';

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
        $this->info('Importing transactions...');
        $startDate = $this->argument('startDate');
        $endDate = $this->argument('endDate');

        if (!$startDate || !$endDate) {
            $endDate = Carbon::now()->format('Y-m-d');
            $startDate = Carbon::now()->format('Y-m-d');
        }
        try {
            $transactions = $this->gsurfService->getFormattedTransactions($startDate, $endDate);
        } catch (\Exception $e) {
            $this->error('Error while trying to get transactions: ' . $e->getMessage());
            return CommandAlias::FAILURE;
        }

        $this->info('Transactions fetched successfully.');

        try {
            $count = $this->commitData($transactions);
            if ($count === 0) {
                $this->error('No transactions saved.');
                return CommandAlias::FAILURE;
            }
            $this->info('Total transactions saved: ' . $count);
            $this->clearFiles();
            return CommandAlias::SUCCESS;
        }
        catch (\Exception $e) {
            $this->error('Error while trying to save transactions: ' . $e->getMessage());
            return CommandAlias::FAILURE;
        }

    }

    private function clearFiles()
    {
        try {
            $directory = storage_path('app/json');
            $files = glob($directory . '/*');
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }
            return true;
        } catch (\Exception $e) {
            $this->error('Error while trying to delete files: ' . $e->getMessage());
            return false;
        }
    }

    public function commitData(array $transactions)
    {
        DB::beginTransaction();
        $total = count($transactions);
        $this->info('Total transactions to save: ' . $total);
        $counter = 0;

        $this->info('Saving transactions...');
        $this->output->progressStart($total);

        while (count($transactions) > 0) {
            try {
                foreach ($transactions as $key => $transaction) {
                    if ($transaction instanceof Transaction) {
                        $transaction->save();
                    } else {
                        $newTransaction = new Transaction($transaction);
                        $newTransaction->save();
                    }
                    $counter++;
                    $this->output->progressAdvance();
                    unset($transactions[$key]);  // Remove the transaction after successful save
                }

                DB::commit();
                $this->output->progressFinish();
                $this->info('Transactions saved successfully.');

            } catch (Exception $e) {
                DB::rollBack();
                $this->error('Error while trying to save transaction: ' . $e->getMessage());

                // Log the error and remove the transaction that caused the error
                if ($transaction instanceof Transaction) {
                    $this->error('Failed transaction ID: ' . $transaction->id);
                } else {
                    $this->error('Failed transaction data: ' . json_encode($transaction));
                }

                // Remove the transaction that caused the error
                unset($transactions[$key]);

                // Start a new transaction to try again with the remaining transactions
                DB::beginTransaction();
            }
        }

        return $counter;
    }

}
