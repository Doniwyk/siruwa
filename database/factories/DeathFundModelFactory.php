<?php

namespace Database\Factories;

use App\Models\DeathFundModel;
use App\Models\PaymentModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DeathFundModel>
 */
class DeathFundModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = DeathFundModel::class;
    public function definition(): array
    {
        return [
            'nomor_kk' => null,
            'id_pembayaran' => null,
            'bulan' => $this->faker->date(),
            'status' => $this->faker->randomElement(['Lunas', 'Belum Lunas']),
        ];
    }

    public function forEachKK(int $count, int $id_pembayaran, string $nomor_kk)
    {
        foreach (range(1, $count) as $month) {
            DeathFundModel::create([
                'nomor_kk' => $nomor_kk,
                'id_pembayaran' => $month <= 5 ? $id_pembayaran : null,
                'bulan' => now()->startOfYear()->addMonths($month - 1)->format('Y-m-d'),
                'status' => $month <= 7 ? 'Lunas' : 'Belum Lunas',
            ]);
        }
    }
}
