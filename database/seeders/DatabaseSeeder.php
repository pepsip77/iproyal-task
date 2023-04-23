<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Throwable;

class DatabaseSeeder extends Seeder
{
    public const DEFAULT_PASSWORD = 'password';

    public function __construct(private readonly DatabaseManager $databaseManager)
    {
    }

    /**
     * @throws Throwable
     */
    public function run(): void
    {
        $totalUsers = 700;
        $totalTransactions = 1000000;

        $users = User::factory($totalUsers)
            ->create([
                'password' => self::getDefaultPasswordHash(),
            ]);

        $transactionsPerUser = ceil($totalTransactions/$totalUsers);

        $userChunks = $users->chunk(50);

        foreach ($userChunks as $userChunk) {
            $this->databaseManager->transaction(static function () use ($transactionsPerUser, $userChunk) {
                foreach ($userChunk as $user) {
                    Transaction::factory($transactionsPerUser)
                        ->create([
                            'user_id' => $user->id,
                        ]);
                }
            });
        }
    }

    public static function getDefaultPasswordHash(): string
    {
        return Hash::make(self::DEFAULT_PASSWORD);
    }
}
