<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\AccountModel;
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
            AccountSeeder::class,
            DocumentSeeder::class,
            NewsSeeder::class,
            EventSeeder::class,
            DeathFundSeeder::class,
            GarbageFundSeeder::class,
            PendudukTemporarySeeder::class
        ]);
        
    }
}
