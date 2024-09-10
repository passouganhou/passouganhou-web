<?php

namespace App\Console\Commands;

use App\Models\DataWarehouse\Gsurf\Payment;
use App\Models\DataWarehouse\Gsurf\Transaction;
use Illuminate\Console\Command;

class RefreshJsonCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gsurf:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear the json cache';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function handle(): int
    {
        $directory = storage_path('app/json');
        $files = glob($directory . '/*');
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
        try {
            $payments = $this->jsonRemember('payments', function () {
                return Payment::all();
            });
            $paymentsCount = count($payments);
            $this->info($paymentsCount . ' payments cached');
        } catch (\Exception $e) {
            $this->error('Error clearing json cache');
        }
        try {
            $transactions = $this->jsonRemember('transactions', function () {
                return Transaction::all();
            });
            $transactionsCount = count($transactions);
            $this->info($transactionsCount . ' transactions cached');
        } catch (\Exception $e) {
            $this->error('Error clearing json cache');
        }
        if (isset($paymentsCount) && isset($transactionsCount)) {
            return 1;
        }
        return 0;
    }

    private function jsonRemember(String $key, $callback, $expirationMinutes = 1360)
    {
        $this->info('Refreshing cache for ' . $key);
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
        $this->info('Cache refreshed for ' . $key);
        return $value;
    }
}

