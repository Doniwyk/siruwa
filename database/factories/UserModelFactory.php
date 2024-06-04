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
    private static $nikCounter = 3579011402040001;
    
    public function definition()
    {
        $nik = self::$nikCounter++;
        return [
            'tgl_lahir' => $this->faker->date(),
            'nik' => str_pad($nik, 16, '0', STR_PAD_LEFT),
            'nomor_kk' => $this->faker->regexify('[0-9]{16}'),
            'nama' => $this->faker->name,
            'tempat_lahir' => $this->faker->city,
            'jenis_kelamin' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'rt' => $this->faker->numberBetween(1, 20),
            'status_kawin' => fake()->randomElement(['Belum Menikah', 'Menikah', 'Cerai Hidup', 'Cerai Mati']),
            'status_keluarga' => fake()->randomElement(['Kepala Keluarga', 'Istri', 'Anak']),
            'agama' => $this->faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu', 'Kepercayaan Lain']),
            'alamat' => $this->faker->address,
            'pendidikan' => fake()->randomElement(['SD', 'SMP', 'SMA', 'Diploma', 'Sarjana']),
            'pekerjaan' => fake()->randomElement(['PNS', 'TNI/Polri', 'Wirausaha', 'Wiraswasta', 'Pelajar/Mahasiswa', 'Tidak Bekerja']),
            'akseptor_kb' => $this->faker->boolean,
            'jenis_akseptor' => $this->faker->randomElement(['IUD', 'Pil', 'Suntik']),
            'aktif_posyandu' => $this->faker->boolean,
            'has_BKB' => $this->faker->boolean,
            'has_tabungan' => $this->faker->boolean,
            'ikut_kel_belajar' => $this->faker->boolean,
            'jenis_kel_belajar' => $this->faker->randomElement(['Sekolah Dasar', 'Sekolah Menengah', 'Perguruan Tinggi']),
            'ikut_paud' => $this->faker->boolean,
            'ikut_koperasi' => $this->faker->boolean,
            'gaji' => $this->faker->randomFloat(2, 1000, 10000),
            'pajak_bumi' => $this->faker->randomFloat(2, 100, 500),
            'biaya_listrik' => $this->faker->randomFloat(2, 50, 200),
            'biaya_air' => $this->faker->randomFloat(2, 20, 100),
            'total_pajak_kendaraan' => $this->faker->randomFloat(2, 100, 500),
            'jumlah_tanggungan' => $this->faker->numberBetween(1, 5),

        ];
    }

    public function kepalaKeluarga($agama)
    {
        return $this->state(function (array $attributes) use ($agama) {
            return [
                'tgl_lahir' => $this->faker->date('Y-m-d', '-40 years'),
                'jenis_kelamin' => 'Laki-laki',
                'status_keluarga' => 'Kepala Keluarga',
                'status_kawin' => 'Menikah',
                'agama' => $agama,
            ];
        });
    }

    public function istri($nomorKk, $agama)
    {
        return $this->state(function (array $attributes) use ($nomorKk, $agama) {
            return [
                'nomor_kk' => $nomorKk,
                'tgl_lahir' => $this->faker->date('Y-m-d', '-35 years'),
                'status_keluarga' => 'Istri',
                'status_kawin' => 'Menikah',
                'agama' => $agama,
                'jenis_kelamin' => 'Perempuan',
            ];
        });
    }

    public function anak($nomorKk, $agama)
    {
        return $this->state(function (array $attributes) use ($nomorKk, $agama) {
            return [
                'nomor_kk' => $nomorKk,
                'tgl_lahir' => $this->faker->date('Y-m-d', '-15 years'),

                'status_keluarga' => 'anak',
                'status_kawin' => 'Belum Menikah',
                'agama' => $agama,
            ];
        });
    }
}
