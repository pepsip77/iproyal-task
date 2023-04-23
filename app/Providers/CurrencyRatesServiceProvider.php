<?php

namespace App\Providers;

use App\Services\CurrencyRates\CurrencyRatesProvider;
use App\Services\CurrencyRates\CurrencyRatesService;
use App\Services\CurrencyRates\FreeCurrencyApiProvider;
use Illuminate\Support\ServiceProvider;

class CurrencyRatesServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CurrencyRatesProvider::class, FreeCurrencyApiProvider::class);
        $this->app->singleton(CurrencyRatesService::class, CurrencyRatesService::class);
    }
}
