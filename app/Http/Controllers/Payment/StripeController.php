<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Registries\PaymentGatewayRegistry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Checkout\Session;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Webhook;

class StripeController extends Controller
{
    public $name = 'Stripe';

    private const EVENT_SESSION_COMPLETED = 'checkout.session.completed';

    private $gatewayRegistry;

    private $paymentService;

    private $logTag = '[GIVINGS][CONTROLLER][STRIPE]';

    public function __construct (PaymentGatewayRegistry $registry) {
        $this->gatewayRegistry = $registry;

        $this->paymentService = $this->gatewayRegistry->get($this->name);
    }

    public function response(Request $request)
    {
        $session = Session::retrieve($request->get('session_id'));

        return view($this->paymentService->getResponseView($session->payment_status), [
            'currency' => $session->currency,
            'amount' => number_format(($session->amount_total / 100), 2, '.', ' '),
            'email' => $session->customer_email
        ]);
    }

    public function notify(Request $request)
    {
        Log::info("{$this->logTag}[NOTIFY] Notification received - Event: {$request->get('type')}", $request->input());

        try {
            $event = Webhook::constructEvent(
                $request->getContent(), $request->header('stripe-signature'), config('services.stripe.endpoint_secret')
            );
        } catch(\UnexpectedValueException $e) {
            Log::error("{$this->logTag}[NOTIFY] Invalid payload", $request->input());

            return response('INVALID PAYLOAD', 400);
        } catch(SignatureVerificationException $e) {
            Log::error("{$this->logTag}[NOTIFY] Invalid signature", $request->input());

            return response('INVALID SIGNATURE', 400);
        }

        if ($event->type === self::EVENT_SESSION_COMPLETED) {
            $this->paymentService->handleConfirmation($event->data->object);
        }

        return response('OK', 200);
    }
}
