<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatisticsGetRequest;
use App\Models\Transaction;
use App\Services\CurrencyRates\CurrencyRatesService;

class Statistics extends Controller
{
    public function __invoke(StatisticsGetRequest $request, CurrencyRatesService $service)
    {
        $params = $request->validated();
        dd(Transaction::count(),$params, $service->getAvailableCurrencies(), $service->getAvailableExchangeRates());
    }
}
