<?php

namespace Database\Seeders;

use App\Models\AccountModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AccountModel::factory(5)->create();
    }
}
