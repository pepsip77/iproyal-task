<?php

namespace App\Services\CurrencyRates;

use Illuminate\Contracts\Cache\Repository as CacheContract;

class CurrencyRatesService
{
    public const CACHE_LIFETIME_SECONDS = 900; //15minutes
    public const CURRENCY_LIST_KEY = 'currencies';
    public const CURRENCY_RATES_KEY = 'currency_rates';

    public function __construct(private readonly CurrencyRatesProvider $provider, private readonly CacheContract $cache)
    {
    }

    public function getAvailableCurrencies(): array
    {
        return $this->cache->remember(self::CURRENCY_LIST_KEY, self::CACHE_LIFETIME_SECONDS, function() {
            return $this->provider->getAvailableCurrencies();
        });
    }

    public function getAvailableExchangeRates(): array
    {
        return $this->cache->remember(self::CURRENCY_RATES_KEY, self::CACHE_LIFETIME_SECONDS, function() {
            return $this->provider->getAvailableExchangeRates();
        });
    }
}
