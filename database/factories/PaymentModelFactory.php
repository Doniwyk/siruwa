<?php

namespace Database\Factories;

use App\Models\AccountModel;
use App\Models\PaymentModel;
use App\Models\UserModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

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
    public function definition()
    {
        
        return [
            'id_penduduk' => null,
            'id_admin' => $this->faker->randomElement([1, 2, 3, 4, 5]),  
            'nomor_kk' => DB::table('penduduk')
            ->where('id_penduduk', null)
            ->value('nomor_kk'),
            'jenis' => null,
            'metode' => $this->faker->randomElement(['Tunai', 'Transfer']),
            'urlBuktiPembayaran' => $this->faker->imageUrl(),
            'jumlah' => null,
            'status' => 'Terverifikasi',
            'keterangan_status' => $this->faker->sentence,
        ];
    }



    public function paymentVerivied($jenis)
    {
        return $this->state(function (array $attributes) use ($jenis) {
            return [
                'jenis' => $jenis,
                'status' => 'Terverifikasi',
                'jumlah' => 50000
            ];
        });
    }

}
