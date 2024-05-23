<?php

namespace Database\Factories;

use App\Models\DeathFundModel;
use App\Models\PaymentModel;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        $payment = PaymentModel::factory()->create();
        return [
            'nomor_kk' => $payment->nomor_kk,
            'id_pembayaran' => $payment->id_pembayaran,
            'bulan' => $this->faker->date(),
            'status' => $this->faker->randomElement(['Lunas', 'Belum Lunas']),
        ];
    }

    public function forEachKK(int $count = 12)
    {
        $payment = PaymentModel::factory()->create();
        foreach (range(1, $count) as $month) {
            $this->create([
                'nomor_kk' => $payment->nomor_kk,
                'id_pembayaran' => $payment->id_pembayaran,
                'bulan' => now()->startOfYear()->addMonths($month - 1)->format('Y-m-d'),
                'status' => $this->faker->randomElement(['Lunas', 'Belum Lunas']),
            ]);
        }
    }
}
