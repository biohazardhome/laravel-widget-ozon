<?php

namespace Biohazard\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;
use Biohazard\Http\OzonApi;

class Ozon extends ServiceProvider
{

    private const PATH_VIEWS = __DIR__ .'/../../resources/views/';

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
        $this->loadViewsFrom(self::PATH_VIEWS, 'widget');
        $this->publishes([
            self::PATH_VIEWS => resource_path('views/widget'),
            __DIR__.'/../../resources/css/' => public_path('css/widget'),
            __DIR__.'/../../resources/js/' => public_path('js/widget'),
        ], 'widget');

        Http::macro('connection', function () {
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
