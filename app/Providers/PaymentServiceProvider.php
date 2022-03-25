<?php

namespace App\Providers;

use App\Registries\PaymentGatewayRegistry;
use App\Services\Payments\ForgingBlock;
use App\Services\Payments\PayU;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PaymentGatewayRegistry::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function boot()
    {
        $this->app->make(PaymentGatewayRegistry::class)
            ->register('PayU', new PayU)
            ->register('ForgingBlock', new ForgingBlock);
    }
}
