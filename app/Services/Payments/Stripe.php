<?php

namespace App\Services\Payments;

use App\Contracts\PaymentGatewayInterface;
use App\Mail\NotifyGiving;
use App\Mail\GivingReceived;
use App\Models\Giving;
use App\Models\PaymentMethod;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class Stripe implements PaymentGatewayInterface
{
    private $checkoutSession;
    private $successUrl;
    private $cancelUrl;
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

    private $logTag = '[GIVINGS][SERVICE][STRIPE]';

    public function __construct()
    {
        \Stripe\Stripe::setApiKey(config('services.stripe.key'));

        $this->successUrl = config('services.stripe.success_url');
        $this->cancelUrl = config('services.stripe.cancel_url');
        $this->confirmationUrl = config('services.stripe.confirmation_url');
    }

    public function pay()
    {
        // TODO: Implement pay() method.
    }

    public function prepare(Giving $giving): array
    {
        $this->checkoutSession = \Stripe\Checkout\Session::create([
            'line_items' => [[
                'price_data' => [
                    'currency' => $giving->currency,
                    'product_data' => [
                        'name' => 'Donación en línea a Living Room',
                        'description' => $giving->reference,
                    ],
                    'unit_amount_decimal' => $giving->centsAmount
                ],
                'quantity' => 1
            ]],
            'mode' => 'payment',
            'success_url' => $this->successUrl,
            'cancel_url' => $this->cancelUrl,
        ]);

        return [
            'checkoutUrl' => $this->getCheckoutUrl(),
            'redirectType' => 'away'
        ];
    }

    public function getCheckoutUrl()
    {
        return $this->checkoutSession->url;
    }

    public function getResponseView($state)
    {
        return collect([
            4 => 'givings.success',
            5 => 'givings.error',
            6 => 'givings.error',
            7 => 'givings.pending',
            104 => 'givings.error',
        ])->get($state, 'givings.pending');
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

            if ($giving->status == Giving::STATUS_APPROVED) {
                Mail::to($giving->giver->email)->queue(new GivingReceived($giving));

                Mail::to(config('givings.notify_email'))->queue(new NotifyGiving($giving));
            }
        } catch (\Exception $e) {
            Log::error("{$this->logTag}[CONFIRMATION] {$e->getMessage()}");
        }

    }
}
