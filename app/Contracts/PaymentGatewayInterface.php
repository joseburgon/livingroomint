<?php

namespace App\Contracts;

use App\Models\Giving;

interface PaymentGatewayInterface
{
    public function pay();

    public function prepare(Giving $giving);

    public function getCheckoutUrl();

    public function getResponseView(int $state);
}
