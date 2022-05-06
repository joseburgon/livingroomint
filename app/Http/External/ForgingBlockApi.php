<?php

namespace App\Http\External;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class ForgingBlockApi
{
    protected string $apiBaseUrl;
    protected array $options = ['timeout' => 300];
    protected array $requestData = [];

    public function __construct()
    {
        $this->apiBaseUrl = (config('services.forging_block.mode') === 'test')
            ? 'https://api-demo.forgingblock.io'
            : 'https://api.forgingblock.io';

        $this->requestData['trade'] = config('services.forging_block.trade');
        $this->requestData['token'] = config('services.forging_block.token');
    }

    public function get(string $endpoint, array $data = []): Collection
    {
        $response = Http::get($this->apiBaseUrl.$endpoint, $data);

        if ($response->failed()) {
            return collect([
                'status' => false,
                'error' => $response->json()['error']
            ]);
        }

        return collect([
            'status' => true,
            'data' => $response->collect()
        ]);
    }

    public function post(string $endpoint, array $data): Collection
    {
        $response = Http::asForm()
            ->withOptions($this->options)
            ->post($this->apiBaseUrl.$endpoint, array_merge($this->requestData, $data));

        if ($response->failed()) {
            return collect([
                'status' => false,
                'error' => $response->json()['error']
            ]);
        }

        return collect([
            'status' => true,
            'data' => $response->collect()
        ]);
    }
}
