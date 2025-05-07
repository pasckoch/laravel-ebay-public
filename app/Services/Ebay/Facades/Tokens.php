<?php

namespace App\Services\Ebay\Facades;

use App\Services\Ebay\Repositories\TokensRepository;
use Illuminate\Support\Facades\Facade;

/**
 * @see TokensRepository
 * @method static string getClientToken()
 * @method static string getAuthToken()
 * @method static string getErrorMessage()
 */
class Tokens extends Facade
{

    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return TokensRepository::class;
    }
}
