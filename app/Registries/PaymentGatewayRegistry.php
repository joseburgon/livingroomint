<?php

namespace App\Registries;

use App\Contracts\PaymentGatewayInterface;
use Exception;

class PaymentGatewayRegistry
{
    protected $gateways = [];

    function register($name, PaymentGatewayInterface $instance): PaymentGatewayRegistry
    {
        $this->gateways[$name] = $instance;

        return $this;
    }

    /**
     * @throws Exception
     */
    function get($name) {
        if (array_key_exists($name, $this->gateways)) {
            return $this->gateways[$name];
        } else {
            throw new Exception("Invalid gateway");
        }
    }
}
