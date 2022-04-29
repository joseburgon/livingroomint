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

        $service = $paymentService->prepare($giving);

        if ($service['redirectType'] === 'form') {
            return view('givings.redirect', $service);
        }

        if ($service['redirectType'] === 'away') {
            return redirect()->away($service['checkoutUrl']);
        }

        return redirect()->route($service['route'], $service['params']);
    }

    public function crypto(Giving $giving, Request $request)
    {
        return view('givings.crypto', [
            'invoice' => $request->get('invoice'),
            'giving' => $giving,
            'currencies' => [
                'BTC' => 'Bitcoin',
                'ETH' => 'Ethereum',
                'USDT' => 'USDT (ERC20)',
                'DAI' => 'Dai Stablecoin',
                'BUSD' => 'BUSD (BSC)'
            ]
        ]);
    }
}
