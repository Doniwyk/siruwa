<?php

namespace Database\Seeders;

use App\Models\GarbageFundModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GarbageFundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GarbageFundModel::factory(10)->create();

    }
}
