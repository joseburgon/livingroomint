<?php

namespace App\Http\Livewire\Giving;

use App\Contracts\PaymentGatewayInterface;
use App\Models\Giving;
use App\Registries\PaymentGatewayRegistry;
use App\Services\Payments\ForgingBlock;
use Forgingblock\ApiClient;
use Livewire\Component;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CryptoPayment extends Component
{
    public Giving $giving;
    public array $invoice;
    public string $currentStep = 'method';
    public string $qrCode;
    public array $currencies = [
        'BTC' => 'Bitcoin',
        'ETH' => 'Ethereum',
        'USDT' => 'USDT (ERC20)',
        'DAI' => 'Dai Stablecoin',
        'BUSD' => 'BUSD (BSC)'
    ];
    public string $paymentMethod = 'BTC';
    public string $wallet = '';
    public string $error = '';

    public function render()
    {
        return view('livewire.giving.crypto-payment');
    }

    public function pay(ForgingBlock $service, string $coin)
    {
        try {
            $this->paymentMethod = $coin;

            $this->invoice = $service->createInvoice($this->giving->reference, $this->giving->amount);

            $this->setWallet();

            $this->currentStep = 'payment';

            $this->qrCode = QrCode::size(250)->format('svg')->generate($this->invoice['payUrl']);
        } catch (\Exception $e) {
            $this->error = $e->getMessage();
        }
    }

    public function setWallet()
    {
        $this->wallet = preg_replace('/(.*)?(.*):(.*)/s', '\2', $this->invoice['payUrl']);
    }
}
