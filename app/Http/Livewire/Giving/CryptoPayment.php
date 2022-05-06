<?php

namespace App\Http\Livewire\Giving;

use App\Mail\GivingReceived;
use App\Mail\NotifyGiving;
use App\Models\Giving;
use App\Models\PaymentMethod;
use App\Services\Payments\ForgingBlock;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CryptoPayment extends Component
{
    protected const INVOICE_PAID = 'paid';
    protected const INVOICE_CONFIRMED = 'confirmed';
    protected const INVOICE_EXPIRED = 'expired';

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

                $this->emit('invoiceUpdated', [
                    'maxTime' => $this->maxTime,
                    'expirationTime' => $this->expirationTime,
                ]);

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

        if ($this->status === self::INVOICE_PAID || $this->status === self::INVOICE_CONFIRMED) {
            $this->emit('invoicePaid');

            $this->givingPaid();

            return redirect()->route('donaciones.success', $this->giving);
        }

        if ($this->status === self::INVOICE_EXPIRED) {
            return redirect()->route('donaciones.redirect', $this->giving);
        }

        $this->maxTime = $this->invoice->get('maxTimeSeconds');

        $this->expirationTime = $this->invoice->get('expirationSeconds');

        $this->wallet = $this->invoice->get('btcAddress');
    }

    protected function givingPaid()
    {
        $paymentMethod = PaymentMethod::type($this->invoice->get('paymentMethodId'))->first();

        $this->giving->update([
            'status' => Giving::STATUS_APPROVED,
            'transaction_id' => $this->invoice->get('invoiceId'),
            'payment_method_id' => $paymentMethod->id,
        ]);

        Mail::to($this->giving->giver->email)->queue(new GivingReceived($this->giving));

        Mail::to(config('givings.notify_email'))->queue(new NotifyGiving($this->giving));
    }
}
