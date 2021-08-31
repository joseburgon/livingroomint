<?php

namespace App\Contracts;

use App\Models\Giving;

interface PaymentGatewayInterface
{
    function pay();

    function prepare(Giving $giving);

    function getCheckoutUrl();
}
