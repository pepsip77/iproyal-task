<?php
declare(strict_types=1);

namespace App\Enums;

enum TransactionType: int
{
    case Order = 0;
    case Deposit = 1;
    case Refund = 2;

    public static function getRandom(): TransactionType
    {
        $cases = self::cases();

        return $cases[array_rand($cases)];
    }

    public static function getRandomValue(): int
    {
        return self::getRandom()->value;
    }
}
