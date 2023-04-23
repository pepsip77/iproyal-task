<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    public function definition(): array
    {
        //@TODO: fill the fields
        return [
            'type' => null,
            'amount' => null,
            'currency' => null,
            'created_at' => fake()->dateTime(),
        ];
    }
}
