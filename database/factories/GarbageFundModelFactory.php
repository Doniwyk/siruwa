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
        $payment = PaymentModel::factory()->create();

        return [
            'nomor_kk' => $payment->nomor_kk,
            'id_pembayaran' => $payment->id_pembayaran,
            'bulan' => $this->faker->date(),
            'status' => $this->faker->randomElement(['Lunas', 'Belum Lunas']),
        ];
    }
}
