<?php

namespace App\Console\Commands\Ebay\Tokens;

use App\Services\Ebay\Facades\Tokens;
use Illuminate\Console\Command;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;

class AuthorizationToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ebay:authorization-token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'OAuth access tokens verify to eBay that a request is coming from a valid application and that the application has the user\'s authorization to carry out the requests';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        ($token = Tokens::getAuthToken()) ? $this->info($token) : $this->error(Tokens::getErrorMessage());
    }
}
