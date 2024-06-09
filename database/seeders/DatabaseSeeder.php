<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\AccountModel;
use App\Models\UserModel;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ResidentSeeder::class,
            AccountSeeder::class,
            DocumentSeeder::class,
            NewsSeeder::class,
            EventSeeder::class,
            PaymentSeeder::class,
            DeathFundSeeder::class,
            GarbageFundSeeder::class,
            PendudukTemporarySeeder::class,
            ExpenseSeeder::class
        ]);
        
    }
}
