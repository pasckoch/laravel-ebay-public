<?php

namespace App\Console\Commands\Ebay;

use App\Services\Ebay\Facades\Fulfillment;
use Illuminate\Console\Command;

class ShippingFulfillment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ebay:shipping-fulfillment
    {orderId : the id of the ebay order}
    {requestPayload : the json createShippingFulfillment request payload}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a shipping fulfillment associated with an order package';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $orderId = $this->argument('orderId');
        $requestPayload = json_decode($this->argument('requestPayload'), true);
        if(!$requestPayload){
            $this->error('Invalid request payload, fill like {"lineItems":[{"lineItemId":"v1|110582744366|0","quantity":"1"},{"lineItemId":"v1|110582744366|0","quantity":"2"}],"shippedDate":"2025-05-01 00:00:00","shippingCarrierCode":"","trackingNumber":""}');
            return 1;
        }
        if (!Fulfillment::createShippingFulfillment($orderId, $requestPayload)) {
            $this->error(Fulfillment::getErrorMessage());
            return 1;
        }
        return 0;
    }
}
