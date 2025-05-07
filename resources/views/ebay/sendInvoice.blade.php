{!! $xmlHeader !!}
<SendInvoiceRequest xmlns="urn:ebay:apis:eBLBaseComponents">
    <!-- Call-specific Input Fields -->
    @if (isset($adjustmentAccount))
        <AdjustmentAmount
            currencyID="{{ $adjustmentAccount["currencyCodeType"] }}">{{ $adjustmentAccount["amountType"] }}</AdjustmentAmount>
    @endif
    @if (isset($checkoutInstructions))
        <CheckoutInstructions>{{ $checkoutInstructions }}</CheckoutInstructions>
    @endif
    @if (isset($emailCopySeller))
        <EmailCopyToSeller>{{ $emailCopySeller }}</EmailCopyToSeller>
    @endif
    @if (isset($internationalShippingServiceOptionsList) && count($internationalShippingServiceOptionsList))
        @foreach ($internationalShippingServiceOptionsList as $internationalShippingServiceOptions)
            <InternationalShippingServiceOptions>
                <ShippingService>{{ $internationalShippingServiceOptions['shippingService'] }}</ShippingService>
                <ShippingServiceAdditionalCost
                    currencyID="{{ $internationalShippingServiceOptions['shippingServiceAdditionalCost']['currencyCodeType'] }}">
                    {{ $internationalShippingServiceOptions['shippingServiceAdditionalCost']['amountType'] }}
                </ShippingServiceAdditionalCost>
                <ShippingServiceCost
                    currencyID="{{ $internationalShippingServiceOptions['shippingServiceCost']['currencyCodeType'] }}">
                    {{ $internationalShippingServiceOptions['shippingServiceCost']['amountType'] }}
                </ShippingServiceCost>
                <ShippingServicePriority>{{ $internationalShippingServiceOptions['shippingServicePriority'] }}</ShippingServicePriority>
                @if (isset($internationalShippingServiceOptions['shipLocations']) && count($internationalShippingServiceOptions['shipLocations']))
                    @foreach ($internationalShippingServiceOptions['shipLocations'] as $shipLocations)
                        <ShipToLocation>{{ $shipLocations }}</ShipToLocation>
                    @endforeach
                    <!-- ... more ShipToLocation values allowed here ... -->
                @endif
            </InternationalShippingServiceOptions>
            <!-- ... more InternationalShippingServiceOptions nodes allowed here ... -->
        @endforeach
    @endif
    @if (isset($itemId))
        <ItemID>{{ $itemId }}</ItemID>
    @endif
    @if (isset($orderId))
        <OrderID>{{ $orderId }}</OrderID>
    @endif
    @if (isset($orderLineItemId))
        <OrderLineItemID>{{ $orderLineItemId }}</OrderLineItemID>
    @endif
    @if (isset($paymentMethodsList) && count($paymentMethodsList))
        @foreach ($paymentMethodsList as $paymentMethods)
            <PaymentMethods> BuyerPaymentMethodCodeType</PaymentMethods>
            <!-- ... more PaymentMethods values allowed here ... -->
        @endforeach
    @endif
    @if (isset($salesTax) && count($salesTax))
        <SalesTax>
            <SalesTaxAmount currencyID="{{ $salesTax['salesTaxAmount']['currencyCodeType'] }}">
                {{ $salesTax['salesTaxAmount']['amountType'] }}
            </SalesTaxAmount>
            <SalesTaxPercent>{{ $salesTax['salesTaxPercent'] }}</SalesTaxPercent>
            <SalesTaxState>{{ $salesTax['salesTaxState'] }}</SalesTaxState>
            <ShippingIncludedInTax>{{ $salesTax['shippingIncludedInTax'] }}</ShippingIncludedInTax>
        </SalesTax>
    @endif
    @if (isset($shippingServiceOptionsList) && count($shippingServiceOptionsList))
        @foreach ($shippingServiceOptionsList as $shippingServiceOptions)
            <ShippingServiceOptions>
                <ShippingService>{{ $shippingServiceOptions['shippingService'] }}</ShippingService>
                <ShippingServiceAdditionalCost
                    currencyID="{{ $shippingServiceOptions['shippingServiceAdditionalCost']['currencyCodeType'] }}">
                    {{ $shippingServiceOptions['shippingServiceAdditionalCost']['amountType'] }}
                </ShippingServiceAdditionalCost>
                <ShippingServiceCost
                    currencyID="{{ $shippingServiceOptions['shippingServiceCost']['currencyCodeType'] }}">
                    {{ $shippingServiceOptions['shippingServiceCost']['amountType'] }}
                </ShippingServiceCost>
                <ShippingServicePriority>{{ $shippingServiceOptions['shippingServicePriority'] }}</ShippingServicePriority>
            </ShippingServiceOptions>
            <!-- ... more ShippingServiceOptions nodes allowed here ... -->
        @endforeach
    @endif
    @if (isset($adjustmentAccount))
        <SKU>{{ $sku }}</SKU>
    @endif
    @if (isset($adjustmentAccount))
        <TransactionID>{{ $transactionId }}</TransactionID>
    @endif
    <!-- Standard Input Fields -->
    @if (isset($errorLanguage))
        <ErrorLanguage>{{ $errorLanguage }}</ErrorLanguage>
    @endif
    @if (isset($messageId))
        <MessageID>{{ $messageId }}</MessageID>
    @endif
    @if (isset($version))
        <Version>{{ $version }}</Version>
    @endif
    @if (isset($warningLevel))
        <WarningLevel>{{ $warningLevel }}</WarningLevel>
    @endif
</SendInvoiceRequest>
