<?php

namespace App\Services\Ebay\DTOs;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class SendInvoiceSchemaData
{
    private static array $dataExample =  [
        'adjustmentAccount' => ['currencyCodeType' => 'EUR', 'amountType' => 1.00],
        'checkoutInstructions' => '',
        'emailCopySeller' => '',
        'internationalShippingServiceOptionsList' => [
            [
                'shippingService' => '',
                'shippingServiceAdditionalCost' => ['currencyCodeType' => 'EUR', 'amountType' => 0.00],
                'shippingServiceCost' => ['currencyCodeType' => 'EUR', 'amountType' => 0.00],
                'shippingServicePriority' => 5,
                'shipLocations' => [
                    '',
                    ''
                ]
            ],
            [
                'shippingService' => '',
                'shippingServiceAdditionalCost' => ['currencyCodeType' => 'EUR', 'amountType' => 0.00],
                'shippingServiceCost' => ['currencyCodeType' => 'EUR', 'amountType' => 0.00],
                'shippingServicePriority' => 5,
                'shipLocations' => [
                    '',
                    ''
                ]
            ]
        ],
        'itemId' => '',
        'orderId' => '',
        'orderLineItemId' => '',
        'paymentMethodsList>' => [
            '',
            ''
        ],
        'salesTax' => [
            'salesTaxAmount' => ['currencyCodeType' => 'EUR', 'amountType' => 0.00],
            'salesTaxPercent' => 0.0,
            'salesTaxState' => '',
            'shippingIncludedInTax' => 0
        ],
        'shippingServiceOptionsList' => [
            [
                'shippingService' => '',
                'shippingServiceAdditionalCost' => ['currencyCodeType' => 'EUR', 'amountType' => 0.00],
                'shippingServiceCost' => ['currencyCodeType' => 'EUR', 'amountType' => 0.00],
                'shippingServicePriority' => 5,
            ],
            [
                'shippingService' => '',
                'shippingServiceAdditionalCost' => ['currencyCodeType' => 'EUR', 'amountType' => 0.00],
                'shippingServiceCost' => ['currencyCodeType' => 'EUR', 'amountType' => 0.00],
                'shippingServicePriority' => 5,
            ]
        ],
        'sku' => '',
        'transactionId' => '',
        'errorLanguage' => 'fr_FR',
        'messageId' => '',
        'version' => '',
        'warningLevel' => 'High'
    ];


    /**
     * @param array|null $data
     * @return string
     */
    public static function getSchemaXml(array $data = null): string
    {
        if (!count($data)) {
            $data = array_merge(
                ['xmlHeader' => '<?xml version="1.0" encoding="utf-8"?>'],
                self::$dataExample
            );
        }

        Validator::validate($data, [
            'adjustmentAccount' => 'array',
            'adjustmentAccount.currencyCodeType' => 'string',
            'adjustmentAccount.amountType' => 'numeric',
            'checkoutInstructions' => 'string',
            'emailCopySeller' => 'string',
            'internationalShippingServiceOptionsList' => 'array',
            'internationalShippingServiceOptionsList.*' => 'array',
            'internationalShippingServiceOptionsList.*.shippingService' => 'string',
            'internationalShippingServiceOptionsList.*.shippingServiceAdditionalCost' => 'array',
            'internationalShippingServiceOptionsList.*.shippingServiceAdditionalCost.currencyCodeType' => 'string',
            'internationalShippingServiceOptionsList.*.shippingServiceAdditionalCost.amountType' => 'numeric',
            'internationalShippingServiceOptionsList.*.shippingServiceCost' => 'array',
            'internationalShippingServiceOptionsList.*.shippingServiceCost.currencyCodeType' => 'string',
            'internationalShippingServiceOptionsList.*.shippingServiceCost.amountType' => 'numeric',
            'internationalShippingServiceOptionsList.*.shippingServicePriority' => 'integer',
            'internationalShippingServiceOptionsList.*.shipLocations' => 'array',
            'internationalShippingServiceOptionsList.*.shipLocations.*' => 'string',
            'itemId' => 'string',
            'orderId' => 'string',
            'orderLineItemId' => 'string',
            'paymentMethodsList' => 'array',
            'paymentMethodsList.*' => 'string',
            'salesTax' => 'array',
            'salesTax.salesTaxAmount' => 'array',
            'salesTax.salesTaxAmount.currencyCodeType' => 'string',
            'salesTax.salesTaxAmount.amountType' => 'numeric',
            'salesTax.salesTaxState' => 'string',
            'salesTax.shippingIncludedInTax' => 'integer',
            'shippingServiceOptionsList' => 'array',
            'shippingServiceOptionsList.*' => 'array',
            'shippingServiceOptionsList.*.shippingService' => 'string',
            'shippingServiceOptionsList.*.shippingServiceAdditionalCost' => 'array',
            'shippingServiceOptionsList.*.shippingServiceAdditionalCost.currencyCodeType' => 'string',
            'shippingServiceOptionsList.*.shippingServiceAdditionalCost.amountType' => 'numeric',
            'shippingServiceOptionsList.*.shippingServiceCost' => 'array',
            'shippingServiceOptionsList.*.shippingServiceCost.currencyCodeType' => 'string',
            'shippingServiceOptionsList.*.shippingServiceCost.amountType' => 'numeric',
            'shippingServiceOptionsList.*.shippingServicePriority' => 'integer',
            'sku' => 'string',
            'transactionId' => 'string',
            'errorLanguage' => 'string',
            'messageId' => 'string',
            'version' => 'string',
            'warningLevel' => 'string',
        ]);

        return View::make('ebay.sendInvoice', $data )->render();
    }
}
