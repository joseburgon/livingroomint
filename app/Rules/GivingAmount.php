<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class GivingAmount implements Rule
{
    private const MIN_AMOUNTS = [
        'COP' => 10000,
        'USD' => 3,
        'BTC' => 5,
    ];

    private $currency;
    private $minValue;

    public function __construct(string $currency)
    {
        $this->currency = $currency;

        $this->minValue = self::MIN_AMOUNTS[$this->currency];
    }

    public function passes($attribute, $value): bool
    {
        return intval($value) >= $this->minValue;
    }

    public function message(): string
    {
        return 'El monto mínimo para donar es: ' . $this->currency . ' $' . $this->minValue;
    }
}
