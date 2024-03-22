<?php

namespace Biohazard\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;
use Biohazard\Http\OzonApi;

class Ozon extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        
        Http::macro('ozonApi', function () {
            return Http::withHeaders([
                'Content-Type' => 'application/json',
                'Client-Id' => env('OZON_CLIENT_ID'),
                'Api-Key' => env('OZON_API_KEY'),
            ])->baseUrl(env('OZON_BASE_URL'));
        });

        $this->app->singleton(OzonApi::class, function ($app) {
            return new OzonApi();
        });
    }
}
