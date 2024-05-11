<?php

namespace Database\Factories;

use App\Models\PaymentModel;
use App\Models\UserModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentModel>
 */
class PaymentModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = PaymentModel::class;
    public function definition(): array
    {
return [
            'id_admin' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'nomor_kk' => function () {
                return UserModel::factory()->create()->nomor_kk;
            },
            'jenis' => $this->faker->randomElement(['Iuran Kematian', 'Iuran Sampah']),
            'metode' => $this->faker->randomElement(['Tunai','Transfer']),
            'jumlah' => $this->faker->randomElement([10000, 20000, 30000, 40000, 50000, 60000, 70000, 80000, 90000, 100000 ]),
            'status' => $this->faker->randomElement(['Terverifikasi', 'Belum Terverifikasi']),
        ];
    }
}
