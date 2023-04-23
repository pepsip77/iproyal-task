<?php

namespace Database\Factories;

use App\Enums\TransactionType;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'type' => TransactionType::getRandomValue(),
            'amount' => fake()->randomFloat(2, 1, 500),
            'currency' => 'USD',
            'created_at' => fake()->dateTime(),
        ];
    }
}
