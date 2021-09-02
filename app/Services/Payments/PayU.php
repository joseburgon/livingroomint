<?php

namespace App\Services\Payments;

use App\Contracts\PaymentGatewayInterface;
use App\Models\Giving;
use App\Models\PaymentMethod;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class PayU implements PaymentGatewayInterface
{
    private $checkoutUrl;
    private $apiKey;
    private $merchantId;
    private $accountId;
    private $responseUrl;
    private $confirmationUrl;

    private $statuses = [
        4 => Giving::STATUS_APPROVED,
        5 => Giving::STATUS_DECLINED,
        6 => Giving::STATUS_EXPIRED,
    ];

    private $paymentMethods = [
        2 => 'CREDIT_CARD',
        4 => 'PSE',
        5 => 'ACH',
        6 => 'DEBIT_CARD',
        7 => 'CASH',
    ];

    private $logTag = '[GIVINGS][SERVICE][PAYU]';

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

        $signParams = [$giving->reference, $giving->amount, $giving->currency];

        return [
            'params' => [
                'merchantId' => $this->merchantId,
                'accountId' => $this->accountId,
                'referenceCode' => $giving->reference,
                'description' => $giving->description,
                'amount' => $giving->amount,
                'tax' => 0,
                'taxReturnBase' => 0,
                'signature' => $this->signature($signParams),
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

    public function signature(array $params): string
    {
        $signature = $this->apiKey . '~' . $this->merchantId . '~';

        foreach ($params as $param) {
            $signature .= '~' . $param;
        }

        return md5($signature);
    }

    public function handleConfirmation(array $params)
    {
        try {
            $giving = Giving::reference($params['reference_sale'])->first();

            Log::info("{$this->logTag}[CONFIRMATION] Giving ID: {$giving->id}");

            $method = Arr::get($this->paymentMethods, $params['payment_method_id'], 'UNKNOWN');

            $paymentMethod = PaymentMethod::type($method)->first();

            $giving->update([
                'status' => $this->statuses[$params['state_pol']],
                'transaction_id' => $params['transaction_id'],
                'payment_method_id' => $paymentMethod->id,
                'extra_info' => $params['response_message_pol'],
            ]);

            Log::info("{$this->logTag}[CONFIRMATION] Giving updated. PayU Transaction ID: {$params['transaction_id']}");
        } catch (\Exception $e) {
            Log::error("{$this->logTag}[CONFIRMATION] {$e->getMessage()}");
        }

    }
}
