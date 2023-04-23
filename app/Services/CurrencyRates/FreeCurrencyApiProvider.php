<?php

namespace App\Services\CurrencyRates;

use Illuminate\Http\Client\Factory as HttpClient;
use Illuminate\Http\Client\RequestException;

class FreeCurrencyApiProvider implements CurrencyRatesProvider
{
    public const BASE_URL = 'https://api.freecurrencyapi.com/v1/latest';

    public function __construct(private readonly HttpClient $httpClient)
    {
    }

    /**
     * @throws RequestException
     */
    public function getAvailableCurrencies(): array
    {
        $response = $this->getResponseData();

        return array_keys($response);
    }

    /**
     * @throws RequestException
     */
    public function getAvailableExchangeRates(): array
    {
        return $this->getResponseData();
    }

    /**
     * @throws RequestException
     */
    public function getResponseData(): array
    {
        $response = $this->httpClient->get(self::BASE_URL, [
            'apikey' => config('api.free_currency_api_key'),
        ]);

        if (!$response->successful()) {
            throw new RequestException($response);
        }

        return $response->json()['data'];
    }
}
