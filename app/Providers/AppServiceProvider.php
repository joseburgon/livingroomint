<?php

namespace App\Providers;

use ConsoleTVs\Charts\Registrar as Charts;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url, Charts $charts)
    {
        if (env('APP_ENV') === 'production') {
            $url->forceScheme('https');
        }

        $charts->register([
            \App\Charts\GivingsTypesChart::class
        ]);
    }
}
