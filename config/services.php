<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'ebay' => [
        'version' => env('EBAY_VERSION'),
        'base_url' => env('EBAY_BASE_URL'),
        'site_id' => env('EBAY_SITE_ID'),
        'app_id' => env('EBAY_APP_ID'),
        'dev_id' => env('EBAY_DEV_ID'),
        'cert_id' => env('EBAY_CERT_ID'),
        'auth_refresh_token' => env('EBAY_AUTH_REFRESH_TOKEN'),
        'client_scope' => env('EBAY_CLIENT_SCOPE'),
        'endpoint_identity' => '/identity/v1/oauth2/token',
        'endpoint_shipping_fulfillment' => '/sell/fulfillment/v1/order/{orderId}/shipping_fulfillment',
        'endpoint_ws_api' => '/ws/api.dll'
    ],

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

];
