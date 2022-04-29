<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Registries\PaymentGatewayRegistry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Checkout\Session;

class StripeController extends Controller
{
    public $name = 'Stripe';

    private $gatewayRegistry;

    private $paymentService;

    private $logTag = '[GIVINGS][CONTROLLER][STRIPE]';

    public function __construct (PaymentGatewayRegistry $registry) {
        $this->gatewayRegistry = $registry;

        $this->paymentService = $this->gatewayRegistry->get($this->name);
    }

    public function success(Request $request)
    {
        $session = Session::retrieve($request->get('session_id'));
        dd($session);

        return view('givings.success', []);
    }

    public function confirmation(Request $request)
    {
        Log::info("{$this->logTag}[CONFIRMATION] Receiving new confirmation request.");

        $signParams  = [
            $request->reference_sale,
            substr($request->value, -1) == 0 ? substr($request->value, 0, -1) : $request->value,
            $request->currency,
            $request->state_pol,
        ];

        $signature = $this->paymentService->signature($signParams);

        if (strtoupper($request->sign) !== strtoupper($signature)) {
            Log::error("{$this->logTag}[CONFIRMATION] Invalid Signature received.", $request->input());

            return response('Invalid Signature', 406);
        }

        $this->paymentService->handleConfirmation($request->input());

        return response('OK', 200);
    }
}
