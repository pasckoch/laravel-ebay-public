<?php

namespace App\Services\Ebay\Repositories;

use App\Services\Ebay\DTOs\SendInvoiceSchemaData;
use ErrorException;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class TradingRepository extends TokensRepository
{

    /**
     * @param string $orderId
     * @param array $data
     * @return bool
     */
    public function sendInvoice(array $data): bool
    {
        $token = $this->getAuthToken();
        $result = false;
        $xml = SendInvoiceSchemaData::getSchemaXml($data);
        if ($token) {
            try {
                $response = Http::baseUrl(Config::get('services.ebay.base_url'))
                    ->withHeaders([
                        'X-EBAY-API-COMPATIBILITY-LEVEL' => Config::get('services.ebay.version'),
                        'X-EBAY-API-CALL-NAME' => 'SendInvoice',
                        'X-EBAY-API-SITEID' => Config::get('services.ebay.site_id'),
                        'X-EBAY-API-IAF-TOKEN' => $token,
                    ])
                    ->withToken($token)
                    ->withBody($xml)
                    ->post(Config::get('services.ebay.endpoint_ws_api'));
                $response->throwIf(fn(Response $response) => true);
                $xml = simplexml_load_string($response->body());
                if(!$xml->Ack || (string)($xml->Ack) === 'Failure') {
                    throw new ErrorException('Invalid response from Ebay API');
                }
                $result = true;
            } catch (ValidationException|ConnectionException|RequestException|ErrorException  $e) {
                $result = $this->handleError($e, $response ?? null);
            }
        }
        return $result;
    }
}
