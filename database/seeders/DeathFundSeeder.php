<?php

namespace Database\Seeders;

use App\Models\DeathFundModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeathFundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DeathFundModel::factory(10)->create();

    }
}
