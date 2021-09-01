<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Registries\PaymentGatewayRegistry;
use Illuminate\Http\Request;

class PayUController extends Controller
{
    public $name = 'PayU';

    private $gatewayRegistry;

    private $paymentService;

    public function __construct (PaymentGatewayRegistry $registry) {
        $this->gatewayRegistry = $registry;

        $this->paymentService = $this->gatewayRegistry->get($this->name);
    }

    public function response(Request $request)
    {
        $signature = $this->paymentService->signature(
            $request->referenceCode,
            number_format($request->TX_VALUE, 1, '.', ''),
            $request->currency
        );

        if (strtoupper($request->signature) !== strtoupper($signature)) {
            return view('givings.error');
        }

        $data['currency'] = $request->currency;
        $data['amount'] = $request->TX_VALUE;
        $data['email'] = $request->buyerEmail;

        return view('givings.response', $data);
    }

    public function confirmation()
    {
        //
    }
}
