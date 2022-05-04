<?php

namespace App\Http\Livewire\Giving;

use App\Models\Giving;
use App\Services\Payments\ForgingBlock;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Livewire\Component;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CryptoPayment extends Component
{
    public Giving $giving;
    public string $invoiceId;
    public Collection $invoice;
    public string $currentStep = 'method';
    public string $qrCode;
    public array $currencies = [
        'BTC' => 'Bitcoin',
        'ETH' => 'Ethereum',
        'USDT' => 'USDT (ERC20)',
        'DAI' => 'Dai Stablecoin',
        'BUSD' => 'BUSD (BSC)'
    ];
    public string $paymentMethod = '';
    public string $wallet = '';
    public string $error = '';
    public string $status = 'new';
    public int $maxTime = 1800;
    public int $expirationTime = 1800;

    public function render()
    {
        return view('livewire.giving.crypto-payment');
    }

    public function pay(string $coin)
    {
        try {
            if ($this->paymentMethod === $coin) {
                $this->currentStep = 'payment';

                return;
            }

            $this->paymentMethod = $coin;

            $this->updateInvoiceStatus();

            if ($this->status !== 'error') {
                $this->currentStep = 'payment';

                $this->qrCode = QrCode::size(250)->format('svg')->generate($this->invoice->get('invoiceBitcoinUrlQR'));
            }
        } catch (\Exception $e) {
            $this->error = $e->getMessage();
        }
    }

    public function updateInvoiceStatus()
    {
        $service = new ForgingBlock();

        $response = $service->getInvoiceStatus($this->invoiceId, $this->paymentMethod);

        if (! $response->get('status')) {
            $this->error = $response->get('error');

            $this->status = 'error';

            return;
        }

        $this->error = '';

        $this->invoice = $response->get('data');

        $this->status = $this->invoice->get('status');

        $this->maxTime = $this->invoice->get('maxTimeSeconds');

        $this->expirationTime = $this->invoice->get('expirationSeconds');

        $this->wallet = $this->invoice->get('btcAddress');
    }
}
