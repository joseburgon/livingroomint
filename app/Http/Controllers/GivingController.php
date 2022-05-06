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
        if ($giving->status !== Giving::STATUS_CREATED) {
            return view('givings.invalid');
        }

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
            'giving' => $giving,
            'invoiceId' => $request->get('invoiceId')
        ]);
    }

    public function error(Giving $giving)
    {
        return view('givings.error', [
            'currency' => $giving->currency,
            'amount' => $giving->amount,
            'email' => $giving->giver->email
        ]);
    }

    public function success(Giving $giving)
    {
        if ($giving->status !== Giving::STATUS_APPROVED) {
            return redirect()->route('donaciones.error', $giving);
        }

        return view('givings.success', [
            'currency' => $giving->currency,
            'amount' => $giving->amount,
            'email' => $giving->giver->email
        ]);
    }
}
