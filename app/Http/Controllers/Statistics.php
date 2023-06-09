<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatisticsGetRequest;
use App\Queries\StatisticsQuery;
use App\Services\CurrencyRates\CurrencyRatesService;
use App\DTO\Statistics as StatisticsDTO;
use Illuminate\Http\JsonResponse;

class Statistics extends Controller
{
    public function __invoke(
        StatisticsGetRequest $request,
        CurrencyRatesService $service,
        StatisticsQuery $statisticsQuery
    ): JsonResponse
    {
        $params = $request->validated();

        $result = $statisticsQuery->setParams($params)
            ->get();

        $currencyAbbreviation = $params['currency_abb'] ?? null;

        return response()
            ->json((new StatisticsDTO($result, $currencyAbbreviation))->getFormattedData());
    }
}
