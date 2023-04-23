<?php

namespace App\DTO;

use App\Services\CurrencyRates\CurrencyRatesService;

class Statistics
{
    private int $totalTransactionsCount;
    private float $totalOrderAmount;
    private float $totalDepositAmount;
    private float $totalRefundAmount;
    private float $transactionAverage;
    private ?float $transactionAverageInCurrency;
    private int $totalOrderCount;
    private int $totalDepositCount;
    private int $totalRefundCount;

    public function __construct(array $data, ?string $convertTo)
    {
        $this->totalTransactionsCount = $data['total_transactions_count'] ?? 0;
        $this->totalOrderAmount = round($data['total_order_amount'] ?? 0, 2);
        $this->totalDepositAmount = round($data['total_deposit_amount'] ?? 0, 2);
        $this->totalRefundAmount = round($data['total_refund_amount'] ?? 0, 2);
        $this->transactionAverage = round($data['transaction_average'] ?? 0, 2);
        $this->totalOrderCount = $data['total_order_count'] ?? 0;
        $this->totalDepositCount = $data['total_deposit_count'] ?? 0;
        $this->totalRefundCount = $data['total_refund_count'] ?? 0;
        $this->transactionAverageInCurrency = null;

        if (!empty($convertTo) && 'USD' !== strtoupper($convertTo)) {
            $this->transactionAverageInCurrency = round(
                app()->make(CurrencyRatesService::class)
                    ->convert($this->transactionAverage, $convertTo),
                2
            );
        }
    }

    public function getFormattedData(): array
    {
        $result = [
            'total_transactions_count' => $this->totalTransactionsCount,
            'total_order_amount' => $this->totalOrderAmount,
            'total_deposit_amount' => $this->totalDepositAmount,
            'total_refund_amount' => $this->totalRefundAmount,
            'total_order_count' => $this->totalOrderCount,
            'total_deposit_count' => $this->totalDepositCount,
            'total_refund_count' => $this->totalRefundCount,
            'transaction_average' => $this->transactionAverage,
        ];

        if (!is_null($this->transactionAverageInCurrency)) {
            $result['transaction_average_in_currency'] = $this->transactionAverageInCurrency;
        }

        return $result;
    }
}
