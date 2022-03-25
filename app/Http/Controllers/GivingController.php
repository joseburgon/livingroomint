<?php

namespace App\Http\Controllers;

use App\Models\Giving;
use App\Registries\PaymentGatewayRegistry;
use Illuminate\Http\Request;

class GivingController extends Controller
{
    private $gatewayRegistry;

    public function __construct (PaymentGatewayRegistry $registry) {
        $this->gatewayRegistry = $registry;
    }

    public function redirect(Giving $giving)
    {
        $paymentService = $this->gatewayRegistry->get($giving->paymentGateway->name);

        $serviceParams = $paymentService->prepare($giving);

        if ($serviceParams['method'] === 'GET') {
            return redirect()->away($serviceParams['checkoutUrl']);
        }

        return view('givings.redirect', $serviceParams);
    }
}
