<?php

namespace App\Services\Ebay\Repositories;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class TokensRepository
{
    use ErrorTrait;

    /**
     * @param array $data
     * @return false|string
     */
    private function getEbayOauth2Token(array $data): false|string
    {
        try {
            $response = Http::baseUrl(Config::get('services.ebay.base_url'))
                ->acceptJson()
                ->asForm()
                ->withBasicAuth(Config::get('services.ebay.app_id'), Config::get('services.ebay.cert_id'))
                ->post(Config::get('services.ebay.endpoint_identity'), $data);
            $response->throwIf(fn(Response $response) => true);
            return $response->object()->access_token;
        } catch (RequestException|ConnectionException $e) {
            return $this->handleError($e, $response ?? null);
        }
    }

    /**
     * @return false|string
     */
    public function getAuthToken(): false|string
    {
        return $this->getEbayOauth2Token([
            'grant_type' => 'refresh_token',
            'refresh_token' => Config::get('services.ebay.auth_refresh_token')
        ]);
    }

    /**
     * @return false|string
     */
    public function getClientToken(): false|string
    {
        return $this->getEbayOauth2Token([
            'grant_type' => 'client_credentials',
            'scope' => Config::get('services.ebay.client_scope'),
        ]);
    }
}
