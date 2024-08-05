<?php

namespace App\Console\Commands;

use App\Services\GsurfService;
use Carbon\Carbon;
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
     */
    public function handle(): int
    {
        $startDate = $this->argument('startDate');
        $endDate = $this->argument('endDate');

        if (!$startDate || !$endDate) {
            $endDate = Carbon::now()->format('Y-m-d');
            $startDate = Carbon::now()->subDay()->format('Y-m-d');
        }

        $response = $this->gsurfService->importTransactions($startDate, $endDate);
        $this->info('Transactions imported successfully.');
        $this->info('Start Date: ' . $startDate);
        $this->info('End Date: ' . $endDate);
        $this->info('Response: ' . json_encode($response));
        return CommandAlias::SUCCESS;
    }
}
