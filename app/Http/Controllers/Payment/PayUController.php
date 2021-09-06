<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Registries\PaymentGatewayRegistry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PayUController extends Controller
{
    public $name = 'PayU';

    private $gatewayRegistry;

    private $paymentService;

    private $logTag = '[GIVINGS][CONTROLLER][PAYU]';

    public function __construct (PaymentGatewayRegistry $registry) {
        $this->gatewayRegistry = $registry;

        $this->paymentService = $this->gatewayRegistry->get($this->name);
    }

    public function response(Request $request)
    {
        $signParams  = [
            $request->referenceCode,
            number_format($request->TX_VALUE, 1, '.', ''),
            $request->currency
        ];

        $signature = $this->paymentService->signature($signParams);

        if (strtoupper($request->signature) !== strtoupper($signature)) {
            return view('givings.error');
        }

        $data['currency'] = $request->currency;
        $data['amount'] = $request->TX_VALUE;
        $data['email'] = $request->buyerEmail;

        /*$data['currency'] = 'CLP';
        $data['amount'] = 50000.00;
        $data['email'] = 'giver@mail.com';*/

        return view('givings.response', $data);
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

        if (strtoupper($request->signature) !== strtoupper($signature)) {
            Log::error("{$this->logTag}[CONFIRMATION] Invalid Signature received.", $request->input());

            return response('Invalid Signature', 406);
        }

        $this->paymentService->handleConfirmation($request->input());

        return response('OK', 200);
    }
}
