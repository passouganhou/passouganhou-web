<?php

namespace App\Console\Commands;

use App\Models\DataWarehouse\Gsurf\Payment;
use App\Models\DataWarehouse\Gsurf\Transaction;
use App\Services\GsurfService;
use Illuminate\Console\Command;

class CheckPendingTransactions extends Command
{
    protected $signature = 'gsurf:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync pending transactions';

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
    public function handle(): int
    {
        $response = $this->gsurfService->updatePendingTransactionsAndPayments();
        if ($response) {
            $this->info('Pending transactions synced');
            $this->call('gsurf:clear');
            return 1;
        }
        $this->error('Error syncing pending transactions');
        return 0;
    }
}
