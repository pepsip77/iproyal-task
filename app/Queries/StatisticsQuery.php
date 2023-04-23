<?php

namespace App\Queries;

use App\Enums\TransactionType;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder;

class StatisticsQuery
{
    private Builder $query;

    public function __construct (private Transaction $transaction)
    {
        $this->query = $this->transaction->newQuery();
    }

    public function setParams(array $params): self
    {
        if (!empty($params['date_from'])) {
            $this->query->where('created_at', '>=', $params['date_from']);
        }

        if (!empty($params['date_to'])) {
            $this->query->where('created_at', '<=', $params['date_to']);
        }

        if (!empty($params['user_id'])) {
            $this->query->where('created_at', '=', $params['user_id']);
        }

        return $this;
    }

    public function get(): array
    {
        $this->query->selectRaw('COUNT(id) total_transactions_count,
            SUM(CASE WHEN `type` = ? THEN amount ELSE 0 END) AS total_order_amount,
            SUM(CASE WHEN `type` = ? THEN amount ELSE 0 END) AS total_deposit_amount,
            SUM(CASE WHEN `type` = ? THEN amount ELSE 0 END) AS total_refund_amount,
            AVG(amount) AS transaction_average,
            SUM(CASE WHEN `type` = ? THEN 1 ELSE 0 END) AS total_order_count,
            SUM(CASE WHEN `type` = ? THEN 1 ELSE 0 END) AS total_deposit_count,
            SUM(CASE WHEN `type` = ? THEN 1 ELSE 0 END) AS total_refund_count',
            [
                TransactionType::Order,
                TransactionType::Deposit,
                TransactionType::Refund,
                TransactionType::Order,
                TransactionType::Deposit,
                TransactionType::Refund,
            ]);

        return $this->query
            ->first()
            ->toArray();
    }
}
