<?php

namespace App\Services\Ebay\Repositories;

use App\Services\Ebay\DTOs\ShippingFulfillmentData;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class FulfillmentRepository extends TokensRepository
{

    /**
     * @param string $orderId
     * @param array $data
     * @return bool
     */
    public function createShippingFulfillment(string $orderId, array $data): bool
    {
        $token = $this->getAuthToken();
        $result = false;
        if ($token) {
            try {
                $response = Http::baseUrl(Config::get('services.ebay.base_url'))
                    ->withUrlParameters(['orderId' => $orderId])
                    ->withToken($token)
                    ->withBody(ShippingFulfillmentData::toJson($data))
                    ->post(Config::get('services.ebay.endpoint_shipping_fulfillment'));
                $response->throwIf(fn(Response $response) => true);
                $result = true;
            } catch (ValidationException|ConnectionException|RequestException  $e) {
                $result = $this->handleError($e, $response ?? null);
            }
        }
        return $result;
    }
}
