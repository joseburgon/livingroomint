<?php

namespace App\Services\Payments;

use App\Contracts\PaymentGatewayInterface;
use App\Http\External\ForgingBlockApi;
use App\Models\Giving;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class ForgingBlock implements PaymentGatewayInterface
{
    private ForgingBlockApi $forgingBlockApi;

    private string $logTag = '[GIVINGS][SERVICE][FORGING_BLOCK]';

    public function __construct()
    {
        $this->forgingBlockApi = new ForgingBlockApi();
    }

    public function pay()
    {
        // TODO: Implement pay() method.
    }

    public function prepare(Giving $giving): array
    {
        try {
            $response = $this->createInvoice($giving->reference, $giving->amount);

            if (! $response->get('status')) {
                throw new \Exception($response->get('error'));
            }

            return [
                'params' => [
                    'giving' => $giving->id,
                    'invoiceId' => $response->get('data')->get('id')
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

    public function createInvoice(string $order, float $amount): Collection
    {
        return $this->forgingBlockApi->post('/create-invoice', [
            'link' => config('services.forging_block.return_url'),
            'notification' => config('services.forging_block.notify_url'),
            'amount' => round($amount, 2),
            'currency' => 'USD',
            'order' => $order,
        ]);
    }

    public function getInvoiceStatus(string $invoiceId, string $coin): Collection
    {
        $endpoint = '/i/' . $invoiceId . '/' . $coin . '/status';

        return $this->forgingBlockApi->get($endpoint, ['invoiceId' => $invoiceId, 'paymentMethodId' => $coin, '_' => 1]);
    }
}
