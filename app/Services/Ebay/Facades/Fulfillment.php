<?php

namespace App\Services\Ebay\Facades;

use \App\Services\Ebay\Repositories\FulfillmentRepository;
use Illuminate\Support\Facades\Facade;

/**
 * @see FulfillmentRepository
 * @method static string createShippingFulfillment(string $orderId, array $data)
 * @method static string getErrorMessage()
 */
class Fulfillment extends Facade
{

    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return FulfillmentRepository::class;
    }
}
