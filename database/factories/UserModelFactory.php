<?php

namespace Database\Factories;

use App\Models\UserModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserModel>
 */
class UserModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = UserModel::class;
    public function definition(): array
    {
        return [
            'tgl_lahir' => fake()->date(),
            'nik' => fake()->unique()->regexify('[0-9]{16}'),
            'nomor_kk' => fake()->regexify('[0-9]{16}'),
            'nama' => fake()->name,
            'tempat_lahir' => fake()->city,
            'jenis_kelamin' => fake()->randomElement(['L', 'P']),
            'rt' => fake()->numberBetween(1, 20),
            'status_kawin' => fake()->randomElement(['BM', 'M', 'CH', 'CM']),
            'status_keluarga' => fake()->randomElement(['kepala_keluarga', 'istri', 'anak']),
            'agama' => fake()->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu', 'KL']),
            'alamat' => fake()->address,
            'pendidikan' => fake()->randomElement(['TTS', 'SD', 'SMP', 'SMA', 'Diploma', 'Sarjana']),
            'pekerjaan' => fake()->randomElement(['PNS', 'TNI/POLRI', 'Wirausaha', 'Wiraswasta', 'PM', 'TB']),
            'akseptor_kb' => fake()->boolean,
            'jenis_akseptor' => fake()->randomElement(['IUD', 'Pil', 'Suntik']),
            'aktif_posyandu' => fake()->boolean,
            'has_BKB' => fake()->boolean,
            'has_tabungan' => fake()->boolean,
            'ikut_kel_belajar' => fake()->boolean,
            'jenis_kel_belajar' => fake()->randomElement(['Sekolah Dasar', 'Sekolah Menengah', 'Perguruan Tinggi']),
            'ikut_paud' => fake()->boolean,
            'ikut_koperasi' => fake()->boolean,
            'gaji' => fake()->randomFloat(2, 1000, 10000),
            'pajak_bumi' => fake()->randomFloat(2, 100, 500),
            'biaya_listrik' => fake()->randomFloat(2, 50, 200),
            'biaya_air' => fake()->randomFloat(2, 20, 100),
            'jumlah_sepeda' => fake()->numberBetween(0, 5),
            'jumlah_mobil' => fake()->numberBetween(0, 5),
        ];
    }
}
