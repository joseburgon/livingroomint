<?php

namespace App\Services\Payments;

use App\Contracts\PaymentGatewayInterface;
use App\Models\Giving;

class PayU implements PaymentGatewayInterface
{
    private $checkoutUrl;
    private $apiKey;
    private $merchantId;
    private $accountId;
    private $responseUrl;
    private $confirmationUrl;

    public function __construct()
    {
        $this->checkoutUrl = config('services.payu.url');
        $this->apiKey = config('services.payu.key');
        $this->merchantId = config('services.payu.merchant');
        $this->accountId = config('services.payu.account');
        $this->responseUrl = config('services.payu.response_url');
        $this->confirmationUrl = config('services.payu.confirmation_url');
    }

    public function pay()
    {
        // TODO: Implement pay() method.
    }

    public function prepare(Giving $giving): array
    {
        $giving->load('giver.documentType');

        return [
            'params' => [
                'merchantId' => $this->merchantId,
                'accountId' => $this->accountId,
                'referenceCode' => $giving->reference,
                'description' => $giving->description,
                'amount' => $giving->amount,
                'tax' => 0,
                'taxReturnBase' => 0,
                'signature' => $this->signature($giving),
                'currency' => $giving->currency,
                'buyerFullName' => $giving->giver->full_name,
                'buyerEmail' => $giving->giver->email,
                'mobilePhone' => $giving->giver->phone,
                'buyerDocumentType' => $giving->giver->documentType->code,
                'buyerDocument' => $giving->giver->document,
                'responseUrl' => $this->responseUrl,
                'confirmationUrl' => $this->confirmationUrl,
                'test' => 0,
            ],
            'checkoutUrl' => $this->getCheckoutUrl()
        ];
    }

    public function getCheckoutUrl()
    {
        return $this->checkoutUrl;
    }

    private function signature(Giving $giving): string
    {
        return md5($this->apiKey . '~' . $this->merchantId . '~' . $giving->reference . '~' . $giving->amount . '~' . $giving->currency);
    }
}
