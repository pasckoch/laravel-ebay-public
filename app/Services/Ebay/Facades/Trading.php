<?php

namespace App\Services\Ebay\Facades;

use App\Services\Ebay\Repositories\TradingRepository;
use Illuminate\Support\Facades\Facade;

/**
 * @see TradingRepository
 * @method static string sendInvoice(array $data)
 * @method static string getErrorMessage()
 */
class Trading extends Facade
{

    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return TradingRepository::class;
    }
}
