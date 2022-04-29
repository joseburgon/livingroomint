<?php

namespace App\Services\Payments;

use App\Contracts\PaymentGatewayInterface;
use App\Models\Giving;
use Forgingblock\ApiClient;
use Illuminate\Support\Facades\Log;

class ForgingBlock implements PaymentGatewayInterface
{
    private $mode;
    private $token;
    private $trade;
    private $returnUrl;
    private $notifyUrl;

    private $logTag = '[GIVINGS][SERVICE][FORGING_BLOCK]';

    public function __construct()
    {
        $this->mode = config('services.forging_block.mode');
        $this->token = config('services.forging_block.token');
        $this->trade = config('services.forging_block.trade');
        $this->returnUrl = config('services.forging_block.return_url');
        $this->notifyUrl = config('services.forging_block.notify_url');
    }

    public function pay()
    {
        // TODO: Implement pay() method.
    }

    public function prepare(Giving $giving): array
    {
        try {
            $forgingBlock = $this->createInvoice($giving->reference, $giving->amount);

            // TODO: Send the available currencies in params
            return [
                'params' => [
                    'giving' => $giving,
                    'invoice' => $forgingBlock->GetInvoiceID(),
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

    private function createInvoice(string $order, float $amount): ApiClient
    {
        $forgingBlock = new ApiClient($this->mode);
        $forgingBlock->SetValue('trade', $this->trade);
        $forgingBlock->SetValue('token', $this->token);
        $forgingBlock->SetValue('amount', round($amount, 2));
        $forgingBlock->SetValue('currency', 'USD');
        $forgingBlock->SetValue('link', $this->returnUrl);
        $forgingBlock->SetValue('notification', $this->notifyUrl);
        $forgingBlock->SetValue('order', $order);
        $forgingBlock->CreateInvoice();

        return $forgingBlock;
    }
}
