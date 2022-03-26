<?php

namespace App\Http\Livewire\Giving;

use Livewire\Component;

class CryptoPayment extends Component
{
    public array $currencies = [
        'BTC' => 'Bitcoin',
        'ETH' => 'Ethereum',
        'USDT' => 'USDT (ERC20)',
        'DAI' => 'Dai Stablecoin',
        'BUSD' => 'BUSD (BSC)'
    ];

    public string $invoice;

    public function render()
    {
        return view('livewire.giving.crypto-payment');
    }
}
