<?php

namespace App\Services\CurrencyRates;

interface CurrencyRatesProvider
{
    public function getAvailableCurrencies(): array;

    public function getAvailableExchangeRates(): array;
}
