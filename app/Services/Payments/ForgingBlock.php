<?php

namespace App\Services\Payments;

use App\Contracts\PaymentGatewayInterface;
use App\Models\Giving;
use Forgingblock\ApiClient;
use Illuminate\Support\Facades\Log;

class ForgingBlock implements PaymentGatewayInterface
{
    private ApiClient $forgingBlock;

    private string $logTag = '[GIVINGS][SERVICE][FORGING_BLOCK]';

    public function __construct()
    {
        $this->forgingBlock = new ApiClient(config('services.forging_block.mode'));
        $this->forgingBlock->SetValue('trade', config('services.forging_block.trade'));
        $this->forgingBlock->SetValue('token', config('services.forging_block.token'));
        $this->forgingBlock->SetValue('link', config('services.forging_block.return_url'));
        $this->forgingBlock->SetValue('notification', config('services.forging_block.notify_url'));
    }

    public function pay()
    {
        // TODO: Implement pay() method.
    }

    public function prepare(Giving $giving): array
    {
        try {
//            $this->createInvoice($giving->reference, $giving->amount);

            return [
                'params' => [
                    'giving' => $giving->id,
                ],
                'route' => 'donaciones.crypto',
                'redirectType' => 'local'
            ];
        } catch (\Exception $e) {
            Log::error("{$this->logTag}[PREPARE] Error getting invoice URL: /n {$e->getMessage()}");
        }
    }

    public function getCheckoutUrl()
    {
        // TODO: Implement getCheckoutUrl() method.
    }

    public function getResponseView(int $state)
    {
        return collect([
            4 => 'givings.success',
            5 => 'givings.error',
            6 => 'givings.error',
            7 => 'givings.pending',
            104 => 'givings.error',
        ])->get($state, 'givings.pending');
    }

    public function getInvoiceDetails(string $invoiceId)
    {
        $this->forgingBlock->SetValue('invoice',  $invoiceId);

        return $this->forgingBlock->CheckInvoiceStatus();
    }

    public function createInvoice(string $order, float $amount): array
    {
        $this->forgingBlock->SetValue('amount', round($amount, 2));
        $this->forgingBlock->SetValue('currency', 'USD');
        $this->forgingBlock->SetValue('order', $order);

        return $this->forgingBlock->CreateInvoice();
    }
}
