<?php

namespace App\Services\Payments;

use App\Contracts\PaymentGatewayInterface;
use App\Models\Giving;

class PayU implements PaymentGatewayInterface
{
    function pay() {
        // TODO: Implement pay() method.
    }

    function prepare(Giving $giving)
    {
        // TODO: Implement prepare() method.
    }

    private function signature()
    {

    }

}
