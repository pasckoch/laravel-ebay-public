<?php

namespace App\Console\Commands\Ebay;

use App\Services\Ebay\Facades\Trading;
use Illuminate\Console\Command;

class SendInvoice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ebay:send-invoice
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Use this call to send an email invoice or order to a buyer';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        if (!Trading::sendInvoice([])) {
            $this->error(Trading::getErrorMessage());
            return 1;
        }
        return 0;
    }
}
