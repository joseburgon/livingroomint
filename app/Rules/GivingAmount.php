<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class GivingAmount implements Rule
{
    private const MIN_COP = 10000;
    private const MIN_USD = 3;

    private $currency;
    private $minValue;

    public function __construct(string $currency)
    {
        $this->currency = $currency;

        $this->minValue = $this->currency === 'COP' ? self::MIN_COP : self::MIN_USD;
    }

    public function passes($attribute, $value): bool
    {
        return intval($value) >= $this->minValue;
    }

    public function message(): string
    {
        return 'El monto mínimo para donar es: '.$this->currency.' $'.$this->minValue;
    }
}
