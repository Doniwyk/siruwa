<?php

namespace Database\Factories;

use App\Models\GarbageFundModel;
use App\Models\PaymentModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GarbageFundModel>
 */
class GarbageFundModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = GarbageFundModel::class;
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
            GarbageFundModel::create([
                'nomor_kk' => $nomor_kk,
                'id_pembayaran' => $month <= 5 ? $id_pembayaran : null,
                'bulan' => now()->startOfYear()->addMonths($month - 1)->format('Y-m-d'),
                'status' => $month <= 5 ? 'Lunas' : 'Belum Lunas',
            ]);
        }
    }
}
