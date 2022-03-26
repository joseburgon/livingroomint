<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Registries\PaymentGatewayRegistry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ForgingBlockController extends Controller
{
    public $name = 'ForgingBlock';

    private $gatewayRegistry;

    private $paymentService;

    private $logTag = '[GIVINGS][CONTROLLER][FORGING_BLOCK]';

    public function __construct (PaymentGatewayRegistry $registry) {
        $this->gatewayRegistry = $registry;

        $this->paymentService = $this->gatewayRegistry->get($this->name);
    }

    public function response(Request $request)
    {
        Log::info("{$this->logTag}[RESPONSE]", $request->input());

        return response()->json($request->input());
    }

    public function notify(Request $request)
    {
        Log::info("{$this->logTag}[NOTIFY] Receiving new confirmation request.");

        Log::info("{$this->logTag}[NOTIFY]", $request->input());

        return response('OK', 200);
    }
}
