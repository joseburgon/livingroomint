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

    private $statuses = [
        'paid' => Giving::STATUS_APPROVED,
        'unpaid' => Giving::STATUS_DECLINED,
    ];

    private $paymentMethods = [
        'card' => 'CREDIT_CARD',
        'us_bank_account' => 'BANK_TRANSFER',
        'sepa_debit' => 'BANK_TRANSFER',
        'au_becs_debit' => 'DEBIT_CARD',
        'acss_debit' => 'DEBIT_CARD',
        'oxxo' => 'CASH',
    ];

    private $logTag = '[GIVINGS][SERVICE][STRIPE]';

    public function __construct()
    {
        \Stripe\Stripe::setApiKey(config('services.stripe.key'));

        $this->successUrl = config('services.stripe.success_url');
        $this->cancelUrl = config('services.stripe.cancel_url');
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
            'customer_email' => $giving->giver->email,
            'mode' => 'payment',
            'metadata' => [
                'giving_id' => $giving->id
            ],
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
            'paid' => 'givings.success',
            'unpaid' => 'givings.pending',
        ])->get($state, 'givings.pending');
    }

    public function handleConfirmation(object $data)
    {
        try {
            $giving = Giving::findOrFail($data->metadata->giving_id);

            Log::info("{$this->logTag}[CONFIRMATION] Giving ID: {$giving->id}");

            $method = Arr::get($this->paymentMethods, $data->payment_method_types[0], 'UNKNOWN');

            $paymentMethod = PaymentMethod::type($method)->first();

            $giving->update([
                'status' => $this->statuses[$data->payment_status],
                'transaction_id' => $data->payment_intent,
                'payment_method_id' => $paymentMethod->id,
            ]);

            Log::info("{$this->logTag}[CONFIRMATION] Giving updated. Stripe Transaction ID: {$data->payment_intent}");

            if ($giving->status == Giving::STATUS_APPROVED) {
                Mail::to($giving->giver->email)->queue(new GivingReceived($giving));

                Mail::to(config('givings.notify_email'))->queue(new NotifyGiving($giving));
            }
        } catch (\Exception $e) {
            Log::error("{$this->logTag}[CONFIRMATION] {$e->getMessage()}");
        }
    }
}
