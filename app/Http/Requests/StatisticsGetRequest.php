<?php

namespace App\Http\Requests;

use App\Rules\CaseInsensitiveIn;
use App\Services\CurrencyRates\CurrencyRatesService;
use Illuminate\Foundation\Http\FormRequest;

class StatisticsGetRequest extends FormRequest
{
    public function authorize(): bool
    {
        //@todo: authorization
        return true;
    }

    public function rules(): array
    {
        return [
            'date_from' => 'sometimes|date_format:Y-m-d|before_or_equal:date_to',
            'date_to' => 'sometimes|date_format:Y-m-d|before_or_equal:today',
            'user_id' => 'sometimes|integer|exists:users,id',
            'currency_abb' => [
                'sometimes',
                'string',
                'size:3',
                new CaseInsensitiveIn(app()->make(CurrencyRatesService::class)->getAvailableCurrencies()),
            ],
        ];
    }
}
