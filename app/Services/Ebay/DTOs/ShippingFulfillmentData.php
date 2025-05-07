<?php

namespace App\Services\Ebay\DTOs;

use Illuminate\Support\Facades\Validator;

class ShippingFulfillmentData
{
    public function __construct(
        public array $lineItems,
        public string $shippedDate,
        public string $shippingCarrierCode,
        public string $trackingNumber,
    ) {
    }

    /** @var array  */
    private static array $dataExample =  [
        'lineItems' => [
            [
                'lineItemId' => 'v1|110582744366|0',
                'quantity' => '2'
            ],
            [
                'lineItemId' => 'v1|110582744366|0',
                'quantity' => '2'
            ]
        ],
        'shippedDate' => "2025-05-01 00:00:00",
        'shippingCarrierCode' => "",
        'trackingNumber' => "",
    ];

    /**
     * @param array $data
     * @return string
     *
     * @throw \Illuminate\Validation\ValidationException
     */
    public static function toJson(array $data = []): string
    {
        if (!count($data)) {
            $data = self::$dataExample;
        }

        Validator::validate($data, [
            'lineItems' => 'required|array',
            'lineItems.*' => 'required|array',
            'lineItems.*.lineItemId' => 'required|string',
            'lineItems.*.quantity' => 'required|integer',
            'shippedDate' => 'required|date',
            'shippingCarrierCode' => 'string|nullable',
            'trackingNumber' => 'string|nullable',
        ]);

        return json_encode($data);
    }
}
